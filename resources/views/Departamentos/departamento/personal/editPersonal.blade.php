@extends('layoutGeneral')
@section('titulo', 'Editar Personal Departamento')
@push('estilos')
    <!-- Autocomplete -->
    <link href="{{ asset('componentes/autocomplete/css/custom.css') }}" rel="stylesheet">
    <style>
        .let tr {
            text-transform: lowercase;
        }

        .let tr:first-letter {
            text-transform: uppercase;
        }
    </style>   
@endpush
@push('acciones')
    <!-- Autocomplete -->
    <script src="{{ asset('componentes/autocomplete/js/personal.js') }}"></script>

    <script>

        var personal = @json($personal);
        var nombre   = document.getElementById('Nombre');
        var rut      = document.getElementById('Rut');
        var id       = document.getElementById('usuarioID');

        autocomplete(nombre,rut,id,personal,'nombre');
        autocomplete(rut,nombre,id,personal,'rut');

        $('#Nombre').on('keyup', function(){
            $('#Rut').removeAttr('readonly');
            $('#usuarioID').val('0');
            var nombreUser = $('#Nombre').val();
            if(nombreUser != 0){
                var url = '{{ route("ajax.departamento.personal.nombre", ":nombreUser") }}';
                url = url.replace(':nombreUser', nombreUser);
                $.get(url, function(data) {
                    if (Object.keys(data).length != 0) {
                        $('#Rut').attr({'readonly' : 'readonly'});
                        $('#usuarioID').val(data.id);
                        $('#Rut').val(data.rut);
                    }
                });
            }
        });

        $('#Rut').on('keyup', function(){
            $('#Nombre').removeAttr('readonly');
            $('#usuarioID').val('0');
            var rutUser = $('#Rut').val();
            if(rutUser != 0){
                var url = '{{ route("ajax.departamento.personal.rut", ":rutUser") }}';
                url = url.replace(':rutUser', rutUser);
                $.get(url, function(data) {
                    if (Object.keys(data).length != 0) {
                        $('#Nombre').attr({'readonly' : 'readonly'});
                        $('#usuarioID').val(data.id);
                        $('#Nombre').val(data.nombre);
                    }
                });
            }
        });

        //boton eliminar fila de la lista
        $(document).on('click', '.borrar', function (event) {
            if($("#personalTable tr").length > 1){
                $(this).closest('tr').remove();
            }
        });

        //Funcionalidad del boton agregar
        function agregarActividad(){
            //Toma los valores de las input
            var userID  = document.getElementById('usuarioID').value;
            var nom = document.getElementById('Nombre').value;
            var rutE = document.getElementById('Rut').value;

            if( validarIgresoLista(nom, rutE, userID) ){
                //Reinicia los input
                document.getElementById('usuarioID').value = 0;
                document.getElementById('Nombre').value = "";
                document.getElementById('Rut').value = "";
                document.getElementById("Rut").readOnly = false;
                $('#Nombre').removeAttr('readonly');

                //Se crea la fila
                var bodyTable = '<td hidden>'+ userID  +'</td>' +
                    '<td id="nombreAct">' + rutE +'</td>'+
                    '<td id="descripcion">' + nom.charAt(0).toUpperCase() + nom.substr(1) +'</td>'+
                    '<td><a class="borrar btn btn-danger" title="Eliminar Usuario"><i class="fas fa-trash-alt" style="color: white"></i></a>';
                //Se agrega la fila creada a la tabla
                document.getElementById("personalTable").insertRow(-1).innerHTML = bodyTable;
            }
        }


        //funcion que crea la lista de actividades
        function listaPersonal(){
            for(var j = 1; j < document.getElementById("personalTable").rows.length; j++){
                var idL = document.getElementById("personalTable").rows[j].cells[0].innerHTML;
                $('<input>').attr({
                    type: 'hidden',
                    id: 'idL',
                    name: 'idL[]',
                    value : idL
                }).appendTo('form');
            }
        }

        //funcion que valida los datos ingresados del participante
        function validarIgresoLista(nombre, rut, userID){
            if(nombre == "" || rut == ""){
                mensaje = 'Los campos nombre y rut son obligatorios';
                $("#mensaje").html(mensaje);
                $('#error').modal('show');
                return false;
            }else{
                if( userID == 0 ){
                    mensaje = 'Usuario no se encuentra registrado';
                    $("#mensaje").html(mensaje);
                    $('#error').modal('show');
                    return false;
                }else{
                    var flagExiste = false;
                    for(var j = 1; j < document.getElementById("personalTable").rows.length; j++){
                        var id = document.getElementById("personalTable").rows[j].cells[0].innerHTML;
                        if(userID == id){
                            flagExiste = true;
                            break;
                        }
                    }
                    if(flagExiste){
                        mensaje = 'Este usuario ya ha sido ingresado en la lista';
                        $("#mensaje").html(mensaje);
                        $('#error').modal('show');
                    return false;
                    }
                }
            }
            return true;
        }

    </script>
@endpush
@section('cuerpo')
    <div class="card">
        <div class="card-header">
            <h1 align="center"><font color="black">
                Personal del Departamento {{ $depto->Nombre_departamento }}
            </font></h1>
        </div>
        <form
            name="update"
            method="POST"
            action="{{ route('departamento.personal.update', $depto->id) }}" 
            class="form-horizontal form-label-left"
            autocomplete="off"
            enctype="multipart/form-data"
            onsubmit="return listaPersonal();">
                @csrf
                <div class="row" style="padding: 20px">
                    <div class="col-md-5">
                        <div class="card-body">
                            <div class="form-group{{ $errors->has('Nombre') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">
                                    Nombre<span class="required">*</span></label>
                                </label>
                                <div class="col-md-8">
                                    <input placeholder="Ingrese nombre del usuario" id="Nombre" type="text" 
                                        class="form-control">
                                </div>
                                @if ($errors->has('Nombre'))
                                    <span class="col-md-8 col-md-offset-4 help-block">
                                        <strong>{{ $errors->first('Nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Rut') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">
                                    Rut<span class="required">*</span></label>
                                </label>
                                <div class="col-md-8">
                                    <input id="Rut" type="text" class="form-control" placeholder="Ingrese Rut">
                                </div>
                                @if ($errors->has('Rut'))
                                    <span class="col-md-8 col-md-offset-4 help-block">
                                        <strong>{{ $errors->first('Rut') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <input hidden type="text" id="usuarioID" value="0">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <a style="color: white" class="btn btn-warning" onClick="agregarActividad();">
                                        Agregar
                                    </a>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <a href="{{ route('departamentos.edit', $depto->id) }}" class="btn btn-primary" >Atrás</a>
                                <a href="#confirmation" class="btn btn-success"
                                    data-toggle="modal">Editar
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                           <table class="table table-hover table-striped" id="personalTable">
                                <thead>
                                <tr>
                                    <th>Rut</th>
                                    <th>Nombre</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($depto->personal as $usuario)
                                    <tr>
                                        <td hidden>{{ $usuario->id }}</td>'
                                        <td id="descripcion">{{$usuario->Rut}}</td>
                                        <td id="nombreAct">{{$usuario->Nombre}}</td>
                                        <td>
                                            <a class="borrar btn btn-danger" title="Eliminar Usuario">
                                                <i class="fas fa-trash-alt" style="color: white"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
                @include('pop-up')
                @include('layouts.pop-up.error')
        </form>
    </div>
@endsection
