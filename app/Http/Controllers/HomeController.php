<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('index');
    }

    public function custom(Request $request) {
        if($request->has('payment_intent') && $request->has('payment_intent_client_secret')) {
            if(!$order = Order::where('session_id', $request->get('payment_intent_client_secret'))->where('status', 'unpaid')->first()) {
                return redirect('/');
            }
            $order->status = $request->get('redirect_status') === 'succeeded' ? 'paid' : $request->get('redirect_status');
            $order->save();
        }
        return view('custom.index');
    }

    public function embedded() {
        return view('embedded.index');
    }
}
