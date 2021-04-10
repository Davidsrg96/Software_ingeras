<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Ingeca - @yield('titulo') </title>
        @include('layouts.estilos')
        @stack('estilos')
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
        @include('layouts.acciones')
        @stack('acciones')
    </main>
    <hr>
    <footer>
        @include('footer')
    </footer>
    </body>
</html>
