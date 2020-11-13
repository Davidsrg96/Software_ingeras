@extends('layoutGeneral')
@section('estilos')
@endsection
@section('acciones')
    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("buscar");
            filter = input.value.toUpperCase();
            table = document.getElementById("tabla_depto");
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
@section('cuerpo')
    <div style="color: #abdde5" align="center">
        <p></p>
        <h1> Listado de Departamentos</h1>
        <div class="row">
            <div class="column" align="left" style="padding-left: 1.5%">
                <a type="button" class="btn btn-primary" href="/" role="button"><i class="fas fa-arrow-left"></i> Regresar</a>
                <a href="{{route('departamentos.create')}}" type="button" class="btn btn-primary pull-right" > Agregar Departamento</a>
                <input type="text" id="buscar" onkeyup="myFunction()" placeholder="Buscar por nombre" title="Type in a name">
            </div>
            <table class="table table-hover table-striped" id="tabla_depto">
                <thead>
                <tr>
                    <th width="20px">ID</th>
                    <th>Nombre del Departamento</th>
                    <th>Objetivo</th>
                </tr>
                <tbody>
                @foreach($departamentos as $d)
                    <tr>
                        <td>{{$d->id}}</td>
                        <td>{{$d->Nombre_departamento}}</td>
                        <td>{{$d->Objetivo}}</td>
                        <td>
                            <a href="{{action('DepartamentosController@show', $d->id)}}"
                               class="btn btn-primary active" title="Ver actividades del Departamento">
                                <i class="fas fa-eye"> Visualizar</i>
                            </a>
                        </td>
                        <td>
                            <a href="{{action('DepartamentosController@edit', $d->id)}}"
                               class="btn btn-primary active" title="Editar Departamento">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                        </td>
                        <td>
                            <a data-target="#del{{$d->id}}" class="btn btn-danger active float-right" data-toggle="modal" title="Eliminar Departamento">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            <!--pop up confirmacion -->
                            <div class="modal fade" id="del{{$d->id}}">
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
                                            <a href="{{action('DepartamentosController@destroy',$d->id)}}"  class="btn btn-primary">Eliminar</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- endf pop up-->
                        </td>
                    </tr>
                @endforeach
                </tbody>
                </thead>
            </table>
        </div>
    </div>
@endsection
