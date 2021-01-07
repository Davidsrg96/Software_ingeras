@extends('layouts.app', [
    'namePage' => 'Dashboard',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'home',
    'backgroundImage' => asset('now') . "/img/bg14.jpg",
])
@push('estilos')
  <style>
    .main-panel>.content {
      margin-top: 0px;
    }
  </style>
@endpush
@section('cuerpo')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="col-md-6 offset-3">
      <img src="{{ asset('assets') }}/img/logo-footer.png">
    </div>
  </div>
@endsection