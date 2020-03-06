@extends('layoutGeneral')
@section('cuerpo')
    <div style="color: #abdde5" align="center">
        <p></p>
        <h1> Listado de actividades del Departamento de {{$d->Nombre_departamento}}</h1>
        <div class="row">
            <div class="column" align="left" style="padding-left: 1.5%">
                <a type="button" class="btn btn-primary" href="{{action('DepartamentosController@show', $d->id)}}" role="button"><i class="fas fa-arrow-left"></i> Regresar</a>
                <a href="{{route('actividadesdepto.crear', $d->id)}}" type="button" class="btn btn-primary pull-right" > Agregar Actividad</a>
                <input type="text" id="buscar" onkeyup="myFunction()" placeholder="Buscar por nombre" title="Type in a name">
            </div>
            <table class="table table-hover table-striped" id="tabla_actividad">
                <thead>
                <tr>
                    <th width="20px">ID</th>
                    <th>Nombre de la Actividad</th>
                    <th>Descripcion</th>
                    <th>KPI</th>
                </tr>
                </thead>
                <tbody>
                @foreach($act as $act)
                    <tr>
                        <td>{{$act->id}}</td>
                        <td>{{$act->Nombre_actividad}}</td>
                        <td>{{$act->Descripcion}}</td>
                        <td>{{$act->KPI}}</td>
                        <td>
                            <a href="{{route('actividadesdepto.edit', [$act->id,$d->id])}}"
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
                                            <a href="{{route('actividadesdepto.eliminar',[$act->id, $d->id])}}"  class="btn btn-primary">Eliminar</a>
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
