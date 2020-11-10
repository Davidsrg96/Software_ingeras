@extends('layoutGeneral')
@section('cuerpo')
    <div class="card">
        <div class="card-header">
            <h1 align="center">Trabajadores</h1>
        </div>
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
                                <li><a href="{{action('TrabajadoresController@edit', $t->id)}}" class=" btn btn-primary" title="Editar tipo de usuario">
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
    <script>
        $(document).ready(function() {
            var table = $('#tabla_trabajadores').DataTable();
        });
    </script>
@endsection