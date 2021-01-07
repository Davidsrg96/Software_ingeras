@extends('layouts.app', [
    'namePage' => 'Lista trabajadores',
    'class' => 'sidebar-mini',
    'activePage' => 'Trabajadores',
])
@push('acciones')
    <script>
        $(document).ready(function() {
            var table = $('#tabla_trabajadores').DataTable({
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
                    <h2 class="title text-center">Trabajadores</h2>
                </div>
                <hr>
                <div class="card-body">
                    <table class="table-striped table-hover table" id="tabla_trabajadores">
                        <thead>
                        <tr>
                            <th width="20px">ID</th>
                            <th>Nombre</th>
                            <th>Rut</th>
                            <th>Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($trabajadores as $t)
                            <tr>
                                <td>{{$t->id}}</td>
                                <td>{{$t->Nombre}}</td>
                                <td>{{$t->Rut}}</td>
                                <td>
                                    <button type="button" class="btn btn-primary dropdown-toggle"
                                            data-toggle="dropdown">
                                        Acción <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#" class=" btn btn-primary" title="Editar tipo de usuario">
                                                <i class="fas fa-pencil-alt"></i>Editar</a>
                                        </li>
                                        <li>
                                            <a data-target="#del{{$t->id}}" class="btn btn-danger active" data-toggle="modal" title="Eliminar Producto">
                                                <i class="fas fa-trash-alt"></i>Eliminar</a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <!--pop up confirmacion -->
                            <div class="modal fade" id="del{{$t->id}}">
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
                                            <a href="{{action('TrabajadoresController@destroy',$t->id)}}"  class="btn btn-primary">Eliminar</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection