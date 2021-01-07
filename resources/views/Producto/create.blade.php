@extends('layouts.app', [
    'namePage' => 'Crear producto',
    'class' => 'sidebar-mini',
    'activePage' => 'Productos',
])
@push('estilos')
@endpush
@push('acciones')
<script>
    $(document).ready(function (){
        @if (old('Descripcion'))
            $("#Descripcion").val('{{ old('Descripcion') }}');
        @endif
        @if (old('Precio_producto'))
            $("#Precio_producto").val('{{ old('Precio_producto') }}');
        @endif
        @if (old('Cantidad'))
            $("#Cantidad").val('{{ old('Cantidad') }}');
        @endif
        @if (old('proveedor_id'))
            $("#proveedor_id").val('{{ old('proveedor_id') }}');
            $("#proveedor_id").change();
        @endif
        @if (old('Tipo_producto'))
            $("#Tipo_producto").val('{{ old('Tipo_producto') }}');
            $("#Tipo_producto").change();
        @endif
    });

    $('#Descripcion').on('keyup', function(){
        var tipo = document.getElementById('Descripcion').value;
        if( tipo.length  > 0){
            document.getElementById('Descripcion').value = tipo.charAt(0).toUpperCase() + tipo.substr(1)
        }
    });
    $('#Ubicacion').on('keyup', function(){
        var desc = document.getElementById('Ubicacion').value;
        if( desc.length  > 0){
            document.getElementById('Ubicacion').value = desc.charAt(0).toUpperCase() + desc.substr(1)
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
                    <h2 class="title text-center">Crear Producto</h2>
                </div>
                <hr>
                <form  method="POST"
                    action="{{ route('producto.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                        <div class="card-body col-md-6 offset-3">
                            <div class="form-group{{ $errors->has('Descripcion') ? ' has-error' : '' }}">
                                <label>Descripción<span class="required">*</span></label>
                                <input placeholder="Ingrese la descripción del producto" type="text"
                                    id="Descripcion" name="Descripcion" class="form-control">
                                @if ($errors->has('Descripcion'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('Descripcion') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Precio_producto') ? ' has-error' : '' }}">
                                <label>Precio<span class="required">*</span></label>
                                <input placeholder="Ingrese el precio del producto" type="number"
                                    id="Precio_producto" name="Precio_producto" class="form-control">
                                @if ($errors->has('Precio_producto'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('Precio_producto') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Cantidad') ? ' has-error' : '' }}">
                                <label>Cantidad<span class="required">*</span></label>
                                <input placeholder="Ingrese la cantidad" type="number"
                                    id="Cantidad" name="Cantidad" class="form-control">
                                @if ($errors->has('Cantidad'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('Cantidad') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Tipo_producto') ? ' has-error' : '' }}">
                                <label>Tipo de producto<span class="required">*</span></label>
                                <select class="form-control" id="Tipo_producto" name="Tipo_producto">
                                    <option value>-- Seleccione el tipo de producto --</option>
                                    <option value="Material">Material</option>
                                    <option value="Herramienta">Herramienta</option>
                                </select>
                                @if ($errors->has('Tipo_producto'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('Tipo_producto') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('proveedor_id') ? ' has-error' : '' }}">
                                <label>Proveedor</label>
                                <select class="form-control" id="proveedor_id" name="proveedor_id">
                                    <option value>-- Seleccione un proveedor --</option>
                                    @foreach($proveedores as $proveedor)
                                        <option value={{$proveedor->id}}>{{ $proveedor->Nombre_proveedor}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('proveedor_id'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('proveedor_id') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="card-footer col-md-4 offset-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ route('producto.index') }}"
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