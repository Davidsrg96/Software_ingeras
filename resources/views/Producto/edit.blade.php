@extends('layoutGeneral')
@section('titulo', 'Editar Producto')
@push('estilos')
@endpush
@push('acciones')
<script>
    $(document).ready(function (){
        @if (old('Codigo'))
            $("#Codigo").val('{{ old('Codigo') }}');
        @endif
        @if (old('Nombre_producto'))
            $("#Nombre_producto").val('{{ old('Nombre_producto') }}');
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
    });

    $('#Nombre_producto').on('keyup', function(){
        var tipo = document.getElementById('Nombre_producto').value;
        if( tipo.length  > 0){
            document.getElementById('Nombre_producto').value = tipo.charAt(0).toUpperCase() + tipo.substr(1)
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
            <h1 align="center">Editar Producto</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md">
                    <form  method="POST"
                        action="{{ route('bodega.update', $producto->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <ul class="form-style-1">
                            <div class="form-group{{ $errors->has('Codigo') ? ' has-error' : '' }}">
                                <label>Codigo<span class="required">*</span></label>
                                <input placeholder="Ingrese el Codigo del producto" type="text"
                                    id="Codigo" name="Codigo" class="form-style-1" value="{{ $producto->Codigo }}">
                                @if ($errors->has('Codigo'))
                                    <label>
                                        <span class="required">
                                            <strong>{{ $errors->first('Codigo') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Nombre_producto') ? ' has-error' : '' }}">
                                <label>Nombre<span class="required">*</span></label>
                                <input placeholder="Ingrese el nombre del producto" type="text"
                                    id="Nombre_producto" name="Nombre_producto" class="form-style-1"
                                    value="{{ $producto->Nombre_producto }}">
                                @if ($errors->has('Nombre_producto'))
                                    <label>
                                        <span class="required">
                                            <strong>{{ $errors->first('Nombre_producto') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Precio_producto') ? ' has-error' : '' }}">
                                <label>Precio<span class="required">*</span></label>
                                <input placeholder="Ingrese el precio del producto" type="number"
                                    id="Precio_producto" name="Precio_producto" class="form-style-1"
                                    value="{{ $producto->Precio_producto }}">
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
                                    id="Cantidad" name="Cantidad" class="form-style-1" value="{{ $producto->Cantidad }}">
                                @if ($errors->has('Cantidad'))
                                    <label>
                                        <span class="required">
                                            <strong>{{ $errors->first('Cantidad') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('proveedor_id') ? ' has-error' : '' }}">
                                <label>Proveedor</label><br>
                                <select id="proveedor_id" name="proveedor_id">
                                    <option value>-- Seleccione un proveedor --</option>
                                    @foreach($proveedores as $proveedor)
                                        @if($producto->proveedor)
                                            <option value="{{ $proveedor->id }}" {{ ($proveedor->id == $producto->proveedor->id) ? 'selected' : '' }}>
                                                {{ $proveedor->Nombre_proveedor }}
                                            </option>
                                        @else
                                            <option value={{$proveedor->id}}>{{ $proveedor->Nombre_proveedor}}</option>
                                        @endif
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
                            <a href="{{ route('bodega.index') }}" class="btn btn-primary" >Atrás</a>
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