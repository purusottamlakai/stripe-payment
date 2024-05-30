<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
    </head>
    <body class="h-100">
        <a href="{{ url('/')}}" class="btn btn-danger mx-3 my-3">Back</a>
        <div class="container">
            @include('alert')
            <div class="row mt-3">
                @foreach ($products as $product)
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img src="{{$product->image}}" class="card-img-top" alt="Image">
                        <div class="card-body">
                            <h5 class="card-title">{{$product->name}}</h5>
                            <p class="card-text">{{ '$ ' . $product->price}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <form action="{{ route('checkout') }}" method="POST" class="mx-3 my-2" enctype="multipart/form-data">
                @csrf
                <button type="submit" class="btn btn-primary">Checkout</button>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>
