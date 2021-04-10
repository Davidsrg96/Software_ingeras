@extends('layouts.app', [
    'namePage' => 'Ingresar Trabajador',
    'class' => 'sidebar-mini',
    'activePage' => 'Trabajadores',
])
@push('estilos')
    <!-- Autocomplete -->
    <link href="{{ asset('componentes/autocomplete/css/custom.css') }}" rel="stylesheet">
@endpush
@push('acciones')
    <!-- Autocomplete -->
    <script src="{{ asset('componentes/autocomplete/js/trabajador.js') }}"></script>

    <script>
        var usuarios = @json($usuarios);
        var rut      = document.getElementById('Rut');
        var id       = document.getElementById('usuarioID');

        autocomplete(rut,id,usuarios);

        $('#Rut').on('keyup', function(){
            var rut = $('#Rut').val();
            $('#usuarioID').val(null);
            $('#Nombre').val(null);
            $('#Ciudad').val(null);
            $('#Cargo').val(null);
            $('#Correo').val(null);
            $('#Tipo_usuario').val(null);
            if(rut != ''){
                var url = '{{ route("ajax.trabajador.usuario", ":rut") }}';
                url = url.replace(':rut', rut);
                $.get(url, function(data) {
                    if (Object.keys(data).length != 0) {
                        $('#Nombre').val(data.nombre);
                        $('#usuarioID').val(data.id);
                        $('#Ciudad').val(data.ciudad);
                        $('#Correo').val(data.correo);
                        $('#Tipo_usuario').val(data.tipo_usuario);
                        $('#Cargo').val(data.cargo);
                    }
                });
            }
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
                    <h2 class="title text-center">Ingresar Trabajador</h1>
                </div>
                <hr>
                <form
                    method="POST"
                    action="{{ route('trabajadores.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                        <div class="card-body col-md-8 offset-2">
                            <div class="row">
                                <input type="text" id="usuarioID" hidden name="usuarioID">
                                <div class="form-group{{ $errors->has('Rut')? ' has-error' : '' }} col-md-6">
                                    <label>Rut</label>
                                    <input placeholder="Ej. 12345678-9" type="text" id="Rut" 
                                        class="form-control" autocomplete="off">
                                    @if ($errors->has('Rut'))
                                        <label>
                                            <span class="required form-error">
                                                <strong>{{ $errors->first('Rut') }}</strong>
                                            </span>
                                        </label>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Nombre</label>
                                    <input type="text" id="Nombre" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Correo</label>
                                    <input type="text" id="Correo" class="form-control" disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Ciudad</label>
                                    <input type="text" id="Ciudad" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Tipo de usuario</label>
                                    <input type="text" id="Tipo_usuario" class="form-control" disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Cargo</label>
                                    <input type="text" id="Cargo" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('Confiabilidad') ? ' has-error' : '' }}">
                                <label>Confiabilidad<span class="required">*</span></label><br>
                                <select class="form-control" id="Confiabilidad" name="Confiabilidad">
                                    <option value>-- Seleccione un valor --</option>
                                    @for( $i = 0; $i <= 5 ; $i++)
                                        <option value={{$i}}>{{ $i}}</option>
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
                            <div class="form-group{{ $errors->has('Carga_proyecto') ? ' has-error' : '' }}">
                                <label>Carga del proyecto<span class="required">*</span></label><br>
                                <select class="form-control" id="Carga_proyecto" name="Carga_proyecto">
                                    <option value>-- Seleccione un valor --</option>
                                    @for( $i = 0; $i <= 5 ; $i++)
                                        <option value={{$i}}>{{ $i}}</option>
                                    @endfor
                                </select>
                                @if ($errors->has('Carga_proyecto'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('Carga_proyecto') }}</strong>
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
                                            Ingresar
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
