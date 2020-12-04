@extends('layoutGeneral')
@section('cuerpo')
    <h1 align="center">Agregar Factura</h1>
    <style>
        input{
            width: 100%;
            alignment: right;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
    @include('error_formulario')
    <form role="form" method="POST" action="{{action('FacturaController@store')}}"  enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        @if(isset($oc_id))
            <input type="hidden" name="oc_id" value="{{$oc_id}}">
        @endif
        <table class="table table-hover table-striped" width="100%" id="tabla_factura">
            <!--Informacion del proveedor-->
            <tbody style="background-color: #a9a9a9">
            <tr>
                <td>Proveedor</td>
                <td colspan="4"><input placeholder="Proveedor" readonly type="text" id="proveedor" name="proveedor" value="{{$proveedor->Nombre_proveedor}}"></td>
            </tr>
            <tr>
                <td>RUT</td>
                <td colspan="4"><input type="text" readonly value="{{$proveedor->Rut_proveedor}}"></td>
            </tr>
            <tr>
                <td>Nombre del vendedor</td>
                <td colspan="4"><input  type="text" value="{{$proveedor->Nombre_vendedor}}"></td>
            </tr>
            <tr>
                <td>N° Factura<span class="required">*</span></td>
                <td colspan="4"><input placeholder="N° de Factura..." type="number" id="factura" name="factura"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td colspan="4"><input  type="text"  value="{{$proveedor->Correo}}"></td>
            </tr>
            <tr>
                <td>Direccion</td>
                <td colspan="4"><input id="direccion" readonly value="{{$proveedor->Direccion}}"></td>
            </tr>
            <tr>
                <td>Rubro</td>
                <td colspan="4"><input type="text" readonly value="{{$proveedor->Rubro}}"></td>
            </tr>
            <tr>
                <td>Documento</td>
                <td colspan="4"><input type="file" class="form-control" name="file" ></td>
            </tr>
            <!--Informacion de los productos a ingresar-->
            <tr>
                <td colspan="5"><h1 align="center">Productos de la Factura</h1></td>
            </tr>
            <tr>
                <td>Codigo</td>
                <td>Nombre</td>
                <td>Precio</td>
                <td>Cantidad</td>
                <td>Agregar</td>
            </tr>
            <tr>
                <td><input placeholder="Codigo" type="number" id="codigo[]" name="codigo[]"></td>
                <td><input placeholder="Nombre del producto" type="text" id="nom_producto[]" name="nom_producto[]"></td>
                <td><input placeholder="Precio del Producto" type="number" id="precio[]" name="precio[]"></td>
                <td><input placeholder="Cantidad" type="number" id="cantidad[]" name="cantidad[]"></td>
                <td><input type="button" class="btn btn-success" id="addProducto()" onClick="addProducto()" value="+" /></td>
            </tr>
            </tbody>

        </table>
        <a href="{{ action('FacturaController@index') }}" class="btn btn-primary" >Atrás</a>
        <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary" data-toggle="modal" >Guardar</a>
        @include('pop-up')
    </form>
    <script type="text/javascript">
        function addProducto() {
            var tabla = document.getElementById('tabla_factura');
            tabla.insertAdjacentHTML("beforeend","<tr style=\"background-color: #a9a9a9\">\n" +
                                     "                <td><input placeholder=\"Codigo\" type=\"number\" id=\"codigo[]\" name=\"codigo[]\"></td>\n" +
                                     "                <td><input placeholder=\"Nombre del producto\" type=\"text\" id=\"nom_producto[]\" name=\"nom_producto[]\"></td>\n" +
                                     "                <td><input placeholder=\"Precio del Producto\" type=\"number\" id=\"precio[]\" name=\"precio[]\"></td>\n" +
                                     "                <td><input placeholder=\"Cantidad\" type=\"number\" id=\"cantidad[]\" name=\"cantidad[]\"></td>\n" +
                                     "            </tr>");

        }
    </script>
@endsection
