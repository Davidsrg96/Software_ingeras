@extends('layouts.app', [
    'namePage' => 'Lista de ordenes de compra',
    'class' => 'sidebar-mini',
    'activePage' => 'Orden de Compra',
])
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
            var table = $('#tabla_ordenes').DataTable({
                language: {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "lengthMenu": "",
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

            var contador = 1;
            @foreach($ordenes as $orden)
                @if( !$orden->productos->isEmpty() )
                    @foreach($orden->productos as $key => $producto)
                        @if($key > 0)
                            @if( $orden->productos[$key-1]->Descripcion != $producto->Descripcion)
                                var bodyTable ='<td>' + '{{ $orden->productos[$key-1]->Codigo }}' +'</td>'+
                                '<td>' + '{{ $orden->productos[$key-1]->Descripcion }}' +'</td>'+
                                '<td>' + contador +'</td>';
                                document.getElementById("tabla_productos{{ $orden->id }}").insertRow(-1).innerHTML = bodyTable;
                                contador = 1;
                            @else
                                contador++;
                            @endif
                        @endif
                    @endforeach
                    var bodyTable ='<td>' + '{{ $orden->productos->last()->Codigo }}' +'</td>'+
                    '<td>' + '{{ $orden->productos->last()->Descripcion }}' +'</td>'+
                    '<td>' + contador +'</td>';
                    document.getElementById("tabla_productos{{ $orden->id }}").insertRow(-1).innerHTML = bodyTable;
                    contador = 1;
                @endif
            @endforeach
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
    <div class="panel-header panel-header-sm"></div>
    <div class="content col-md-10 offset-1">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h2 class="title text-center">Ordenes de Compra</h2>
                </div>
                <hr>
                <div class="card-body">
                    <a type="button" class="btn btn-primary" href="{{ route('home') }}" role="button">
                        <i class="fas fa-arrow-left"></i> Regresar
                    </a>
                    <a href="{{ route('orden_de_compra.create') }}" type="button" class="btn btn-success">
                        Agregar Orden
                    </a>
                    <table class="table table-hover table-striped" id="tabla_ordenes">
                        <thead>
                            <tr>
                                <th>Número</th>
                                <th>Proveedor</th>
                                <th>Fecha de ingreso</th>
                                <th>Productos</th>
                                <th class="text-medio">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $ordenes as $dato )
                                <tr>
                                    <td>{{ $dato->Numero }}</td>
                                    <td>{{ $dato->proveedor->Nombre_proveedor }}</td>
                                    <td>{{ date('d-m-Y', strtotime($dato->Fecha_ingreso)) }}</td>
                                    <td>
                                        <button role="button"  class="btn btn-info btn-round btn-block" title="Mostrar Productos"
                                            data-toggle="modal" data-target="#productos{{ $dato->id }}">
                                                {{ $dato->productos->count() }}
                                        </button>
                                    </td>
                                    <td class="text-medio">
                                        <form
                                            method="POST"
                                            action="{{ route('orden_de_compra.destroy', $dato->id) }}"
                                            style='display:inline-flex'>
                                                @csrf
                                                @method('DELETE')
                                                <div class="btn-group">
                                                    <a href="{{route('orden_de_compra.edit', $dato->id)}}"
                                                        class="btn btn-primary btn-round" title="Editar Usuario">
                                                            <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a href="{{route('orden_de_compra.show', $dato->id)}}"
                                                        class="btn btn-warning" title="Mostrar Usuario">
                                                            <i class="fas fa-eye" style="color: white"></i>
                                                    </a>
                                                    <a href="" data-target="#del{{$dato->id}}" class="btn btn-danger btn-round" 
                                                        data-toggle="modal" title="Eliminar Usuario">
                                                            <i class="fas fa-trash-alt" style="color: white"></i>
                                                    </a>
                                                </div>
                                                @include('layouts.pop-up.confirmacionDelete')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('Orden_compra.partials.modalProductos')
                </div>
            </div>
        </div>
    </div>
@endsection