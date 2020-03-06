@extends('layoutGeneral')
@section('cuerpo')
    <div style="color: #111111 " align="center">
        <p></p>
        <h1> Áreas del Proyecto </h1>
        <div class="row">
            <div class="column" align="left" style="padding-left: 1.5%">
                <a type="button" class="btn btn-primary" href="{{route('proyectos.show', $areas[0]->proyecto_id)}}" role="button"><i class="fas fa-arrow-left"></i> Regresar</a>
                <a href="{{route('area.create',$areas[0]->proyecto_id)}}" type="button" class="btn btn-primary pull-right" > Agregar Área</a>
                <input type="text" id="buscar" onkeyup="myFunction()" placeholder="Buscar por nombre" title="Type in a name">
            </div>
            <table class="table table-hover table-striped table-bordered" id="tabla_area">
                <thead style="background-color: #ff7200 ">
                <tr>
                    <th width="20px">ID</th>
                    <th>Nombre del Area</th>
                    <th>Porcentaje asignado</th>
                    <th>Personal</th>
                    <th>Proyecto</th>
                    <th>Ver</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
                </thead>
                <tbody style="background-color: #a9a9a9">
                @foreach($areas as $a)
                    <tr>
                        <td>{{$a->id}}</td>
                        <td>{{$a->Nombre_area}}</td>
                        <td>{{$a->Porcentaje_asignado}}%</td>
                        <td>{{$a->Personal}}</td>
                        <td>{{$proyecto->Nombre_proyecto}}</td>
                        <td>
                            <a href="{{action('AreaProyectosController@show', [$a->proyecto_id, $a->id])}}"
                               class="btn btn-primary active" title="Ver areas del Proyecto">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                        <td>
                            <a href="{{action('AreaProyectosController@edit',[$a->proyecto_id, $a->id])}}"
                               class="btn btn-primary active" title="Editar Area">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                        </td>
                        <td>
                            <a data-target="#del{{$a->id}}" class="btn btn-danger active float-right" data-toggle="modal" title="Eliminar Area">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            <!--pop up confirmacion -->
                            <div class="modal fade" id="del{{$a->id}}">
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
                                            <a href="{{action('AreaProyectosController@destroy',[$a->proyecto_id, $a->id])}}"  class="btn btn-primary">Eliminar</a>
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
            table = document.getElementById("tabla_area");
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
