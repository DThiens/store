<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href={{{ asset('assets/clients/css/bootstrap.min.css') }}}>
    <link rel="stylesheet" href={{{ asset('assets/clients/css/bootstrap.min.css.map') }}}>
    <link rel="stylesheet" href={{{ asset('assets/clients/css/style.css') }}}>
    @yield('css')
</head>
<body>
    @include('clients.blocks.header')
    <main class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <aside>
                        @section('sidebar')
                        @include('clients.blocks.sidebar')
                        @show
                    </aside>
                </div>
                <div class="col-9">
                    <div class="content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('clients.blocks.footer')
    <script src="{{ asset('assets/clients/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/clients/js/custom.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    @yield('js')
</body>
</html>