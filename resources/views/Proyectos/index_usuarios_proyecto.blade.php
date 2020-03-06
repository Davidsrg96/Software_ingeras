@extends('layoutGeneral')
@section('cuerpo')
    <div class="card">
        <div class="card-header">
            <h1 align="center">Usuarios del Proyecto {{$proyecto->Nombre_proyecto}}</h1>
            <a type="button" class="btn btn-primary" href="{{action('ProyectosController@show',$proyecto->id)}}" role="button"><i class="fas fa-arrow-left"></i> Regresar</a>
            <a href="{{route('proyectos.asignacion',$proyecto->id)}}" type="button" class="btn btn-primary pull-right" > Agregar usuario</a>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped" id="tabla_usuarios">
                <thead>
                <tr>
                    <th width="20px">ID</th>
                    <th>Nombre</th>
                    <th>Rut</th>
                    <th>% Asignacion a proyecto</th>
                    <th>% Total de usuario</th>
                    <th>Acción</th>
                </tr>
                </thead>
                <tbody>
                @foreach($usuarios as $u)
                    <tr>
                        <td>{{$u->id}}</td>
                        <td>{{$u->Nombre}}</td>
                        <td>{{$u->Rut}}</td>
                        <td>{{$u->Carga}}</td>
                        <td>{{$u->Carga_proyecto}}</td>
                        <td>
                            <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown">
                                Acción <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a data-target="#del{{$u->id}}" class="btn btn-danger active" data-toggle="modal" title="Eliminar tipo de usuario">
                                        <i class="fas fa-trash-alt"></i>Eliminar del Proyecto</a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <!--pop up confirmacion -->
                    <div class="modal fade" id="del{{$u->id}}">
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
                                    <a href="{{action('TipoUsuarioController@destroy',$u->id)}}"  class="btn btn-primary">Eliminar</a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
