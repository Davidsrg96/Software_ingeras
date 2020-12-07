@extends('layoutGeneral')
@section('titulo', 'Lista Facturas')
@push('estilos')
<style>
    .modal-body {
       max-height:500px;
       overflow:auto;
    }
    .text-medio{
        text-align: center;
    }
</style>
@endpush
@push('acciones')
    <script>
        $(document).ready(function() {
            var table = $('#tabla_facturas').DataTable({
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
            <h1 align="center"><font color="black">Facturas</font></h1>
            <div class="column" align="left" style="padding-left: 1.5%">
            </div>
        </div>
        <div class="card-body">
            <a type="button" class="btn btn-primary" href="{{ route('home.index') }}" role="button"><i class="fas fa-arrow-left"></i> Regresar</a>
            <a href="{{ route('factura.create') }}" type="button" class="btn btn-primary pull-right">
                Agregar Factura
            </a>
            <hr>
            <div class="col-md-12">
                <table class="table table-hover table-striped" id="tabla_facturas">
                    <thead>
                        <tr>
                            <th>Número</th>
                            <th>Proveedor</th>
                            <th>Fecha de ingreso</th>
                            <th>Estado</th>
                            <th style="width: 10%">Productos</th>
                            <th class="text-medio">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($facturas as $factura)
                            <tr>
                                <td>{{ $factura->Numero }}</td>
                                <td>{{ $factura->proveedor->Nombre_proveedor }}</td>
                                <td>{{ date('d/m/Y', strtotime($factura->Fecha_ingreso)) }}</td>
                                <td>{{ $factura->Estado }}</td>
                                <td>
                                    <button role="button"  class="btn btn-info btn-round" title="Mostrar Productos"
                                        data-toggle="modal" data-target="#productos{{ $factura->id }}">
                                            {{ $factura->productos->count() }}
                                    </button>
                                </td>
                                <td class="text-medio">
                                     <div class="btn-group">
                                        <a href="{{route('factura.edit', $factura->id)}}"
                                            class="btn btn-primary" title="Editar Usuario">
                                                <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="{{route('factura.show', $factura->id)}}"
                                            class="btn btn-warning" title="Mostrar Usuario">
                                                <i class="fas fa-eye" style="color: white"></i>
                                        </a>
                                        <a href="" data-target="#del{{$factura->id}}" class="btn btn-danger" 
                                            data-toggle="modal" title="Eliminar Usuario">
                                                <i class="fas fa-trash-alt" style="color: white"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @include('Facturas.partials.modalProductos')
        </div>
    </div>
@endsection
