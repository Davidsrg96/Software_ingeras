@extends('layoutGeneral')
@section('cuerpo')

    <div>
        <div class="card" style="color: #abdde5">
            @include('error_formulario')
            <div class="row">
                <div class="col-md">
                    @if(isset($a))
                        <h1 align="center">Editar Almacenamiento</h1>
                        <form role="form" method="POST" enctype="multipart/form-data">
                            <ul class="form-style-1">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <li>
                                    <label> Usuario a cargo </label>
                                    <select id="usuario_id" name="usuario_id">
                                        <option value="">--Selecciona un Usuario--</option>
                                        @foreach($usuarios as $u)
                                            <option value="{{$u->id}}">{{$u->Nombre}}</option>
                                        @endforeach
                                    </select>
                                </li>
                                <li>
                                    <label for="nom_almacenamiento">Nombre de Almacenamiento</label>
                                    <input value="{{$a->Nombre}}" placeholder="Nombre" id="nom_almacenamiento" name="nom_almacenamiento" type="text" class="form-style-1">
                                </li>
                                <li>
                                    <label for="ubicacion">Ubicación del Almacenamiento</label>
                                    <input value="{{$a->Ubicacion}}" placeholder="Ubicacion" id="ubicacion" name="ubicacion" type="text" class="form-style-1">
                                </li>
                                <li>
                                    <a href="{{ action('AlmacenamientosController@index') }}" class="btn btn-primary" >Atrás</a>
                                    <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary" data-toggle="modal">Editar</a>
                                </li>
                            </ul>
                            @include('pop-up')
                        </form>
                    @else
                        <h1 align="center">Agregar Almacenamiento</h1>
                        <form role="form" method="POST" action="{{action('AlmacenamientosController@store')}}"  enctype="multipart/form-data">
                            <ul class="form-style-1">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <li>
                                    <label for="nom_almacenamiento">Nombre de Almacenamiento</label>
                                    <input placeholder="Nombre" id="nom_almacenamiento" name="nom_almacenamiento" type="text" class="form-style-1">
                                </li>
                                <li>
                                    <label for="ubicacion">Ubicación del Almacenamiento</label>
                                    <input placeholder="Ubicacion" id="ubicacion" name="ubicacion" type="text" class="form-style-1">
                                </li>
                                <li>
                                    <a href="{{ action('AlmacenamientosController@index') }}" class="btn btn-primary" >Atrás</a>
                                    <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary" data-toggle="modal">Guardar</a>
                                </li>
                            </ul>
                            @include('pop-up')
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
