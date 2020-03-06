@extends('layoutGeneral')
@section('cuerpo')

    <div class="card">
        <div class="card-header">
            <h1 align="center">Almacen {{$almacen->Nombre}}</h1>
            <a type="button" role="button" class="btn btn-primary" href="{{action('AlmacenamientosController@index')}}"><i class="fas fa-arrow-left"></i>Regresar</a>
            <a type="button" role="button" class="btn btn-primary" href="{{route('solicitudes.bodega',$almacen->id)}}">Solicitar Productos a Bodega</a>
            <a type="button" role="button" class="btn btn-primary" href="{{route('solicitudes.almacen',$almacen->id)}}">Solicitar Productos a un Almacen</a>
            <button type="button" role="button" class="btn btn-primary" data-toggle="modal" data-target="#almacen">Enviar productos</button>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped" id="tabla_bodega">
                <thead>
                <tr>
                    <th width="20px">ID</th>
                    <th>Codigo</th>
                    <th>Nombre del Producto</th>
                    <th>Cantidad en stock</th>
                    <th>Calidad</th>
                    <th>Proveedor</th>
                    <th>Acción</th>
                </tr>
                </thead>
                <tbody>
                @foreach($productos as $p)
                    <tr>
                        <td>{{$p->id}}</td>
                        <td>{{$p->Codigo}}</td>
                        <td>{{$p->Nombre_producto}}</td>
                        <td>{{$p->Cantidad_almacenada}}</td>
                        <td>{{$p->Calidad}}</td>
                        <td>{{$p->Nombre_proveedor}}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle"
                                        data-toggle="dropdown">
                                    Accion <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{action('GuiaDespachoController@devolver',[$p->id,$almacen->id])}}" class=" btn btn-primary" title="Devolver Producto">
                                            <i class="fas fa-pencil-alt"></i>Devolver a Bodega Central</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div id="almacen" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Seleccione un Almacen de destino</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{route('despacho.almacenes',$almacen->id)}}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <select class="required" id="almacen" name="almacen" style="width: 80%">
                            <option value="0" style="alignment: center">-- Seleccione --</option>
                            @foreach($almacenes as $a)
                                <option value="{{$a->id}}"> {{$a->Nombre}}</option>
                            @endforeach
                        </select>
                        <li>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Aceptar</button>
                        </li>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
