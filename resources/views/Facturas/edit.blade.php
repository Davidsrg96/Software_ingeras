@extends('layouts.app', [
    'namePage' => 'Editar Factura',
    'class' => 'sidebar-mini',
    'activePage' => 'Facturas',
])
@push('estilos')
<style>
    .card{
        background: #a9a9a9;
    }
    input{
        width: 100%;
    }
    select{
        width: 100%;
    }
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    .tabla-factura{
        margin-bottom: 0px;
        border-bottom: 0px;
    }
    .letra{
        font-size: 20px;
        padding: 5px 0px;
        font-weight: 600;
    }
</style>
@endpush
@push('acciones')
    <script>
        //Toaster
        @if(Session::has('success'))
            mensajeEmergente('{{ Session::get('success')['titulo'] }}', '{{ Session::get('success')['mensaje'] }}');
        @endif
        @if(Session::has('fail'))
            mensajeEmergente('{{ Session::get('fail')['titulo'] }}', '{{ Session::get('fail')['mensaje'] }}', 'error');
        @endif

         //boton eliminar fila de la lista
        $(document).on('click', '.borrar', function (event) {
            if($("#tabla_factura tr").length > 1){
                $(this).closest('tr').remove();
            }
        });

        //Funcionalidad del boton agregar
        function addProducto(){
            //Toma los valores de las input
            var desc = document.getElementById('desc').value;
            var precio = document.getElementById('precio').value;

            if( validarIgresoProductos(desc, precio) ){
                //Se crea la fila
                var bodyTable = '<td>' + desc.charAt(0).toUpperCase() + desc.substr(1) +'</td>'+
                    '<td>' + precio +'</td>'+
                    '<td><input type="number" id="cantP" name="cantP[]" value=1></td>'+
                    '<td><a class="borrar btn btn-danger letra" title="Eliminar Producto" style="width:100%">-</a></td>';
                //Se agrega la fila creada a la tabla
                document.getElementById("tabla_factura").insertRow(-1).innerHTML = bodyTable;

                document.getElementById('desc').value = '';
                document.getElementById('precio').value = '';
            }
        }

        //funcion que valida los datos ingresados del participante
        function validarIgresoProductos(desc, precio){
            if(desc == "" || precio == ""){
                mensaje = 'Los campos descripción, precio y cantidad son obligatorios';
                $("#mensaje").html(mensaje);
                $('#error').modal('show');
                return false;
            }else{
                if( isNaN(precio) ){
                    mensaje = 'El campo cantidad debe ser numerico';
                    $("#mensaje").html(mensaje);
                    $('#error').modal('show');
                    return false;
                }else{
                    if( precio <= 0 ){
                        mensaje = 'El campo cantidad debe ser mayor a 0';
                        $("#mensaje").html(mensaje);
                        $('#error').modal('show');
                        return false;
                    }else{
                        var flagExiste = false;
                        for(var j = 2; j < document.getElementById("tabla_factura").rows.length; j++){
                            var desc = document.getElementById("tabla_factura").rows[j].cells[0].innerHTML;
                            if(document.getElementById("desc").value.toUpperCase() == desc.toUpperCase()){
                                flagExiste = true;
                                break;
                            }
                        }
                        if(flagExiste){
                            mensaje = 'Este producto ya ha sido ingresado en la lista';
                            $("#mensaje").html(mensaje);
                            $('#error').modal('show');
                        return false;
                        }
                    }
                }
            }
            return true;
        }

        //funcion que crea la lista de actividades
        function listaProductos(){
            for(var j = 2; j < document.getElementById("tabla_factura").rows.length; j++){
                var descP = document.getElementById("tabla_factura").rows[j].cells[0].innerHTML;
                var precioP = document.getElementById("tabla_factura").rows[j].cells[1].innerHTML;
                $('<input>').attr({
                    type: 'hidden',
                    id: 'descP',
                    name: 'descP[]',
                    value : descP
                }).appendTo('form');
                $('<input>').attr({
                    type: 'hidden',
                    id: 'precioP',
                    name: 'precioP[]',
                    value : precioP
                }).appendTo('form');
            }
            $('#proveedor_id').attr("disabled", false);
        }

        $(document).ready(function (){
            $('#orden_compra_id').on('change', function(e){
                var id = e.target.value;
                if (id != 0) {
                    var url = '{{ route("ajax.factura.orden", ":id") }}';
                    url = url.replace(':id', id);
                    $.get(url, function(data) {
                        if (Object.keys(data).length == 0) {
                            $('#rut').val('Nada');
                        } else {
                            $('#proveedor_id').val(data.idP);
                            $("#proveedor_id").change();
                            $('#proveedor_id').attr("disabled", true);
                            contarProductos(data.id);
                        }
                    });
                } else {
                    $('#proveedor_id').val(null);
                    $("#proveedor_id").change();
                    $('#proveedor_id').attr("disabled", false);
                }
            });
            $('#proveedor_id').on('change', function(e){
                var id = e.target.value;
                if (id != 0) {
                    var url = '{{ route("ajax.factura.proveedor", ":id") }}';
                    url = url.replace(':id', id);
                    $.get(url, function(data) {
                        if (Object.keys(data).length == 0) {
                            $('#rut').val('Nada');
                        } else {
                            $('#rut').val(data.rut);
                            $('#nombre').val(data.nombre);
                            $('#direccion').val(data.direccion);
                            $('#rubro').val(data.rubro);
                            $('#telefono').val(data.telefono);
                            $('#correo').val(data.correo);
                        }
                    });
                } else {
                    $('#rut').val('');
                    $('#nombre').val('');
                    $('#direccion').val('');
                    $('#rubro').val('');
                    $('#telefono').val('');
                    $('#correo').val('');
                }
            });

            function contarProductos(id)
            {
                for (var i = $("#tabla_factura tr").length - 1 ; i > 1; i--) {
                    document.getElementById("tabla_factura").deleteRow(i);
                }
                var contador = 1;
                @foreach( $ordenes as $orden )
                    if ( '{{ $orden->id }}' == id ) {
                        @if( !$orden->productos->isEmpty() )
                            var contador = 1;
                            @foreach($orden->productos as $key => $producto)
                                @if($key > 0)
                                    @if( $orden->productos[$key-1]->Descripcion != $producto->Descripcion)
                                        var bodyTable ='<td>' + '{{ $orden->productos[$key-1]->Descripcion }}' +'</td>'+
                                        '<td>' + '{{ $orden->productos[$key-1]->Precio_producto }}' +'</td>'+
                                        '<td><input type="number" id="cantP" name="cantP[]" value =' + contador +'></td>'+
                                        '<td><a class="borrar btn btn-danger letra" title="Eliminar Producto" style="width:100%">-</a></td>';
                                        document.getElementById("tabla_factura").insertRow(-1).innerHTML = bodyTable;
                                        contador = 1;
                                    @else
                                        contador++;
                                    @endif
                                @endif
                            @endforeach
                            var bodyTable ='<td>' + '{{ $orden->productos->last()->Descripcion }}' +'</td>'+
                            '<td>' + '{{ $orden->productos->last()->Precio_producto }}' +'</td>'+
                            '<td><input type="number" id="cantP" name="cantP[]" value=' + contador +'></td>'+
                            '<td><a class="borrar btn btn-danger letra" title="Eliminar Producto" style="width:100%">-</a></td>';
                            document.getElementById("tabla_factura").insertRow(-1).innerHTML = bodyTable;
                        @endif
                    }
                @endforeach
            }
            @if (old('Numero'))
                $("#Numero").val('{{ old('Numero') }}');
            @endif
            @if (old('proveedor_id'))
                $("#proveedor_id").val('{{ old('proveedor_id') }}');
                $("#proveedor_id").change();
            @else
                $("#proveedor_id").change();
            @endif
            @if (old('descP'))
                @foreach(old('descP') as $key => $desc)
                    var bodyTable = '<td>' + '{{ old('descP')[$key] }}' +'</td>'+
                        '<td>' + '{{ old('precioP')[$key] }}' +'</td>'+
                        '<td><input type="number" id="cantP" name="cantP[]" value="{{ old('cantP')[$key] }}"</td>'+
                        '<td><a class="borrar btn btn-danger letra" title="Eliminar Producto" style="width:100%">-</a></td>';
                    //Se agrega la fila creada a la tabla
                    document.getElementById("tabla_factura").insertRow(-1).innerHTML = bodyTable;
                @endforeach
            @else
                var contador = 1;
                @foreach($factura->productos as $key => $producto)
                    @if($key > 0)
                        @if( $factura->productos[$key-1]->Descripcion != $producto->Descripcion)
                            var bodyTable ='<td>' + '{{ $factura->productos[$key-1]->Descripcion }}' +'</td>'+
                            '<td>' + '{{ $factura->productos[$key-1]->Precio_producto }}' +'</td>'+
                            '<td><input type="number" id="cantP" name="cantP[]" value =' + contador +'></td>'+
                            '<td><a class="borrar btn btn-danger letra" title="Eliminar Producto" style="width:100%">-</a></td>';
                            document.getElementById("tabla_factura").insertRow(-1).innerHTML = bodyTable;
                            contador = 1;
                        @else
                            contador++;
                        @endif
                    @endif
                @endforeach
                var bodyTable ='<td>' + '{{ $factura->productos->last()->Descripcion }}' +'</td>'+
                '<td>' + '{{ $factura->productos->last()->Precio_producto }}' +'</td>'+
                '<td><input type="number" id="cantP" name="cantP[]" value =' + contador +'></td>'+
                '<td><a class="borrar btn btn-danger letra" title="Eliminar Producto" style="width:100%">-</a></td>';
                document.getElementById("tabla_factura").insertRow(-1).innerHTML = bodyTable;
            @endif
            @if (old('orden_compra_id'))
                $("#orden_compra_id").val('{{ old('orden_compra_id') }}');
                $('#proveedor_id').attr("disabled", true);
            @else
                @if(old('proveedor_id'))
                    $("#orden_compra_id").val(null);
                    $('#proveedor_id').attr("disabled", false);
                @endif
            @endif
            @if (old('bodega'))
                $('select#bodega').val('{{ old('bodega') }}').trigger('change');
            @else
                @foreach($bodegas as $bodega)
                    @if($bodega->id == $factura->productos->first()->bodega_id)
                        $('select#bodega').val('{{ $bodega->id }}').trigger('change');
                    @endif
                @endforeach
            @endif
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
                        <h2 class="title text-center">Editar Factura</h2>
                    </div>
                    <hr>
                    <form
                        role="form"
                        method="POST"
                        action="{{ route('factura.update', $factura->id) }}"
                        enctype="multipart/form-data"
                        onsubmit="return listaProductos();">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <table class="table table-hover table-striped tabla-factura" width="100%">
                                <!--Informacion del proveedor-->
                                <tbody style="background-color: #a9a9a9">
                                    <tr>
                                        <td>N° Factura<span class="required">*</span></td>
                                        <td><input placeholder="N° de Factura..." type="number" id="Numero"
                                            name="Numero" value="{{ $factura->Numero }}"></td>
                                        <td style="width: 10%"><input type="date" id="Fecha_ingreso" name="Fecha_ingreso"
                                            value="{{ $fecha }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Orden de Compra</td>
                                        <td colspan="4">
                                            <select id="orden_compra_id" name="orden_compra_id">
                                                <option value>-- Seleccione una orden de compra (opcional) --</option>
                                                @foreach($ordenes as $orden)
                                                    <option value="{{ $orden->id }}"
                                                        {{ ($factura->orden_compra_id == $orden->id )? 'selected' : '' }}>
                                                            N°: {{ $orden->Numero }} - proveedor: {{ $orden->proveedor->Nombre_proveedor }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    <tr>
                                        <td>Proveedor</td>
                                        <td colspan="4">
                                            <select id="proveedor_id" name="proveedor_id"
                                                 {{ ($factura->orden_compra_id) ? 'disabled' : '' }}>
                                                <option value>-- Seleccione un proveedor --</option>
                                                @foreach($proveedores as $proveedor)
                                                    <option value="{{ $proveedor->id }}" 
                                                        {{ ($factura->proveedor->id == $proveedor->id) ? 'selected' : '' }}>
                                                            {{ $proveedor->Nombre_proveedor}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>RUT</td>
                                        <td colspan="4"><input id="rut" type="text" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Nombre del vendedor</td>
                                        <td colspan="4"><input id="nombre" type="text" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Direccion</td>
                                        <td colspan="4"><input id="direccion" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Telefono</td>
                                        <td colspan="4"><input id="telefono" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Correo</td>
                                        <td colspan="4"><input id="correo" type="text" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Rubro</td>
                                        <td colspan="4"><input id="rubro" type="text" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Documento</td>
                                        <td colspan="4"><input class="form-control" type="file" class="form-control" id="Documento"name="Documento"></td>
                                    </tr>
                                    <!--Informacion de los productos a ingresar-->
                                    <tr>
                                        <td colspan="4"><h2 align="center">Productos</h2></td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-hover table-striped" width="100%" id="tabla_factura">
                                <tbody>
                                    <tr>
                                        <td>Descripción</td>
                                        <td>Precio</td>
                                        <td>Cantidad</td>
                                        <td width="10%"></td>
                                    </tr>
                                    <tr>
                                        <td><input placeholder="Descripción del producto" type="text" id="desc"></td>
                                        <td><input placeholder="Precio del Producto" type="number" id="precio"></td>
                                        <td></td>
                                        <td><input type="button" class="btn btn-success letra" id="addProducto()"
                                                onClick="addProducto()"value="+" /></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="card-footer col-md-4 offset-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ route('factura.index') }}"
                                        class="btn btn-danger btn-block">
                                            Atrás
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#selectBodega" class="btn btn-success btn-block"
                                        data-toggle="modal">
                                            Guardar
                                    </a>
                                </div>
                            </div>
                            @include('Facturas.partials.elegirBodegaEdit')
                            @include('layouts.pop-up.error')
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection