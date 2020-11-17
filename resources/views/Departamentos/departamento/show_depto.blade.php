@extends('layoutGeneral')
@section('titulo', 'Mostrar departamento')
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
    <div class="card">
        <div class="card-header">
            <h1 align="center">Información del departamento</h1>
            <a type="button" class="btn btn-primary" href="{{ route('departamentos.index') }}" role="button"><i class="fas fa-arrow-left"></i> Regresar</a>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card-body">
                    <div class="row espacioChico">
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
            <div class="col-md-6">
                <div class="card-body">
                    <div class="row" style="padding: 20px;">
                        <div class="col-md-6 offset-md-3">
                            <label><h4>Listas</h4></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 offset-md-1">
                            <a href="#listaPersonal" class="btn btn-block btn-info" data-toggle="modal">
                                Personal
                            </a>
                        </div>
                        <div class="col-md-4">
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
@endsection
