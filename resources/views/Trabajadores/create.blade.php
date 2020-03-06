@extends('layoutGeneral')
@section('cuerpo')
    <div class="card">
        <div class="card-header">
            <h1 align="center">
                @if(isset($t))
                    Editar Trabajador
                @else
                    Crear Trabajador
                @endif
            </h1>
        </div>
        <div class="card-body">
            @if(isset($t))
                <form method="POST" enctype="multipart/form-data" role="form">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="form-group">
                        <label for="nombre">Nombre<span class="required">*</span></label>
                        <input placeholder="Ej: Juan Perez" type="text" id="nombre" name="nombre" class="form-group" value="{{$t->Nombre}}">
                    </div>
                    <div class="form-group">
                        <label for="rut">Rut<span class="required">*</span></label>
                        <input placeholder="Ej: 12.345.678-9" type="text" id="rut" name="rut" class="form-group" value="{{$t->Rut}}">
                    </div>
                    <div class="form-group">
                        <a href="{{ action('TrabajadoresController@index') }}" class="btn btn-primary">Cancelar</a>
                        <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary" data-toggle="modal">Editar</a>
                    </div>
                    @include('pop-up')
                </form>
            @else
                <form action="{{action('TrabajadoresController')}}" method="POST" enctype="multipart/form-data" role="form">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="form-group">
                        <label for="nombre">Nombre<span class="required">*</span></label>
                        <input placeholder="Ej: Juan Perez" type="text" id="nombre" name="nombre" class="form-group">
                    </div>
                    <div class="form-group">
                        <label for="rut">Rut<span class="required">*</span></label>
                        <input placeholder="Ej: 12.345.678-9" type="text" id="rut" name="rut" class="form-group">
                    </div>
                    <div class="form-group">
                        <a href="{{ action('TrabajadoresController@index') }}" class="btn btn-primary">Cancelar</a>
                        <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary" data-toggle="modal">Crear</a>
                    </div>
                    @include('pop-up')
                </form>
            @endif
        </div>
    </div>
@endsection