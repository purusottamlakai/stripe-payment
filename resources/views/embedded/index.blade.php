<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe payment| Embedded</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://js.stripe.com/v3/"></script>
    <script defer>
        const stripe = Stripe("pk_test_nVfuGL4WZbm1S23uXBsZgUj6");
        initialize();

        // Create a Checkout Session as soon as the page loads
        async function initialize() {
            const response = await fetch("{{ route('checkout.embedded') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    _token: "{{ csrf_token() }}"
                })
            });

            const {
                clientSecret
            } = await response.json();

            const checkout = await stripe.initEmbeddedCheckout({
                clientSecret,
            });

            // Mount Checkout
            checkout.mount('#checkout');
        }
    </script>
    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> --}}
</head>

<body>
    <a href="{{ url('/')}}" class="btn btn-danger my-3 mx-3" style="height: max-content;">Back</a>

    <!-- Display a payment form -->
    <div id="checkout">
        <!-- Checkout will insert the payment form here -->
    </div>
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
</body>
</html>
