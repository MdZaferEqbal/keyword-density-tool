<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Keyword Density Tool</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Linking website logo -->
        <link rel="icon" type="image/svg" href="{{url('/')}}/assets/img/logo/tool.svg">
        <!-- Linking our css file -->
        <link rel="stylesheet" href="{{url('/')}}/assets/css/app.css">
    </head>
    <body class="bg-dark">
        <nav class="navbar navbar-expand-md backgroundColor-black fixed-top">
            <a class="navbar-brand text-info" href="#"><strong>Keyword Density Tool</strong></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link {{Route::currentRouteName() == 'home' ? 'text-info' : 'text-light'}}" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{Route::currentRouteName() == 'KDTool' ? 'text-info' : 'text-light'}}" href="{{route('KDTool')}}">Tool</a>
                    </li>
                </ul>
            </div>
            <span class="navbar-brand">
                <a class="text-decoration-none" href="https://github.com/MdZaferEqbal" target="_blank"><i class="fa-brands fa-github text-info"></i> <i class="fa-brands fa-git text-info"></i></a>
            </span>
        </nav>
        <main role="main" class="container mt-3">
            @yield('content')
        </main><!-- /.container -->
        <footer class="backgroundColor-black text-info blockquote-footer custom-footer">
            <p>&copy; 2024 Keyword Density Tool. All rights reserved.</p>
        </footer>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        {{-- Fontawsome --}}
        <script src="https://kit.fontawesome.com/c7fb24f92a.js" crossorigin="anonymous"></script>
        @yield('scripts')
    </body>
</html>
