<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Accept a payment</title>
    <meta name="description" content="A demo of a payment on Stripe" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://js.stripe.com/v3/" defer></script>
    <script>
        const CHECKOUT_URL = "{{route('checkout.custom')}}";
        const REDIRECT_URL = "{{route('custom')}}";
        const CSRF = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('js/checkout.js')}}" defer></script>
    <link rel="stylesheet" href="{{ asset('css/checkout.css')}}">
    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> --}}
</head>

<body>
    <a href="{{ url('/')}}" class="btn btn-danger my-3" style="height: max-content;">Back</a>
    <!-- Display a payment form -->
    <form id="payment-form">
        <div id="payment-element">
            <!--Stripe.js injects the Payment Element-->
        </div>
        <button id="submit">
            <div class="spinner hidden" id="spinner"></div>
            <span id="button-text">Pay now</span>
        </button>
        <div id="payment-message" class="hidden"></div>
    </form>
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
</body>
</html>
