@extends('layoutGeneral')
@section('cuerpo')
    <div class="card">
        <div class="card-header">
            <h1 align="center">Bodega {{$bodega->Nombre}}</h1>
            <a type="button" role="button" class="btn btn-primary" href="{{action('BodegaController@index')}}"><i class="fas fa-arrow-left"></i>Regresar</a>
            <a type="button" role="button" class="btn btn-primary" href="{{route('solicitudes.bodega',$bodega->id)}}">Solicitar Producto a Bodega</a>
            <button type="button" role="button" class="btn btn-primary" data-toggle="modal"
                data-target="#bodega{{ $bodega->id }}">
                    Enviar productos
            </button>
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
                                    <li><a href="{{action('GuiaDespachoController@devolver',[$p->id,$bodega->id])}}" class=" btn btn-primary" title="Devolver Producto">
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
    @include('Abastecimiento.partials.bodegaDestino')
@endsection
