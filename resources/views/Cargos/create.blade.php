@extends('layoutGeneral')
@section('cuerpo')
    <div class="card">
        <div class="card-header">
            @if(isset($cargo))
                <h1 align="center"><font color="black">Editar Cargo</font></h1>
            @else
                <h1 align="center"><font color="black">Crear Cargo</font></h1>
            @endif
        </div>
        <div class="card-body">
            @if(isset($cargo))
                <form role="form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="form-group">
                        <label>Cargo</label>
                        <input type="text" class="form-group" id="tipo_cargo" name="tipo_cargo" value="{{$cargo->Tipo_cargo}}">
                    </div>
                    <div class="form-group">
                        <label>Descripción del Cargo</label>
                        <textarea id="descripcion" name="descripcion" value="{{$cargo->Descripcion}}"></textarea>
                    </div>
                    <div class="form-group">
                        <a href="{{ action('CargosController@index') }}" class="btn btn-primary">Cancelar</a>
                        <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary" data-toggle="modal">Crear</a>
                    </div>
                    @include('pop-up')
                </form>
            @else
                <form role="form" method="POST" action="{{action('CargosController@store')}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="form-group">
                        <label>Cargo</label>
                        <input type="text" class="form-group" id="tipo_cargo" name="tipo_cargo">
                    </div>
                    <div class="form-group">
                        <label>Descripción del Cargo</label>
                        <textarea id="descripcion" name="descripcion"></textarea>
                    </div>
                    <div class="form-group">
                        <a href="{{ action('CargosController@index') }}" class="btn btn-primary">Cancelar</a>
                        <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary" data-toggle="modal">Crear</a>
                    </div>
                    @include('pop-up')
                </form>
            @endif
        </div>
    </div>
@endsection
