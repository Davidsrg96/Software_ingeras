<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- Extra details for Live View on GitHub Pages -->
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://www.creative-tim.com/product/now-ui-dashboard-pro" />

    <title>
      Ingeras
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    @include('layouts.estilos')
    @stack('estilos')
  </head>

  <body class="{{ $class ?? '' }}">
    <div class="wrapper">
      @auth
        @include('layouts.page_template.auth')
      @endauth
      @guest
        @include('layouts.page_template.guest')
      @endguest
    </div>
    @include('layouts.acciones')
    @stack('acciones')
  </body>
</html>