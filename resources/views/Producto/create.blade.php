@extends('layoutGeneral')
@section('titulo', 'Crear Producto')
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
    <div class="card" style="background-color: #FFFFFF;width: 100%">
        <div class="card-header">
            @include('error_formulario')
            <h1 align="center">Crear Producto</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md">
                    <form  method="POST"
                        action="{{ route('producto.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <ul class="form-style-1">
                            <div class="form-group{{ $errors->has('Descripcion') ? ' has-error' : '' }}">
                                <label>Descripción<span class="required">*</span></label>
                                <input placeholder="Ingrese la descripción del producto" type="text"
                                    id="Descripcion" name="Descripcion" class="form-style-1">
                                @if ($errors->has('Descripcion'))
                                    <label>
                                        <span class="required">
                                            <strong>{{ $errors->first('Descripcion') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Precio_producto') ? ' has-error' : '' }}">
                                <label>Precio<span class="required">*</span></label>
                                <input placeholder="Ingrese el precio del producto" type="number"
                                    id="Precio_producto" name="Precio_producto" class="form-style-1">
                                @if ($errors->has('Precio_producto'))
                                    <label>
                                        <span class="required">
                                            <strong>{{ $errors->first('Precio_producto') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Cantidad') ? ' has-error' : '' }}">
                                <label>Cantidad<span class="required">*</span></label>
                                <input placeholder="Ingrese la cantidad" type="number"
                                    id="Cantidad" name="Cantidad" class="form-style-1">
                                @if ($errors->has('Cantidad'))
                                    <label>
                                        <span class="required">
                                            <strong>{{ $errors->first('Cantidad') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Tipo_producto') ? ' has-error' : '' }}">
                                <label>Tipo de producto<span class="required">*</span></label>
                                <select id="Tipo_producto" name="Tipo_producto">
                                    <option value>-- Seleccione el tipo de producto --</option>
                                    <option value="Material">Material</option>
                                    <option value="Herramienta">Herramienta</option>
                                </select>
                                @if ($errors->has('Tipo_producto'))
                                    <label>
                                        <span class="required">
                                            <strong>{{ $errors->first('Tipo_producto') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('proveedor_id') ? ' has-error' : '' }}">
                                <label>Proveedor</label>
                                <select id="proveedor_id" name="proveedor_id">
                                    <option value>-- Seleccione un proveedor --</option>
                                    @foreach($proveedores as $proveedor)
                                        <option value={{$proveedor->id}}>{{ $proveedor->Nombre_proveedor}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('proveedor_id'))
                                    <label>
                                        <span class="required">
                                            <strong>{{ $errors->first('proveedor_id') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <hr>
                            <a href="{{ route('producto.index') }}" class="btn btn-primary" >Atrás</a>
                            <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary"
                                data-toggle="modal">Agregar
                            </a>
                        </ul>
                        @include('pop-up')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection