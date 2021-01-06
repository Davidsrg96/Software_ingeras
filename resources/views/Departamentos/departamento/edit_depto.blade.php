@extends('layouts.app', [
    'namePage' => 'Editar Departamento',
    'class' => 'sidebar-mini',
    'activePage' => 'Departamentos',
])
@push('estilos')
<style>
    .botonAgregar:{
        color: black;
        background-color:red;
    }
</style>
@endpush
@push('acciones')
<script>
    $(document).ready(function (){
        @if (old('Nombre_departamento'))
            $("#Nombre_departamento").val('{{ old('Nombre_departamento') }}');
        @endif
        @if (old('Objetivo'))
            $("#Objetivo").val('{{ old('Objetivo') }}');
        @endif
    });
</script>
@endpush
@section('cuerpo')
    <div class="panel-header panel-header-sm"></div>
    <div class="content col-md-10 offset-1">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    @include('error_formulario')
                    <h2 class="title text-center">Editar Departamento</h2>
                </div>
                <hr>
                <form  method="POST"
                    action="{{ route('departamentos.update', $depto) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="card-body col-md-6 offset-3">
                            <div class="form-group{{ $errors->has('Nombre_departamento') ? ' has-error' : '' }}">
                                <label>Nombre<span class="required">*</span></label>
                                <input placeholder="Ingrese el nombre del departamento" type="text"
                                    id="Nombre_departamento" name="Nombre_departamento" class="form-control"
                                    value="{{ $depto->Nombre_departamento }}">
                                @if ($errors->has('Nombre_departamento'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('Nombre_departamento') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Objetivo') ? ' has-error' : '' }}">
                                <label>Objetivo<span class="required">*</span></label>
                                <input placeholder="Ingrese el objetivo..." type="text" id="Objetivo" 
                                    name="Objetivo" class="form-control" value="{{ $depto->Objetivo }}">
                                @if ($errors->has('Objetivo'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('Objetivo') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <hr>
                            <div class="text-center">
                                <a href="{{ route('departamento.personal.edit', $depto->id) }}"
                                    class="btn btn-warning btn-round">
                                        Editar Personal
                                </a>
                                <a href="{{ route('departamento.actividades.edit', $depto->id) }}"
                                    class="btn btn-warning btn-round">
                                        Editar Actividades
                                </a>
                            </div>
                        @include('pop-up')
                        </div>
                        <hr>
                        <div class="card-footer col-md-4 offset-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ route('departamentos.index') }}"
                                        class="btn btn-danger btn-block">
                                            Atrás
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#confirmation" class="btn btn-success btn-block"
                                        data-toggle="modal">
                                            Editar
                                    </a>
                                </div>
                            </div>
                        @include('pop-up')
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection

