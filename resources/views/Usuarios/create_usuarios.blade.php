@extends('layoutGeneral')
@section('titulo', 'Crear nuevo Usuario')
@push('estilos')
@endpush
@push('acciones')
    <script>
        $(document).ready(function (){
            @if (old('Nombre'))
                $("#Nombre").val('{{ old('Nombre') }}');
            @endif
            @if (old('Apellido'))
                $("#Apellido").val('{{ old('Apellido') }}');
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
            @if (old('Confiabilidad'))
                $("#Confiabilidad").val('{{ old('Confiabilidad') }}');
                $("#Confiabilidad").change();
            @endif
             @if (old('ciudad_id'))
                $("#ciudad_id").val('{{ old('ciudad_id') }}');
                $("#ciudad_id").change();
            @endif
            @if (old('tipo_usuario_id'))
                $("#tipo_usuario_id").val('{{ old('tipo_usuario_id') }}');
                $("#tipo_usuario_id").change();
            @endif
            @if (old('cargo_id'))
                $("#cargo_id").val('{{ old('cargo_id') }}');
                $("#cargo_id").change();
            @endif
            @if (old('Es_externo') != null)
                @if( old('Es_externo') == 0)
                    document.getElementById('externo').checked = true;
                @else
                    document.getElementById('interno').checked = true;
                @endif
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
                        <div class="form-group{{ $errors->has('Apellido') ? ' has-error' : '' }}">
                            <label>Apellido<span class="required">*</span></label>
                            <input placeholder="Ingrese el Apellido" type="text" id="Apellido" name="Apellido" class="form-style-1" pattern="([A-z]|ñ|\s)*">
                            @if ($errors->has('Apellido'))
                                <label>
                                    <span class="required">
                                        <strong>{{ $errors->first('Apellido') }}</strong>
                                    </span>
                                </label>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('rutEs') ? ' has-error' : '' }}">
                            <label>Rut (sin puntos, con guión)<span class="required">*</span></label>
                            <input placeholder="Ej. 12345678-9" type="text" id="rutEs" name="rutEs"
                            class="form-style-1">
                            @if ($errors->has('rutEs'))
                                <label>
                                    <span class="required">
                                        <strong>{{ $errors->first('rutEs') }}</strong>
                                    </span>
                                </label>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label>Contraseña (Minimo 4 caracteres)<span class="required">*</span></label>
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
                            <input type="radio" name="Es_externo" id = "interno" value="1">Interno
                            <br>
                            <input type="radio" name="Es_externo" id = "externo" value="0">Externo<br>
                            @if ($errors->has('Es_externo'))
                                <label>
                                    <span class="required">
                                        <strong>{{ $errors->first('Es_externo') }}</strong>
                                    </span>
                                </label>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('Confiabilidad') ? ' has-error' : '' }}">
                            <label>Confiabilidad<span class="required">*</span></label><br>
                            <select id="Confiabilidad" name="Confiabilidad">
                                <option value>-- Seleccione un valor --</option>
                                @for( $i = 1; $i <= 5 ; $i++)
                                    <option value={{$i}}>{{ $i}}</option>
                                @endfor
                            </select>
                            @if ($errors->has('Confiabilidad'))
                                <label>
                                    <span class="required">
                                        <strong>{{ $errors->first('Confiabilidad') }}</strong>
                                    </span>
                                </label>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('ciudad_id') ? ' has-error' : '' }}">
                            <label>Ciudad<span class="required">*</span></label><br>
                            <select id="ciudad_id" name="ciudad_id">
                                <option value>-- Seleccione una ciudad --</option>
                                @foreach($ciudades as $ciudad)
                                    <option value={{$ciudad->id}}>{{ $ciudad->Nombre}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('ciudad_id'))
                                <label>
                                    <span class="required">
                                        <strong>{{ $errors->first('ciudad_id') }}</strong>
                                    </span>
                                </label>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('tipo_usuario_id') ? ' has-error' : '' }}">
                            <label>Tipo de Usuario<span class="required">*</span></label><br>
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
                        <hr>
                        <a href="{{ route('usuarios.index') }}" class="btn btn-primary" >Atrás</a>
                        <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary" data-toggle="modal">Agregar</a>
                    </ul>
                    @include('pop-up')
                </form>
            </div>
        </div>
    </div>
@endsection
