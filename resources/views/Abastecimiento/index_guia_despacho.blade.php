@extends('layoutGeneral')
@section('cuerpo')
    <div align="center">
        <p></p>
        <h1 align="center"> GUIAS DE DESPACHO </h1>
        <div class="row">
            <a type="button" class="btn btn-primary" href="/" role="button"><i class="fas fa-arrow-left"></i> Regresar</a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#almacen" role="button" >Ingresar Guía</button>
        </div>
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th width="20px">ID</th>
                <th>Guía de despacho</th>
                <th>Fecha de Ingreso</th>
                <th>Almacen asociado</th>
            </tr>
            </thead>
            <tbody>
            @foreach($guias as $g)
                <tr>
                    <td>{{$g->id}}</td>
                    <td>{{$g->Guia_despacho}}</td>
                    <td>{{$g->Fecha_ingreso}}</td>
                    <td>
                        @foreach($almacenes as $a)
                            @if($g->almacenamiento_id == $a->id)
                                {{$a->Nombre}}
                            @endif
                        @endforeach
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div id="almacen" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Seleccione un Almacen</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form role="form" method="GET" action="{{action('GuiaDespachoController@create')}}" enctype="multipart/form-data">
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
