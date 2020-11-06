<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <script async src="jquery-3.4.1.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <script async src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/jquery.easy-autocomplete.js"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link type="text/css" href="{{ asset('css/layout-style.css') }}" rel="stylesheet">
    </head>

    <body>
    <header>
        @include('header')
    </header>
    <hr>
    <main class="row justify-content-center">

        @if (Auth::guest())
            <div class="card" style="width: fit-content">
                <div align="center" class="card-header">
                    <h1>¡Error de autenticación!</h1>
                </div>
                <div class="card-body">
                    <p><font color="black">Lo sentimos, pero no se puede ingresar si no estas registrado como usuario,
                            ingresa haciendo click en el boton "LOGIN"</font></p>
                    <a type="button" role="button" class="btn btn-primary btn-block" href="{{ url('/login') }}" >Login</a>
                </div>
            </div>
        @else
            <div class="container">
                @yield('cuerpo')
            </div>
        @endif
    </main>
    <hr>
    <footer>
        @include('footer')
    </footer>
    </body>
</html>
