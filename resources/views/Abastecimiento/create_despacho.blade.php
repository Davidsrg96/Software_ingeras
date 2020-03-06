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
            <h1 align="center">Agregar Guía de Despacho</h1>
        </div>
        <div class="card-body">
            <form role="form" method="POST" action="{{action('GuiaDespachoController@store')}}"  enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">

                <table class="table-hover table-striped" width="100%">
                    <!--Informacion del Almacen, solicitante y receptor de la guia-->
                    <thead style="background-color: #ffffff">
                    <tr>
                        <td>Nombre del Solicitante:</td>
                        <td colspan="3"><input placeholder="Solicitante"  type="text" id="solicitante" name="solicitante" value="{{$solicitante->Nombre}}"></td>
                    </tr>
                    <tr>
                        <td>Nombre del Receptor</td>
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
                        <td>Almacen</td>
                        <td colspan="3"><input type="text" id="nombre" name="nombre" readonly value="{{$almacen->Nombre}}"></td>
                    </tr>
                    <tr>
                        <td>Ubicación</td>
                        <td colspan="3"><input type="text" id="ubicacion" name="ubicacion" readonly value="{{$almacen->Ubicacion}}"></td>
                    </tr>
                    <tr>
                        <td>Fecha Limite de solicitud</td>
                        <td colspan="3"><input type="date" id="fecha_limite" name="fecha_limite"></td>
                    </tr>
                    <tr>
                        <td>Guía de Despacho</td>
                        <td colspan="3"><input type="file" class="form-control" name="file" ></td>
                    </tr>
                    <tr><td colspan="4">Productos Seleccionados</td></tr>
                    <tr>
                        <th>Nombre del Producto</th>
                        <th>Codigo</th>
                        <th>Proveedor</th>
                        <th>Disponible</th>
                    </tr>
                    </thead>
                    <tbody id="tabla_seleccion"></tbody>

                </table>
                <div align="right">
                    <a href="{{ action('GuiaDespachoController@index') }}" class="btn btn-primary" >Atrás</a>
                    <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary" data-toggle="modal" >Guardar</a>
                    @include('pop-up')
                </div>
            </form>
        </div>
        <div class="card-footer">
            <!--Columnas de la tabla-->
            <table class="table table-hover table-striped" id="tabla_bodega" width="100%">
                <thead style="background-color: #ff7200 ">
                <tr>
                    <th width="20px">ID</th>
                    <th>Nombre del Producto</th>
                    <th>Codigo</th>
                    <th>Proveedor</th>
                    <th>Disponible</th>
                    <th style="display: none">ID proveedor</th>
                    <th>Cantidad a agregar</th>
                    <th></th>
                </tr>
                </thead>
                <tbody style="background-color: #a9a9a9">
                @foreach($producto as $p)
                    @if($p->Disponible > 0)
                        <tr>
                            <td>{{$p->id}}</td>
                            <td>{{$p->Nombre_producto}}</td>
                            <td>{{$p->Codigo}}</td>
                            <td>
                                @foreach($proveedores as $pr)
                                    @if($p->proveedor_id == $pr->id)
                                        {{$pr->Nombre_proveedor}}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{$p->Disponible}}</td>
                            <td style="display: none">{{$p->proveedor_id}}</td>
                            <td><input type="number" min="0" max="{{$p->Disponible}}" step="1" class="container" id="cant{{$p->id}}"></td>
                            <td><button type="button" class="btn">+</button></td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
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
