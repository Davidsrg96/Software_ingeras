@extends('layouts.app', [
    'namePage' => 'Crear Proveedor',
    'class' => 'sidebar-mini',
    'activePage' => 'Proveedores',
])
@push('estilos')
@endpush
@push('acciones')
<!-- jquery.inputmask -->
<script src="{{ asset('/componentes/jquery.inputmask4/dist/min/jquery.inputmask.bundle.min.js') }}"></script>
<script>
    $(document).ready(function (){
        @if (old('Nombre_proveedor'))
            $("#Nombre_proveedor").val('{{ old('Nombre_proveedor') }}');
        @endif
        @if (old('Rut_proveedor'))
            $("#Rut_proveedor").val('{{ old('Rut_proveedor') }}');
        @endif
        @if (old('Nombre_vendedor'))
            $("#Nombre_vendedor").val('{{ old('Nombre_vendedor') }}');
        @endif
        @if (old('Descripcion'))
            $("#Descripcion").val('{{ old('Descripcion') }}');
        @endif
        @if (old('Rubro'))
            $("#Rubro").val('{{ old('Rubro') }}');
        @endif
        @if (old('Direccion'))
            $("#Direccion").val('{{ old('Direccion') }}');
        @endif
        @if (old('Telefono'))
            $("#Telefono").val('{{ old('Telefono') }}');
        @endif
        @if (old('Correo'))
            $("#Correo").val('{{ old('Correo') }}');
        @endif
    });

    $('#Nombre_proveedor').on('keyup', function(){
        var valor = document.getElementById('Nombre_proveedor').value;
        if( valor.length  > 0){
            document.getElementById('Nombre_proveedor').value = valor.charAt(0).toUpperCase() + valor.substr(1)
        }
    });
    $('#Nombre_vendedor').on('keyup', function(){
        var valor = document.getElementById('Nombre_vendedor').value;
        if( valor.length  > 0){
            document.getElementById('Nombre_vendedor').value = valor.charAt(0).toUpperCase() + valor.substr(1)
        }
    });
    $('#Direccion').on('keyup', function(){
        var valor = document.getElementById('Direccion').value;
        if( valor.length  > 0){
            document.getElementById('Direccion').value = valor.charAt(0).toUpperCase() + valor.substr(1)
        }
    });
    $('#Descripcion').on('keyup', function(){
        var valor = document.getElementById('Descripcion').value;
        if( valor.length  > 0){
            document.getElementById('Descripcion').value = valor.charAt(0).toUpperCase() + valor.substr(1)
        }
    });
    $('#Rubro').on('keyup', function(){
        var valor = document.getElementById('Rubro').value;
        if( valor.length  > 0){
            document.getElementById('Rubro').value = valor.charAt(0).toUpperCase() + valor.substr(1)
        }
    });

    $(function () {
        $('#Telefono').inputmask("+569{1,2}[-9{1,8}]");
    });
    $('#Telefono').on('keyup', function(){
        var fono = document.getElementById('Telefono').value;
        if( fono.length  == 4){
            if( fono[3] == 9){
                $('#Telefono').inputmask("+569[-9{1,8}]");
            }else{
                $('#Telefono').inputmask("+569{1,2}[-9{1,8}]");
            }
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
                    <h2 class="title text-center">Crear Proveedor</h2>
                </div>
                <hr>
                <form  method="POST"
                    action="{{ route('proveedores.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                        <div class="card-body col-md-6 offset-3">
                            <div class="form-group{{ $errors->has('Nombre_proveedor') ? ' has-error' : '' }}">
                                <label>Nombre del proveedor<span class="required">*</span></label>
                                <input placeholder="Ingrese el tipo de usuario" type="text"
                                    id="Nombre_proveedor" name="Nombre_proveedor" class="form-control">
                                @if ($errors->has('Nombre_proveedor'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('Nombre_proveedor') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Rut_proveedor') ? ' has-error' : '' }}">
                                <label>Rut del proveedor<span class="required">*</span></label>
                                <input placeholder="Ingrese el rut del proveedor" type="text"
                                    id="Rut_proveedor" name="Rut_proveedor" class="form-control">
                                @if ($errors->has('Rut_proveedor'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('Rut_proveedor') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Nombre_vendedor') ? ' has-error' : '' }}">
                                <label>Nombre del vendedor<span class="required">*</span></label>
                                <input placeholder="Ingrese el Nombre del vendedor" type="text"
                                    id="Nombre_vendedor" name="Nombre_vendedor" class="form-control">
                                @if ($errors->has('Nombre_vendedor'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('Nombre_vendedor') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Rubro') ? ' has-error' : '' }}">
                                <label>Rubro de la empresa<span class="required">*</span></label>
                                <input placeholder="Ingrese el rubro" type="text"
                                    id="Rubro" name="Rubro" class="form-control">
                                @if ($errors->has('Rubro'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('Rubro') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Direccion') ? ' has-error' : '' }}">
                                <label>Dirección del establecimiento<span class="required">*</span></label>
                                <input placeholder="Ingrese la dirección" type="text"
                                    id="Direccion" name="Direccion" class="form-control">
                                @if ($errors->has('Direccion'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('Direccion') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Telefono') ? ' has-error' : '' }}">
                                <label>Telefono<span class="required">*</span></label>
                                <input placeholder="Ingrese el Telefono" type="text"
                                    id="Telefono" name="Telefono" class="form-control">
                                @if ($errors->has('Telefono'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('Telefono') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Correo') ? ' has-error' : '' }}">
                                <label>Correo de contacto<span class="required">*</span></label>
                                <div class="form-group has-feedback">
                                    <input placeholder="Ingrese el correo" type="text"
                                        id="Correo" name="Correo" class="form-control">
                                </div>
                                @if ($errors->has('Correo'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('Correo') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="card-footer col-md-4 offset-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ route('proveedores.index') }}"
                                        class="btn btn-danger btn-block">
                                            Atrás
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#confirmation" class="btn btn-success btn-block"
                                        data-toggle="modal">
                                            Agregar
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