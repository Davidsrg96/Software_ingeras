@extends('layoutGeneral')
@section('cuerpo')
    <div class="card">
        <div class="card-header">
            <h1 align="center"><font color="black">Listado de Cargos</font></h1>
            <div class="column" align="left" style="padding-left: 1.5%">
                <a type="button" class="btn btn-primary" href="{{action('UsuariosController@index')}}" role="button"><i class="fas fa-arrow-left"></i> Regresar</a>
                <a href="{{action('CargosController@create')}}" type="button" class="btn btn-primary pull-right" > Agregar Cargo</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover" id="tabla_cargos">
                <thead>
                <tr>
                    <th width="20px">ID</th>
                    <th>Cargo</th>
                    <th>Descripción</th>
                    <th>Acción</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cargos as $c)
                    <tr>
                        <td>{{$c->id}}</td>
                        <td>{{$c->Tipo_cargo}}</td>
                        <td>{{$c->Descripcion}}</td>
                        <td>
                            <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown">
                                Acción <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{action('CargosController@edit', $c->id)}}" class=" btn btn-primary" title="Editar tipo de usuario">
                                        <i class="fas fa-pencil-alt"></i>Editar</a>
                                </li>
                                <li>
                                    <a data-target="#del{{$c->id}}" class="btn btn-danger active" data-toggle="modal" title="Eliminar Producto">
                                        <i class="fas fa-trash-alt"></i>Eliminar</a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <!--pop up confirmacion -->
                    <div class="modal fade" id="del{{$c->id}}">
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
                                    <a href="{{action('CargosController@destroy',$c->id)}}"  class="btn btn-primary">Eliminar</a>
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
            var table = $('#tabla_cargos').DataTable();
        });
    </script>
@endsection
