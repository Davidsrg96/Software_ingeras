@extends('layouts.app', [
    'namePage' => 'Lista de Cargos',
    'class' => 'sidebar-mini',
    'activePage' => 'Cargos',
])
@push('estilos')
@endpush
@push('acciones')
    <script>
        $(document).ready(function() {
            var table = $('#tabla_cargos').DataTable({
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
                    <h2 class="title text-center">Cargos</h2>
                </div>
                <hr>
                <div class="card-body">
                    <a type="button" class="btn btn-primary" href="{{ route('home') }}" role="button">
                        <i class="fas fa-arrow-left"></i> Regresar
                    </a>
                    <a href="{{ route('cargos.create') }}" type="button" class="btn btn-success" >
                        Agregar Cargo
                    </a>
                    <table class="table table-hover table-striped" id="tabla_cargos">
                        <thead>
                        <tr>
                            <th>Cargo</th>
                            <th>Descripcion</th>
                            <th>Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($cargos as $dato)
                                <tr>
                                    <td>{{$dato->Tipo_cargo}}</td>
                                    <td>{{$dato->Descripcion}}</td>
                                    <td>
                                        <form
                                            method="POST"
                                            action="{{ route('cargos.destroy', $dato->id) }}"
                                            style='display:inline-flex'>
                                                @csrf
                                                @method('DELETE')
                                                
                                            <div class="btn-group">
                                                <a href="{{route('cargos.edit', $dato->id)}}"
                                                    class="btn btn-primary btn-round" title="Editar Tipo Usuario">
                                                        <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a href="" data-target="#del{{$dato->id}}" class="btn btn-danger btn-round" 
                                                    data-toggle="modal" title="Eliminar Usuario">
                                                        <i class="fas fa-trash-alt" style="color: white"></i>
                                                </a>
                                            </div>
                                            <!--pop up confirmacion -->
                                            @include('layouts.pop-up.confirmacionDelete')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
