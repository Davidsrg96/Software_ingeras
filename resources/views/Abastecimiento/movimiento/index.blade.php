@extends('layoutGeneral')
@section('titulo', 'Lista Bodegas')
@push('estilos')
<style>
    .modal-body {
       max-height:500px;
       overflow:auto;
    }
</style>
@endpush
@push('acciones')
    <script>
        $(document).ready(function() {
            var table = $('#tabla_bodega').DataTable({
                language: {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
        });

        $('#productos').on('show.bs.modal', function () {
            $('.modal-content').css('height',$( window ).height()*0.8);
        });

        //Toaster
        @if(Session::has('success'))
            mensajeEmergente('{{ Session::get('success')['titulo'] }}', '{{ Session::get('success')['mensaje'] }}');
        @endif
        @if(Session::has('fail'))
            mensajeEmergente('{{ Session::get('fail')['titulo'] }}', '{{ Session::get('fail')['mensaje'] }}', 'error');
        @endif
    </script>
@endpush
@section('cuerpo')
    <div class="card">
        <div class="card-header">
            @include('error_formulario')
            <h1 align="center"><font color="black">Bodegas</font></h1>
        </div>
        <div class="card-body col-md-10 offset-1">
            <div align="left" style="padding-left: 1.5%">
                <a type="button" class="btn btn-primary" href="{{ route('home.index') }}" role="button"><i class="fas fa-arrow-left"></i> Regresar</a>
            </div>
            <hr>
            <table class="table table-hover table-striped" id="tabla_bodega">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Ubicación</th>
                    <th>Acción</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($bodegas as $bodega)
                        <tr>
                            <td>{{$bodega->Nombre}}</td>
                            <td>{{$bodega->Ubicacion}}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" role="button"  class="btn btn-warning" title="Mostrar Productos"
                                        data-toggle="modal" data-target="#productos">
                                            <i class="fas fa-eye" style="color: white"></i>Productos
                                    </button>
                                    <button type="button" role="button" class="btn btn-primary"
                                        data-toggle="modal" data-target="#bodega{{$bodega->id}}">
                                            Enviar productos
                                    </button>
                                </div>
                            </td>
                            @include('Abastecimiento.partials.bodegaDestino')
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="productos" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Lista de Productos</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            @if(!$bodega->productos->isEmpty())
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Nombre</th>
                                            <th>Stock</th>
                                            <th>Calidad</th>
                                            <th>Proveedor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bodega->productos as $producto)
                                            <tr>
                                                <td>{{ $producto->Codigo }}</td>
                                                <td>{{ $producto->Nombre_producto }}</td>
                                                <td>{{ $producto->pivot->Cantidad_almacenada }}</td>
                                                <td>{{ $producto->Calidad }}</td>
                                                <td>{{ $producto->proveedor->Nombre_proveedor }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p style="color: black">La bodega no tiene productos asignados</p>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Salir</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection