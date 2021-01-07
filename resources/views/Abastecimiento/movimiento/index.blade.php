@extends('layouts.app', [
    'namePage' => 'Lista Bodegas',
    'class' => 'sidebar-mini',
    'activePage' => 'Despacho',
])
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
    <div class="panel-header panel-header-sm"></div>
    <div class="content col-md-10 offset-1">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    @include('error_formulario')
                    <h2 class="title text-center">Bodegas</h2>
                </div>
                <hr>
                <div class="card-body col-md-10 offset-1">
                    <a type="button" class="btn btn-primary" href="{{ route('home') }}" role="button">
                        <i class="fas fa-arrow-left"></i> Regresar
                    </a>
                    <table class="table table-hover table-striped" id="tabla_bodega">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Ubicación</th>
                                <th>Productos</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bodegas as $bodega)
                                <tr>
                                    <td>{{$bodega->Nombre}}</td>
                                    <td>{{$bodega->Ubicacion}}</td>
                                    <td>
                                        <button type="button" role="button"  class="btn btn-warning" title="Mostrar Productos"
                                            data-toggle="modal" data-target="#productos{{ $bodega->id }}">
                                                Mostrar <i class="fas fa-eye" style="color: white"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" role="button" class="btn btn-primary"
                                            data-toggle="modal" data-target="#bodega{{$bodega->id}}">
                                                Enviar productos
                                        </button>
                                    </td>
                                    @include('Abastecimiento.partials.bodegaDestino')
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @include('Abastecimiento.movimiento.partials.modalProductos')
                </div>
            </div>
        </div>
    </div>
@endsection