@extends('layouts.app', [
    'namePage' => 'Mostrar Departamento',
    'class' => 'sidebar-mini',
    'activePage' => 'Departamentos',
])
@push('estilos')
    <style>
        .espacioChico{
            padding: 20px;
        }
        .textPos{
            text-align: right;
        }
    </style>
@endpush
@push('acciones')
    <script>
        //Toaster
        @if(Session::has('success'))
            mensajeEmergente('{{ Session::get('success')['titulo'] }}', '{{ Session::get('success')['mensaje'] }}');
        @endif
        @if(Session::has('fail'))
            mensajeEmergente('{{ Session::get('fail')['titulo'] }}', '{{ Session::get('fail')['mensaje'] }}', 'error');
        @endif
    </script>
@endpush
@section('cuerpo')
    <div class="panel-header panel-header-sm"></div>
    <div class="content">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h2 class="title text-center">Información del departamento</h2>
                </div>
                <hr>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 offset-md-3">
                                        <label><h4>Información General</h4></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-4 textPos">
                                        Nombre:
                                    </label>
                                    <label class="col-md-8">
                                        {{ $depto->Nombre_departamento }}
                                    </label>
                                </div>
                                <div class="row">
                                    <label class="col-md-4 textPos">
                                        Objetivo:
                                    </label>
                                    <label class="col-md-8">
                                        {{ $depto->Objetivo }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-md-6 offset-md-3">
                                        <label><h4>Listas</h4></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="#listaPersonal" class="btn btn-block btn-info" data-toggle="modal">
                                            Personal
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="#listaActividades" class="btn btn-block btn-info" data-toggle="modal">
                                            Actividades
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('Departamentos.partials.listaActDepto')
                    @include('Departamentos.partials.listaPersonalDepto')
                </div>
                <hr>
                <div class="card-footer">
                    <a type="button" class="btn btn-primary" href="{{ route('departamentos.index') }}" role="button"><i class="fas fa-arrow-left"></i> Regresar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
