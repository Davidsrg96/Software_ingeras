@extends('layoutGeneral')
@section('titulo', 'Lista Bodegas')
@push('estilos')
<style>
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
</style>
@endpush
@push('acciones')
    <script>
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
            var cantidad = document.getElementById('cantidad').value;
            var precio = document.getElementById('precio').value;

            if( validarIgresoProductos(desc, cantidad, precio) ){
                //Se crea la fila
                var bodyTable = '<td>' + desc.charAt(0).toUpperCase() + desc.substr(1) +'</td>'+
                    '<td>' + precio +'</td>'+
                    '<td>' + cantidad +'</td>'+
                    '<td><a class="borrar btn btn-danger" title="Eliminar Producto" style="width:100%">-</a>';
                //Se agrega la fila creada a la tabla
                document.getElementById("tabla_factura").insertRow(-1).innerHTML = bodyTable;

                document.getElementById('cantidad').value = '';
                document.getElementById('desc').value = '';
                document.getElementById('precio').value = '';
            }
        }

        //funcion que valida los datos ingresados del participante
        function validarIgresoProductos(desc, cantidad, precio){
            if(desc == "" || rut == "" || precio == ""){
                mensaje = 'Los campos descripción, precio y cantidad son obligatorios';
                $("#mensaje").html(mensaje);
                $('#error').modal('show');
                return false;
            }else{
                if( isNaN(cantidad) ){
                    mensaje = 'El campo cantidad debe ser numerico';
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
                            if( cantidad <= 0 ){
                                mensaje = 'El campo precio debe ser mayor a 0';
                                $("#mensaje").html(mensaje);
                                $('#error').modal('show');
                                return false;
                            }else{
                                var flagExiste = false;
                                for(var j = 12; j < document.getElementById("tabla_factura").rows.length; j++){
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
                }          
            }
            return true;
        }

        //funcion que crea la lista de actividades
        function listaProductos(){
            for(var j = 12; j < document.getElementById("tabla_factura").rows.length; j++){
                var descP = document.getElementById("tabla_factura").rows[j].cells[0].innerHTML;
                var precioP = document.getElementById("tabla_factura").rows[j].cells[1].innerHTML;
                var cantP = document.getElementById("tabla_factura").rows[j].cells[2].innerHTML;
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
                $('<input>').attr({
                    type: 'hidden',
                    id: 'cantP',
                    name: 'cantP[]',
                    value : cantP
                }).appendTo('form');
            }
        }

        $(document).ready(function (){
        @if (old('Numero'))
            $("#Numero").val('{{ old('Numero') }}');
        @endif
        @if (old('proveedor_id'))
            $("#proveedor_id").val('{{ old('proveedor_id') }}');
            $("#proveedor_id").change();
        @endif
        @if (old('descP'))
            @foreach(old('descP') as $key => $desc)
                var bodyTable = '<td>' + '{{ old('descP')[$key] }}' +'</td>'+
                    '<td>' + '{{ old('precioP')[$key] }}' +'</td>'+
                    '<td>' + '{{ old('cantP')[$key] }}' +'</td>'+
                    '<td><a class="borrar btn btn-danger" title="Eliminar Producto" style="width:100%">-</a>';
                //Se agrega la fila creada a la tabla
                document.getElementById("tabla_factura").insertRow(-1).innerHTML = bodyTable;
            @endforeach
        @endif
    });
    </script>
@endpush
@section('cuerpo')
    <div class="card col-md-10 offset-1" style="background-color: #FFFFFF;width: 100%">
            <div class="card-header">
                @include('error_formulario')
                <h1 align="center">Agregar Factura</h1>
            </div>
            <form
                role="form"
                method="POST"
                action="{{action('FacturaController@store')}}"
                enctype="multipart/form-data"
                onsubmit="return listaProductos();">
                @csrf
                <div class="card-body">
                    <table class="table table-hover table-striped" width="100%" id="tabla_factura">
                        <!--Informacion del proveedor-->
                        <tbody style="background-color: #a9a9a9">
                        <tr>
                            <td>N° Factura<span class="required">*</span></td>
                            <td colspan="4"><input placeholder="N° de Factura..." type="number" id="Numero" name="Numero"></td>
                        </tr>
                        <tr>
                            <td>Proveedor</td>
                            <td colspan="4">
                                <select id="proveedor_id" name="proveedor_id">
                                    <option value>-- Seleccione un proveedor --</option>
                                    @foreach($proveedores as $proveedor)
                                        <option value={{$proveedor->id}}>{{ $proveedor->Nombre_proveedor}}</option>
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
                            <td colspan="4"><input id="nombre" type="text"></td>
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
                            <td colspan="4"><input id="correo" type="text"></td>
                        </tr>
                        <tr>
                            <td>Rubro</td>
                            <td colspan="4"><input id="rubro" type="text" readonly></td>
                        </tr>
                        <tr>
                            <td>Documento</td>
                            <td colspan="4"><input type="file" class="form-control" id="Documento"name="Documento"></td>
                        </tr>
                        <!--Informacion de los productos a ingresar-->
                        <tr>
                            <td colspan="5"><h1 align="center">Productos de la Factura</h1></td>
                        </tr>
                        <tr>
                            <td>Descripción</td>
                            <td>Precio</td>
                            <td>Cantidad</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><input placeholder="Descripción del producto" type="text" id="desc"></td>
                            <td><input placeholder="Precio del Producto" type="number" id="precio"></td>
                            <td><input placeholder="Cantidad" type="number" id="cantidad"></td>
                            <td><input type="button" class="btn btn-success" id="addProducto()"
                                    onClick="addProducto()"value="+" /></td>
                        </tr>
                        </tbody>

                    </table>
                </div>
                <div class="card-footer">
                    <a href="{{ action('FacturaController@index') }}" class="btn btn-primary">
                        Atrás
                    </a>
                    <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary" data-toggle="modal">
                        Guardar
                    </a>
                    @include('pop-up')
                    @include('layouts.pop-up.error')
                </div>
        </form>
    </div>
@endsection