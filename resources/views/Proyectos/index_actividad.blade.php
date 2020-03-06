@extends('layoutGeneral')
@section('cuerpo')
    <div style="color: #abdde5" align="center">
        <p></p>
        <div class="row">
            <h1>Listado de Actividades del área {{$actividad[0]->Nombre_area}} del proyecto {{$actividad[0]->Nombre_proyecto}}</h1>
            <div class="column" align="left" style="padding-left: 1.5%">
                <a type="button" class="btn btn-primary" href="/" role="button"><i class="fas fa-arrow-left"></i> Regresar</a>
                <a href="{{route('actividades.create',[$actividad[0]->proyecto_id,$actividad[0]->area_proyecto_id])}}" type="button" class="btn btn-primary pull-right" > Agregar Actividad</a>
                <input type="text" id="buscar" onkeyup="myFunction()" placeholder="Buscar por nombre" title="Type in a name">
            </div>
            <table class="table table-hover table-striped" id="tabla_usuario">
                <thead style="background-color: #ff7200 ">
                <tr>
                    <th width="20px">ID</th>
                    <th>Nombre de la actividad</th>
                    <th>Descripción</th>
                    <th>Evaluación</th>
                    <th>Proyecto</th>
                    <th>Area de Proyecto</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
                </thead>
                <tbody style="background-color: #a9a9a9">
                @foreach($actividad as $act)
                    <tr>
                        <td>{{$act->id}}</td>
                        <td>{{$act->Nombre_actividad}}</td>
                        <td>{{$act->Descripcion}}</td>
                        <td>{{$act->Evaluacion}}</td>
                        @foreach($cualidades as $c)
                            @if($c->id == $act->cualidad_id)
                                <td>{{$c->Nombre}}</td>
                            @endif
                        @endforeach
                        <td>{{$act->Nombre_proyecto}}</td>
                        <td>{{$act->Nombre_area}}</td>
                        <td>
                            <a href="{{action('ActividadesProyectosController@edit', [$act->id,$act->proyecto_id,$act->area_proyecto_id])}}"
                               class="btn btn-primary active" title="Editar Actividad">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                        </td>
                        <td>
                            <a data-target="#del{{$act->id}}" class="btn btn-danger active float-right" data-toggle="modal" title="Eliminar Actividad">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            <!--pop up confirmacion -->
                            <div class="modal fade" id="del{{$act->id}}">
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
                                            <a href="{{action('ActividadesProyectosController@destroy',[$act->id,$act->proyecto_id,$act->area_proyecto_id])}}"  class="btn btn-primary">Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- endf pop up-->
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("buscar");
            filter = input.value.toUpperCase();
            table = document.getElementById("tabla_actividad");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
@endsection
