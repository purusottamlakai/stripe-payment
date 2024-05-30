<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failure or Cancellation</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <a href="{{ url('/')}}" class="btn btn-danger mx-3 my-3">Back</a>
    <div class="container">
        @include('alert')
        <div class="row mt-5">
            <div class="col-md-6 offset-md-3">
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Payment Failed or Cancelled!</h4>
                    <hr>
                    @isset($error)
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @endisset
                    <p class="mb-0">Please try again later or contact our support team for further assistance.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
