@extends('layoutGeneral')
@section('cuerpo')
    <div class="card">
        <div class="card-header">
            @if(isset($tipo))
                <h1 align="center"><font color="black">Editar tipo de Usuario</font></h1>
            @else
                <h1 align="center"><font color="black">Crear tipo de Usuario</font></h1>
            @endif
        </div>
        <div class="card-body">
            @if(isset($tipo))
                <form role="form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="form-group">
                        <label>Tipo de Usuario</label>
                        <input type="text" class="form-group" id="tipo_usuario" name="tipo_usuario" value="{{$tipo->Tipo_usuario}}">
                    </div>
                    <div class="form-group">
                        <label>Descripción del tipo de Usuario</label>
                        <textarea id="descipcion" name="descripcion" value="{{$tipo->Descripcion}}"></textarea>
                    </div>
                    <div>
                        <a href="{{ action('TipoUsuarioController@index') }}" class="btn btn-primary">Cancelar</a>
                        <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary" data-toggle="modal">Crear</a>
                    </div>
                    @include('pop-up')
                </form>
            @else
                <form role="form" method="POST" action="{{action('TipoUsuarioController@store')}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="form-group">
                        <label>Tipo de Usuario</label>
                        <input type="text" class="form-group" id="tipo_usuario" name="tipo_usuario">
                    </div>
                    <div class="form-group">
                        <label>Descripción del tipo de Usuario</label>
                        <textarea id="descripcion" name="descripcion"></textarea>
                    </div>
                    <div class="form-group">
                        <a href="{{ action('TipoUsuarioController@index') }}" class="btn btn-primary">Cancelar</a>
                        <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary" data-toggle="modal">Crear</a>
                    </div>
                    @include('pop-up')
                </form>
            @endif
        </div>
    </div>
@endsection
