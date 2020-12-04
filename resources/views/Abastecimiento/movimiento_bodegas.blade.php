@extends('layoutGeneral')
@section('cuerpo')
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
    <div class="card">
        <div class="card-header">
            <h1 align="center">Movimiento de Productos entre almacenes</h1>
        </div>
        <form
            role="form"
            method="POST"
            action="{{ route('despacho.movimiento', [$almacen_origen->id, $almacen_destino->id]) }}"
            enctype="multipart/form-data">
            @csrf
                <div class="card-body">
                    <table class="table-hover table-striped" width="100%">
                        <!--Informacion del Almacen, solicitante y receptor de la guia-->
                        <thead style="background-color: #ffffff">
                        <tr>
                            <td colspan="2">Nombre del Solicitante:</td>
                            <td colspan="3"><input placeholder="Solicitante"  type="text" id="solicitante" name="solicitante" value="{{$solicitante->Nombre}}"></td>
                        </tr>
                        <tr>
                            <td colspan="2">Nombre del Receptor</td>
                            <td colspan="3">
                                <select id="receptor" name="receptor">
                                    <option value="">--Seleccione un usuario--</option>
                                    @foreach($usuarios as $u)
                                        <option value="{{$u->id}}">{{$u->Nombre}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Bodega Origen</td>
                            <td colspan="3"><input type="text" id="nombre" name="nombre" readonly value="{{$almacen_origen->Nombre}}"></td>
                        </tr>
                        <tr>
                            <td colspan="2">Bodega Destino</td>
                            <td colspan="3"><input type="text" id="nombre" name="nombre" readonly value="{{$almacen_destino->Nombre}}"></td>
                        </tr>
                        <tr>
                            <td colspan="2">Fecha Limite de solicitud</td>
                            <td colspan="3"><input type="date" id="fecha_limite" name="fecha_limite"></td>
                        </tr>
                        <tr>
                            <td colspan="2">Documento</td>
                            <td colspan="3"><input type="file" class="form-control" name="file" ></td>
                        </tr>
                        <tr><td colspan="4">Productos Seleccionados</td></tr>
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre del Producto</th>
                            <th>Proveedor</th>
                            <th>Disponible</th>
                        </tr>
                        </thead>
                        <tbody id="tabla_seleccion"></tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div align="right">
                        <a href="{{ route('despacho.listaBodegas',$almacen_origen->id) }}" class="btn btn-primary" >Atrás</a>
                        <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary" data-toggle="modal" >Guardar</a>
                        @include('pop-up')
                    </div>
                </div>
            </form>
    </div>

    <script src="jquery-3.4.1.min.js" ></script>
    <script>

        $(document).ready(function(){
            var table = $('#tabla_bodega').DataTable();

            //Extraccion de los datos de una fila
            table.on('click','.btn',function(){
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')){
                    $tr=$tr.prev('.parent');
                }
                var data = table.row($tr).data();
                console.log(data);
                var id = data[0];
                var nombre = data[1];
                var codigo = data[2];
                var disponible = data[4];
                var proveedor = data[5];
                var input = document.getElementById('cant'+id).value;

                if(input > disponible || input < 1){
                    if(input > disponible) alert('Ingrese un numero menor o igual a '+ disponible);
                    if(input < 1) {
                        if(input == 0) {
                            alert('Ingrese una cantidad para agregar');
                        }else{
                            alert('No se pueden ingresar números negativos');
                        }
                    }
                }else {
                    var tabla = document.getElementById('tabla_seleccion');
                    tabla.insertAdjacentHTML("beforeend", "<tr style=\"background-color: white\">\n" +
                        "                    <td><input readonly type=\"number\" id=\"ids[]\" name=\"ids[]\" value=\"" + id +
                        "\"></td>\n" +
                        "                    <td><input readonly type=\"text\" id=\"nombres[]\" name=\"nombres[]\" value=\"" + nombre +
                        "\"></td>\n" +
                        "                    <td><input readonly type=\"number\" id=\"codigos[]\" name=\"codigos[]\" value=\"" + codigo +
                        "\"></td>\n" +
                        "                    <td><input readonly type=\"text\" id=\"proveedores[]\" name=\"proveedores[]\" value=\"" + proveedor +
                        "\"></td>\n" +
                        "                    <td><input readonly type=\"number\" id=\"cant[]\"  name=\"cant[]\" value=\"" + input +
                        "\"></td>\n" +
                        "                </tr>");

                }

            });
        });
    </script>
@endsection
