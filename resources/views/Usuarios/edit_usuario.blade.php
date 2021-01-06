@extends('layouts.app', [
    'namePage' => 'Editar Usuario',
    'class' => 'sidebar-mini',
    'activePage' => 'Usuarios',
])
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
            @if (old('password'))
                $("#password").val('{{ old('password') }}');
            @endif
            @if (old('rutEs'))
                $("#rutEs").val('{{ old('rutEs') }}');
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
            @if (old('Es_externo') != null)
                @if( old('Es_externo') == 0)
                    document.getElementById('externo').checked = true;
                @else
                    document.getElementById('interno').checked = true;
                @endif
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
    <div class="panel-header panel-header-sm"></div>
    <div class="content col-md-10 offset-1">
        <div class="row">
            <div class="card" >
                <div class="card-header">
                    @include('error_formulario')
                    <h2 class="title text-center">Editar Usuario</h2>
                </div>
                <hr>
                <form
                    method="POST"
                    action="{{route('usuarios.update', $usuario->id)}}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="card-body col-md-6 offset-3">
                            <div class="form-group{{ $errors->has('Nombre') ? ' has-error' : '' }}">
                                <label>Nombre<span class="required">*</span></label>
                                <input placeholder="Ingrese el Nombre" type="text" id="Nombre" name="Nombre" class="form-control" pattern="([A-z]|ñ|\s)*" value="{{ $usuario->Nombre }}">
                                @if ($errors->has('Nombre'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('Nombre') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Apellido') ? ' has-error' : '' }}">
                                <label>Apellido<span class="required">*</span></label>
                                <input placeholder="Ingrese el Apellido" type="text" id="Apellido" name="Apellido" class="form-control" pattern="([A-z]|ñ|\s)*" value="{{ $usuario->Apellido }}">
                                @if ($errors->has('Apellido'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('Apellido') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label>Cambiar Contraseña (Minimo 4 caracteres)<span class="required">*</span></label>
                                <input placeholder="Ingrese la contraseña" type="text" id="password"
                                    name="password" class="form-control">
                                @if ($errors->has('password'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('rutEs') ? ' has-error' : '' }}">
                                <label>Rut (sin puntos, con guión)<span class="required">*</span></label>
                                <input placeholder="Ej. 12345678-9" type="text" id="rutEs" name="rutEs"
                                class="form-control" value="{{ $usuario->Rut }}">
                                @if ($errors->has('rutEs'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('rutEs') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label>Email<span class="required">*</span></label>
                                <input type="email" id="email" name="email" placeholder="ej. ejemplo@ingeras.cl" class="form-control" value="{{ $usuario->email }}">
                                @if ($errors->has('email'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Es_externo') ? ' has-error' : '' }}">
                                <label>
                                    ¿El trabajador es Interno o Externo?<span class="required">*</span>
                                </label>
                                <div class="form-check form-check-radio">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="Es_externo" id="interno"
                                        value="1" @if($usuario->Es_externo == 1) checked @endif>
                                        Interno
                                        <span class="form-check-sign"></span>
                                    </label>
                                </div>
                                <div class="form-check form-check-radio">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="Es_externo" id="externo"
                                        value="0" @if($usuario->Es_externo == 0) checked @endif >
                                        Externo
                                        <span class="form-check-sign"></span>
                                    </label>
                                </div>
                                @if ($errors->has('Es_externo'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('Es_externo') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Confiabilidad') ? ' has-error' : '' }}">
                                <label>Confiabilidad</label><br>
                                <select class="form-control"  id="Confiabilidad" name="Confiabilidad">
                                    @for( $i = 0; $i <= 5 ; $i++)
                                        <option value="{{ $i }} " {{ ($i == $usuario->Confiabilidad) ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                                @if ($errors->has('Confiabilidad'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('Confiabilidad') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('ciudad_id') ? ' has-error' : '' }}">
                                <label>Ciudad<span class="required">*</span></label><br>
                                <select class="form-control"  id="ciudad_id" name="ciudad_id">
                                    @foreach($ciudades as $ciudad)
                                    <option value="{{ $ciudad->id }}" {{ ($ciudad->id == $usuario->ciudad_id) ? 'selected' : '' }}>
                                        {{ $ciudad->Nombre }}
                                    </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('ciudad_id'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('ciudad_id') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('tipo_usuario_id') ? ' has-error' : '' }}">
                                <label>Tipo de Usuario<span class="required">*</span></label><br>
                                <select class="form-control"  id="tipo_usuario_id" name="tipo_usuario_id">
                                    @foreach($tipos as $tipo)
                                        <option value="{{ $tipo->id }}" {{ ($tipo->id == $usuario->tipo_usuario_id) ? 'selected' : '' }}>
                                            {{ $tipo->Tipo_usuario }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('tipo_usuario_id'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('tipo_usuario_id') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('cargo_id') ? ' has-error' : '' }}">
                                <label>Cargo<span class="required">*</span></label><br>
                                <select class="form-control"  id="cargo_id" name="cargo_id">
                                    @foreach($cargos as $cargo)
                                        <option value="{{ $cargo->id }}" {{ ($cargo->id == $usuario->cargo_id) ? 'selected' : '' }}>
                                            {{ $cargo->Tipo_cargo }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('cargo_id'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('cargo_id') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="card-footer col-md-4 offset-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ route('usuarios.index') }}"
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