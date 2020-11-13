@extends('layoutGeneral')
@section('cuerpo')
    <div class="card">
        <div class="card-header">
            <h1 align="center"><font color="black"> Tipos de Usuarios</font></h1>
            <div class="column" align="left" style="padding-left: 1.5%">
                <a type="button" class="btn btn-primary" href="{{action('UsuariosController@index')}}" role="button"><i class="fas fa-arrow-left"></i> Regresar</a>
                <a href="{{action('TipoUsuarioController@create')}}" type="button" class="btn btn-primary pull-right" > Agregar Tipo de Usuario</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped" id="tabla_tipo_usuario">
                <thead>
                <tr>
                    <th width="20px">ID</th>
                    <th>Tipo de Usuario</th>
                    <th>Descripcion</th>
                    <th>Acción</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tipos_usuarios as $t)
                    <tr>
                        <td>{{$t->id}}</td>
                        <td>{{$t->Tipo_usuario}}</td>
                        <td>{{$t->Descripcion}}</td>
                        <td>
                            <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown">
                                Acción <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{action('TipoUsuarioController@edit', $t->id)}}" class=" btn btn-primary" title="Editar tipo de usuario">
                                        <i class="fas fa-pencil-alt"></i>Editar</a>
                                </li>
                                <li>
                                    <a data-target="#del{{$t->id}}" class="btn btn-danger active" data-toggle="modal" title="Eliminar tipo de usuario">
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
                                    <a href="{{action('TipoUsuarioController@destroy',$t->id)}}"  class="btn btn-primary">Eliminar</a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="jquery-3.4.1.min.js" ></script>
    <script>
        $(document).ready(function() {
            var table = $('#tabla_tipo_usuario').DataTable({
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
    </script>
@endsection
