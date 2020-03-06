@extends('layoutGeneral')
@section('cuerpo')
    <div class="card">
        <div class="card-header">
            <h1 align="center"> BODEGA </h1>
            <div class="column" align="left" style="padding-left: 1.5%">
                <a type="button" class="btn btn-primary" href="/" role="button"><i class="fas fa-arrow-left"></i> Regresar</a>
                <a type="button" class="btn btn-primary" href="{{action('BodegaController@create')}}" role="button" >Ingresar Producto</a>
                <a type="button" class="btn btn-primary" href="{{action('GuiaDespachoController@index')}}" role="button" >Ver Guias de Despacho</a>
                <a type="button" class="btn btn-primary" href="{{action('FacturaController@index')}}" role="button" >Facturas</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped" id="tabla_bodega">
                <thead>
                <tr>
                    <th width="20px">ID</th>
                    <th>Codigo</th>
                    <th>Nombre del Producto</th>
                    <th>Precio del Producto</th>
                    <th>Cantidad</th>
                    <th>Disponible</th>
                    <th>Calidad</th>
                    <th>Proveedor</th>
                    <th>Acción</th>
                </tr>
                </thead>
                <tbody>
                @foreach($producto as $p)
                    <tr>
                        <td>{{$p->id}}</td>
                        <td>{{$p->Codigo}}</td>
                        <td>{{$p->Nombre_producto}}</td>
                        <td>{{$p->Precio_producto}}</td>
                        <td>{{$p->Cantidad}}</td>
                        <td>{{$p->Disponible}}</td>
                        <td>{{$p->Calidad}}</td>
                        <td>
                            @foreach($proveedores as $pr)
                                @if($p->proveedor_id == $pr->id)
                                    {{$pr->Nombre_proveedor}}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle"
                                        data-toggle="dropdown">
                                    Accion <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{action('BodegaController@edit', $p->id)}}" class=" btn btn-primary" title="Editar Producto">
                                            <i class="fas fa-pencil-alt"></i>Editar</a>
                                    </li>
                                    <li>
                                        <a data-target="#del{{$p->id}}" class="btn btn-danger active" data-toggle="modal" title="Eliminar Producto">
                                            <i class="fas fa-trash-alt"></i>Eliminar</a>
                                        <!--pop up confirmacion -->
                                        <div class="modal fade" id="del{{$p->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirmacion</h5>
                                                        <button tyle="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><font color="black">Si presiona cancelar, no se eliminaran los cambios</font> </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                                                        <a href="{{action('BodegaController@destroy',$p->id)}}"  class="btn btn-primary">Eliminar</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @if($p->Cantidad > 0 && $p->Disponible != $p->Cantidad)<!--Si la cantidad es mayor a 0 se muestra un boton para ver el almacenamiento-->
                                    <li><a type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#almacenamiento">Almacenamiento</a></li>
                                    @endif

                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!--Modal de almacenamientos-->
    <div id="almacenamiento" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Almacenamiento</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <table id="myTable" class="table table-bordered table-hover">
                        <tr>
                            <th>Nombre</th>
                            <th>Ubicación</th>
                            <th>Cantidad almacenada</th>
                        </tr>
                        @foreach($a_s as $as)
                            @if($as->bodega_id == $p->id)
                                @foreach($almacenes as $a)
                                    @if($as->almacenamiento_id == $a->id)
                                        <tr>
                                            <td>{{$a->Nombre}}</td>
                                            <td>{{$a->Ubicacion}}</td>
                                            <td>{{$as->Cantidad_almacenada}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="jquery-3.4.1.min.js" ></script>
    <script>
        $(document).ready(function() {
            var table = $('#tabla_bodega').DataTable();
        });
    </script>
@endsection
