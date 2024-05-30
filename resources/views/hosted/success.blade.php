<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Successful</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
</head>

<body>
    <a href="{{ url('/')}}" class="btn btn-danger mx-3 my-3">Back</a>
    <div class="container">
        @include('alert')
        <div class="row mt-5">
            <div class="col-md-6 offset-md-3">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Payment Successful!</h4>
                    @if($customer)
                        <p>
                            Name : {{$customer->name}} <br>
                            Email : {{$customer->email}} <br>
                            Transaction Date  : {{ \Carbon\Carbon::parse($customer->created)->format('Y M d H:i:s') }} <br>
                        </p>
                    @endif
                    <p>Thank you for your purchase. Your payment has been successfully processed.</p>
                    <hr>
                    <p class="mb-0">For any inquiries, please contact our support team.</p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
