@extends('layoutGeneral')
@section('cuerpo')
    <div style="color: #abdde5" align="center">
        <p></p>
        <h1 align="center"> FACTURAS </h1>
        <div class="row">
            <a type="button" class="btn btn-primary" href="/" role="button"><i class="fas fa-arrow-left"></i> Regresar</a>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#proveedor" role="button" >Facturas</button>
        </div>
        <table class="table table-hover table-striped" id="tabla_bodega">
            <thead>
            <tr>
                <th width="20px">ID</th>
                <th>Factura</th>
                <th>Fecha de ingreso</th>
            </tr>
            </thead>
            <tbody>
            @foreach($facturas as $f)
                <tr>
                    <td>{{$f->id}}</td>
                    <td>{{$f->Factura}}</td>
                    <td>{{$f->Fecha_ingreso}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div id="proveedor" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Seleccione un Proveedor</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form role="form" method="GET" action="{{action('FacturaController@create')}}"  enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <select class="required" id="prov" name="prov" style="width: 80%">
                            @if(isset($proveedores))
                                <option value="0" style="alignment: center">-- Seleccione --</option>
                                @foreach($proveedores as $pr)
                                    <option value="{{$pr->id}}"> {{$pr->Nombre_proveedor}}</option>
                                @endforeach
                            @elseif(isset($proveedor))
                                <option value="{{$proveedor->id}}">{{$proveedor->Nombre_proveedor}}</option>
                                <input type="hidden" name="oc_id" value="{{$idoc}}">
                            @endif
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
    <script>
        function getProveedor() {
            var prov = document.getElementById('prov').value;
        }
    </script>
@endsection
