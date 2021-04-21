<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Blog - @yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/css/blog.css" rel="stylesheet">
</head>
<body>

    @if (Session::has('message'))
        <div class="alert alert-success text-center">
            {{ Session::get('message') }}
        </div>
    @endif

    @include('layout.nav')

    <main role="main" class="container">
        <div class="row">

            @include('errors')

            @yield('content')

            @include('layout.sidebar')

        </div>
    </main>

    @include('layout.footer')

</body>
</html>
