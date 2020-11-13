@extends('layoutGeneral')
@section('titulo', 'Editar Usuario')
@push('estilos')
@endpush
@push('acciones')
    <script type="text/javascript">
        function ShowSelected()
        {
            /* Para obtener los valores de la etiqueta select */
            var tipo = document.getElementById("tipo_usuario").value;
            var cargo = document.getElementById("cargo").value;
        }
    </script>
@endpush
@section('cuerpo')
    <div class="card" style="background-color: #FFFFFF;width: 100% " >
        @include('error_formulario')
        <div class="card-header">
            <h1 align="center">Editar Usuario</h1>
        </div>
        <div class="card-body">
            <div class="col-md">
                <form role="form" method="POST"  enctype="multipart/form-data">
                    <ul class="form-style-1">
                        <div class="form-group{{ $errors->has('Nombre') ? ' has-error' : '' }}">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <li>
                                <label for="Nombre">Nombre<span class="required">*</span></label>
                                <input placeholder="Ingrese el Nombre" type="text" id="Nombre" name="Nombre" class="form-style-1" pattern="([A-z]|ñ|\s)*" value="{{$u->Nombre}}">
                            </li>
                            @if ($errors->has('Nombre'))
                                <span class="col-md-8 col-md-offset-4 help-block">
                                    <strong>{{ $errors->first('Nombre') }}</strong>
                                </span>
                            @endif
                        </div>
                       
                        <li>
                            <label for="Rut">Rut<span class="required">*</span></label>
                            <input placeholder="Ingrese el Rut" type="text" id="rut" name="rut" class="form-style-1" value="{{$u->Rut}}">
                        </li>
                        <li>
                            <label for="Contraseña">Contraseña<span class="required">*</span></label>
                            <input placeholder="Ingrese la contraseña" type="text" id="contraseña" name="contraseña" class="form-style-1" value="{{$u->password}}">
                        </li>

                        <li>
                            <label for="email">Email<span class="required">*</span></label>
                            <input type="email" id="email" name="email" placeholder="ej. ejemplo@ingeras.cl" class="form-style-1" value="{{$u->email}}">
                        </li><li>
                            <label for="Trabajador_ioe">¿El trabajador es Interno o Externo?<span class="required">*</span></label><br>
                            <input type="radio" name="trabajador_ioe" value="1">Interno<br>
                            <input type="radio" name="trabajador_ioe" value="0">Externo<br>
                        </li>
                        <li>
                            <label for="Confiabilidad">Confiabilidad (Minimo: 1 - Maximo: 5)<span class="required">*</span></label><br>
                            <input type="number" id="confiabilidad" name="confiabilidad" value="{{$u->Confiabilidad}}">
                        </li>
                        <li>
                            <label for="Ciudad">Ciudad<span class="required">*</span></label>
                            <input placeholder="Ingrese la ciudad del trabajador" type="text" id="ciudad" name="ciudad" class="form-style-1" value="{{$u->Ciudad}}">
                        </li>
                        <li>
                            <label for="Tipo_usuario">Seleccione el Tipo de Usuario<span class="required">*</span></label><br>
                            <select id="tipo_usuario" name="tipo_usuario">
                                <option value="{{$u->tipo_usuario_id}}">-- Seleccione --</option>
                                @foreach($tipos as $tipo)
                                    <option value={{$tipo->id}}>{{ $tipo->Tipo_usuario}}</option>
                                @endforeach
                            </select>
                        </li>
                        <li>
                            <label for="Cargo">Cargo<span class="required">*</span></label><br>
                            <select id="cargo" name="cargo">
                                <option value="{{$u->cargo_id}}">-- Seleccione --</option>
                                @foreach($cargos as $cargo)
                                    <option value={{$cargo->id}}>{{$cargo->Tipo_cargo}}</option>
                                @endforeach
                            </select>
                        </li>
                        <li>
                            <a href="{{ route('usuarios.index') }}" class="btn btn-primary" >Atrás</a>
                            <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary" data-toggle="modal">Editar</a>
                        </li>
                    </ul>
                    @include('pop-up')
                </form>
            </div>
        </div>
    </div>
@endsection
