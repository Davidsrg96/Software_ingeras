@extends('layoutGeneral')
@section('cuerpo')
    <div class="card">
        <div class="card-header">
            <h1 align="center"><font color="black"> Preguntas</font></h1>
            <div class="column" align="left" style="padding-left: 1.5%">
                <a type="button" class="btn btn-primary" href="/home" role="button"><i class="fas fa-arrow-left"></i> Regresar</a>
                <a href="{{action('PreguntasController@create')}}" type="button" class="btn btn-primary pull-right" > Agregar Pregunta</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped" id="tabla_preguntas">
                <thead>
                <tr>
                    <th width="20px">ID</th>
                    <th>Pregunta</th>
                    <th>Tipo de pregunta</th>
                    <th>Acción</th>
                </tr>
                </thead>
                <tbody>
                @foreach($preguntas as $p)
                    <tr>
                        <td>{{$p->id}}</td>
                        <td>{{$p->Pregunta}}</td>
                        <td>{{$p->Tipo_pregunta}}</td>
                        <td>
                            <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown">
                                Accion <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{action('PreguntasController@edit', $p->id)}}" class=" btn btn-primary" title="Editar Pregunta">
                                        <i class="fas fa-pencil-alt"></i>Editar</a>
                                </li>
                                <li>
                                    <a data-target="#del{{$p->id}}" class="btn btn-danger active" data-toggle="modal" title="Eliminar Pregunta">
                                        <i class="fas fa-trash-alt"></i>Eliminar</a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <!--pop up confirmacion -->
                    <div class="modal fade" id="del{{$p->id}}">
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
                                    <a href="{{action('PreguntasController@destroy',$p->id)}}"  class="btn btn-primary">Eliminar</a>
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
            var table = $('#tabla_preguntas').DataTable();
        });
    </script>
@endsection
