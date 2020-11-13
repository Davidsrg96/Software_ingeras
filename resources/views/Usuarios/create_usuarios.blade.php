@extends('layoutGeneral')
@section('titulo', 'Crear nuevo Usuario')
@push('estilos')
@endpush
@push('acciones')
    <script>
        function ShowSelected()
        {
            /* Para obtener los valores de la etiqueta select */
            var tipo = document.getElementById("tipo_usuario").value;
            var cargo = document.getElementById("cargo").value;
        }

        $(document).ready(function (){
            @if (old('Nombre'))
                $("#Nombre").val('{{ old('Nombre') }}');
            @endif
            @if (old('rutEs'))
                $("#rutEs").val('{{ old('rutEs') }}');
            @endif
            @if (old('password'))
                $("#password").val('{{ old('password') }}');
            @endif
            @if (old('email'))
                $("#email").val('{{ old('email') }}');
            @endif
            @if (old('Es_externo'))
                $("#Es_externo").val('{{ old('Es_externo') }}');
            @endif
            @if (old('Confiabilidad'))
                $("#Confiabilidad").val('{{ old('Confiabilidad') }}');
            @endif
            @if (old('Ciudad'))
                $("#Ciudad").val('{{ old('Ciudad') }}');
            @endif
            @if (old('tipo_usuario_id'))
                $("#tipo_usuario_id").val('{{ old('tipo_usuario_id') }}');
                $("#tipo_usuario_id").change();
            @endif
            @if (old('cargo_id'))
                $("#cargo_id").val('{{ old('cargo_id') }}');
                $("#cargo_id").change();
            @endif
        });
    </script>
@endpush
@section('cuerpo')
    <div class="card" style="background-color: #FFFFFF;width: 100% " >
        <div class="card-header">
            <h1 align="center">Agregar Usuario</h1>
        </div>
        @include('error_formulario')

        <div class="card-body">
            <div class="col-md">
                <form
                    method="POST"
                    action="{{route('usuarios.store')}}"
                    enctype="multipart/form-data">
                    @csrf
                    <ul class="form-style-1">
                        <div class="form-group{{ $errors->has('Nombre') ? ' has-error' : '' }}">
                            <label>Nombre<span class="required">*</span></label>
                            <input placeholder="Ingrese el Nombre" type="text" id="Nombre" name="Nombre" class="form-style-1" pattern="([A-z]|ñ|\s)*">
                            @if ($errors->has('Nombre'))
                                <label>
                                    <span class="required">
                                        <strong>{{ $errors->first('Nombre') }}</strong>
                                    </span>
                                </label>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('rutEs') ? ' has-error' : '' }}">
                            <label>Rut<span class="required">*</span></label>
                            <input placeholder="Ingrese el Rut" type="text" id="rutEs" name="rutEs"
                            class="form-style-1" onkeyup="Principal()">
                            @if ($errors->has('rutEs'))
                                <label>
                                    <span class="required">
                                        <strong>{{ $errors->first('rutEs') }}</strong>
                                    </span>
                                </label>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label>Contraseña<span class="required">*</span></label>
                            <input placeholder="Ingrese la contraseña" type="text" id="password"
                                name="password" class="form-style-1">
                            @if ($errors->has('password'))
                                <label>
                                    <span class="required">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                </label>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label>Email<span class="required">*</span></label>
                            <input type="email" id="email" name="email" placeholder="ej. ejemplo@ingeras.cl" class="form-style-1">
                            @if ($errors->has('email'))
                                <label>
                                    <span class="required">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                </label>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('Es_externo') ? ' has-error' : '' }}">
                            <label>¿El trabajador es Interno o Externo?<span class="required">*</span></label><br>
                            <input type="radio" name="Es_externo" value="1">Interno<br>
                            <input type="radio" name="Es_externo" value="0">Externo<br>
                            @if ($errors->has('Es_externo'))
                                <label>
                                    <span class="required">
                                        <strong>{{ $errors->first('Es_externo') }}</strong>
                                    </span>
                                </label>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('Confiabilidad') ? ' has-error' : '' }}">
                            <label>Confiabilidad (Minimo: 1 - Maximo: 5)<span class="required">*</span></label><br>
                            <input type="number" id="Confiabilidad" name="Confiabilidad">
                            @if ($errors->has('Confiabilidad'))
                                <label>
                                    <span class="required">
                                        <strong>{{ $errors->first('Confiabilidad') }}</strong>
                                    </span>
                                </label>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('Ciudad') ? ' has-error' : '' }}">
                            <label>Ciudad<span class="required">*</span></label>
                            <input placeholder="Ingrese la ciudad del trabajador" type="text"
                            id="Ciudad" name="Ciudad" class="form-style-1">
                            @if ($errors->has('Ciudad'))
                                <label>
                                    <span class="required">
                                        <strong>{{ $errors->first('Ciudad') }}</strong>
                                    </span>
                                </label>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('tipo_usuario_id') ? ' has-error' : '' }}">
                            <label>Seleccione el Tipo de Usuario<span class="required">*</span></label><br>
                            <select id="tipo_usuario_id" name="tipo_usuario_id">
                                <option value>-- Seleccione un tipo de usuario --</option>
                                @foreach($tipos as $tipo)
                                    <option value={{$tipo->id}}>{{ $tipo->Tipo_usuario}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('tipo_usuario_id'))
                                <label>
                                    <span class="required">
                                        <strong>{{ $errors->first('tipo_usuario_id') }}</strong>
                                    </span>
                                </label>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('cargo_id') ? ' has-error' : '' }}">
                            <label>Cargo<span class="required">*</span></label><br>
                            <select id="cargo_id" name="cargo_id">
                                <option value>-- Seleccione un cargo --</option>
                                @foreach($cargos as $cargo)
                                    <option value={{$cargo->id}}>{{$cargo->Tipo_cargo}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('cargo_id'))
                                <label>
                                    <span class="required">
                                        <strong>{{ $errors->first('cargo_id') }}</strong>
                                    </span>
                                </label>
                            @endif
                        </div>
                        <a href="{{ route('usuarios.index') }}" class="btn btn-primary" >Atrás</a>
                        <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary" data-toggle="modal">Agregar</a>
                    </ul>
                    @include('pop-up')
                </form>
            </div>
        </div>
    </div>
@endsection
