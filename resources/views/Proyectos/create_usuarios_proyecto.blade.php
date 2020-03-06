@extends('layoutGeneral')
@section('cuerpo')
    <style>
        input{
            width: 100%;
        }
    </style>
    <div class="card">
        <div class="card-header">
            <h1 align="center">Agregar Usuarios al Proyecto</h1>
        </div>
        <div class="card-body">
            <form action="{{route('proyectos.storeUsuarios',$proyecto->id)}}" role="form" method="POST" enctype="multipart/form-data">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th width="20px">ID</th>
                        <th>Nombre</th>
                        <th>Rut</th>
                        <th>% Asignacion Proyecto</th>
                        <th>% Total de usuario</th>
                    </tr>
                    </thead>
                    <tbody id="tabla_seleccion">

                    </tbody>
                </table>
                <div class="form-control">
                    <a href="{{ route('proyectos.usuarios',$proyecto->id) }}" class="btn btn-primary" >Atrás</a>
                    <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary" data-toggle="modal">Agregar Usuarios</a>
                </div>
                @include('pop-up')
            </form>
        </div>
        <div class="card-footer">
            <table class="table table-striped table-hover" id="tabla_usuarios">
                <thead>
                <th width="20px">ID</th>
                <th>Nombre</th>
                <th>Rut</th>
                <th>% Total de usuario</th>
                <th>Carga asignada</th>
                <th>Añadir</th>
                </thead>
                <tbody>
                @foreach($usuarios as $u)
                    <tr>
                        <td>{{$u->id}}</td>
                        <td>{{$u->Nombre}}</td>
                        <td>{{$u->Rut}}</td>
                        <td>{{$u->Carga_proyecto}}</td>
                        <td><input type="number" min="0" max="{{100-$u->Carga_proyecto}}" step="1" class="container" id="cant{{$u->id}}"></td>
                        <td><button type="button" class="btn">+</button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>

        $(document).ready(function(){
            var table = $('#tabla_usuarios').DataTable();

            //Extraccion de los datos de una fila
            table.on('click','.btn',function(){
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')){
                    $tr=$tr.prev('.parent');
                }
                var data = table.row($tr).data();
                console.log(data);
                var id = data[0];
                var nombre = data[1];
                var rut = data[2];
                var carga = data[3];
                var input = document.getElementById('cant'+id).value;
                var carga_total = carga + input;

                if(carga_total > 100) {
                    alert('La carga total excede al 100% del uso del usuario ' + nombre + ', ingrese una carga adecuada para el usuario');
                }else{
                    if(carga_total == 100){
                        //Eliminar la fila del usuario

                    }
                    var tabla = document.getElementById('tabla_seleccion');
                    tabla.insertAdjacentHTML("beforeend", "<tr style=\"background-color: white\">\n" +
                        "                    <td><input readonly type=\"text\" id=\"ids[]\" name=\"ids[]\" value=\"" + id +
                        "\"></td>\n" +
                        "                    <td><input readonly type=\"text\" id=\"nombres[]\" name=\"nombres[]\" value=\"" + nombre +
                        "\"></td>\n" +
                        "                    <td><input readonly type=\"text\" id=\"ruts[]\" name=\"ruts[]\" value=\"" + rut +
                        "\"></td>\n" +
                        "                    <td><input readonly type=\"number\" id=\"cargas[]\"  name=\"cargas[]\" value=\"" + input +
                        "\"></td>\n" +
                        "                    <td><input readonly type=\"number\" id=\"cargas_totales[]\"  name=\"cargas_totales[]\" value=\"" + carga_total +
                        "\"></td>\n" +
                        "                </tr>");


                }

            });
        });
    </script>
@endsection
