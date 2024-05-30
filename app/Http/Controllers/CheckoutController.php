<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Stripe\StripeClient;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()  {
        return view('hosted.index', [
            'products' => Product::all()
        ]);
    }

    public function checkout()  {
        try {
            $stripe = new StripeClient(config('stripe.secret_key'));
            $checkout_session = $stripe->checkout->sessions->create([
                'line_items' => $this->getLineItems(),
                'mode' => 'payment',
                'customer_creation' => 'always',
                'success_url' => route('checkout.success') . "?session_id={CHECKOUT_SESSION_ID}",
                'cancel_url' => route('checkout.cancel'),
            ]);
            if($order = Order::where('session_id', $checkout_session->id)->exists()) {
                if($order->status === 'paid') {
                    return back()->with('error', 'Already Verified.');
                }
            } else {
                $order = new Order();
            }
            $order->status = 'unpaid';
            $order->total_price = 1;
            $order->session_id = $checkout_session->id;
            $order->save();
            
            return redirect($checkout_session->url);
        } catch (\Throwable $th) {
            return redirect()->route('checkout.cancel')->with('error', $th->getMessage());
        }
    }

    public function success(Request $request)  {
        try {
            $customer = null;
            $stripe = new StripeClient(config('stripe.secret_key'));
            if(!$session_id = $request->get('session_id')) {
                throw new \Exception("Session ID is missing.");
            }
    
            if(!$order = Order::where('session_id', $session_id)->where('status', 'unpaid')->first()) {
                throw new \Exception("Unable to associate session with Order");
            }
            $order->status = 'paid';
            $order->save();
    
            $session = $stripe->checkout->sessions->retrieve($session_id);
            if($session->customer)
                $customer = $stripe->customers->retrieve($session->customer);
            return view('hosted.success', compact('customer'));
        } catch (\Exception $e) {
            return view('hosted.cancel')->with('error', $e->getMessage());
        }
    }

    public function cancel()  {
        return view('hosted.cancel');
    }

    public function getLineItems()  {
        $lineItems = [];
        $totalPrice = 0;
        foreach (Product::all() as $product) {
            $lineItems[] = [
                'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => $product->name,
                    'images' => [$product->image],
                ],
                'unit_amount' =>  $product->price * 100,
                ],
                'quantity' => 1,
            ];
            $totalPrice += $product->price;
        }
        return $lineItems;
    }

    public function checkoutEmbeded()
    {
        $stripe = new StripeClient(config('stripe.secret_key'));

        try {
            $checkout_session = $stripe->checkout->sessions->create([
                'ui_mode' => 'embedded',
                'line_items' => $this->getLineItems(),
                'mode' => 'payment',
                'return_url' => route('checkout.success') . "?session_id={CHECKOUT_SESSION_ID}",
            ]);
            if($order = Order::where('session_id', $checkout_session->id)->exists()) {
                if($order->status === 'paid') {
                    return back()->with('error', 'Already Verified.');
                }
            } else {
                $order = new Order();
            }
            $order->status = 'unpaid';
            $order->total_price = 1;
            $order->session_id = $checkout_session->id;
            $order->save();
            return response()->json(['clientSecret' => $checkout_session->client_secret]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function custom()
    {
        try {
            $stripe = new StripeClient(config('stripe.secret_key'));
            // Create a PaymentIntent with a specified payment method
            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => 100,
                'currency' => 'usd',
                'automatic_payment_methods' => [
                    'enabled' => true,
                    'allow_redirects' => 'always' // Allow redirects for payment methods
                ],
                'confirm' => true,
                'return_url' => 'http://app.test/success.html',
            ]);

            info([$paymentIntent]);
            

            if($order = Order::where('session_id', $paymentIntent->client_secret)->exists()) {
                if($order->status === 'paid') {
                    return back()->with('error', 'Already Verified.');
                }
            } else {
                $order = new Order();
            }
            $order->status = 'unpaid';
            $order->total_price = 1;
            $order->session_id = $paymentIntent->client_secret;
            $order->save();

            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];
            return response()->json($output);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}