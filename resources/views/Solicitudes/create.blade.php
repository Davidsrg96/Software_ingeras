@extends('layoutGeneral')
@section('cuerpo')
    <div class="card" style="background-color: #FFFFFF;width: 100%" >
        @include('error_formulario')
        <div class="card-header">
            @if(isset($s))
                <h1 align="center">Editar Solicitud</h1>
            @else
                <h1 align="center">Agregar Solicitud</h1>
            @endif
        </div>
        <div class="card-body">
            <div class="col-md">
                <form role="form" method="POST" action="{{action('SolicitudController@store')}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    @if(isset($productos))
                        <input type="hidden" name="tipo_solicitud" value="Solicitud a bodega">
                        <input type="hidden" name="almacen_id" value="{{$almacen_local->id}}">
                    @endif
                    <table class="table table-striped table-hover" id="tabla_solicitud">
                        <tbody>
                        <tr>
                            <td>Título se la Solicitud</td>
                            <td><input placeholder="Titulo...." id="titulo" name="titulo" type="text" class="form-group"></td>
                        </tr>
                        <tr>
                            <td>Usuario</td>
                            <td>
                                <select id="destino" name="destino">
                                    <option value="0">--Seleccione--</option>
                                    @foreach($usuarios as $u)
                                        <option value="{{$u->id}}">{{$u->Nombre}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Fecha limite</td>
                            <td><input type="date" id="fecha_limite" name="fecha_limite" class="form-group"></td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="col-8">
                        <label for="mensaje"><font color="black">Mensaje</font></label><br>
                        <textarea cols="120" id="mensaje" name="mensaje" rows="10"></textarea>
                    </div>
                    <div class="row">
                        <a href="{{ route('solicitudes.index') }}" class="btn btn-primary" >Atrás</a>
                        <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary" data-toggle="modal">Agregar</a>
                    </div>
                    @include('pop-up')
                </form>

            </div>
        </div>
        @if(isset($almacenes))
            <div class="card-footer">
                <h1 align="center">Productos en stock en Bodega Central</h1>
                <table class="table table-hover table-striped" id="tabla_bodega">
                    <thead>
                    <tr>
                        <th width="20px">ID</th>
                        <th>Nombre del Producto</th>
                        <th>Codigo</th>
                        <th>Proveedor</th>
                        <th>Cantidad Almacenada</th>
                        <th>Almacen</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($productos as $p)
                        <tr>
                            <td>{{$p->id}}</td>
                            <td>{{$p->Nombre_producto}}</td>
                            <td>{{$p->Codigo}}</td>
                            <td>{{$p->Nombre_proveedor}}</td>
                            <td>{{$p->Cantidad_almacenada}}</td>
                            <td>{{$p->Nombre}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @elseif(isset($productos))
            <div class="card-footer">
                <h1 align="center">Productos en stock en Bodega Central</h1>
                <table class="table table-hover table-striped" id="tabla_bodega">
                    <thead>
                    <tr>
                        <th width="20px">ID</th>
                        <th>Nombre del Producto</th>
                        <th>Codigo</th>
                        <th>Precio del Producto</th>
                        <th>Cantidad</th>
                        <th>Disponible</th>
                        <th>Calidad</th>
                        <th>Proveedor</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($productos as $p)
                        <tr>
                            <td>{{$p->id}}</td>
                            <td>{{$p->Nombre_producto}}</td>
                            <td>{{$p->Codigo}}</td>
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
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    <script src="jquery-3.4.1.min.js" ></script>
    <script>
        $(document).ready(function() {
            var table = $('#tabla_bodega').DataTable();
        });
        function ShowSelected()
        {
            var tipo = document.getElementById("destino").value;
            var fecha_limite = document.getElementById('fecha_limite').value;
        }
    </script>
@endsection
