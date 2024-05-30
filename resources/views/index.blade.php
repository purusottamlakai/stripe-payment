<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stripe Pay</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body, html {
      height: 100%;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .center-items {
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    @include('alert')
    <div class="row">
      <div class="col-md-12 center-items">
        <div class="list-group">
            <a href="{{ route('hosted') }}" class="list-group-item list-group-item-action list-group-item-primary">Stripe-hosted page</a>
            <a href="{{ route('embedded') }}" class="list-group-item list-group-item-action list-group-item-secondary">Embedded form</a>
            <a href="{{ route('custom') }}" class="list-group-item list-group-item-action list-group-item-success">Custom payment flow</a>
          </div>
      </div>
    </div>
  </div>
</body>
</html>
