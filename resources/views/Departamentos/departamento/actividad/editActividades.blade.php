@extends('layoutGeneral')
@section('titulo', 'Editar Actividades Departamento')
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
    <script src="{{ asset('componentes/autocomplete/js/custom2.js') }}"></script>

    <script>

        var actividades = @json($actividades);
        var nombre      = document.getElementById('Nombre_actividad');
        var descripcion = document.getElementById('Descripcion');
        var kpi         = document.getElementById('valorKPI');
        var id          = document.getElementById('actividadID');

        autocomplete(nombre,descripcion,kpi,id,actividades);

        $('#Nombre_actividad').on('keyup', function(){
            $('#Descripcion').removeAttr('readonly');
            $('#valorKPI').removeAttr('readonly');
            $('#actividadID').val('0');
            var nombreAct = $('#Nombre_actividad').val();
            if(nombreAct != 0){
                var url = '{{ route("ajax.departamento.actividad", ":nombreAct") }}';
                url = url.replace(':nombreAct', nombreAct);
                $.get(url, function(data) {
                    if (Object.keys(data).length != 0) {
                        $('#Descripcion').attr({'readonly' : 'readonly'});
                        $('#valorKPI').attr({'readonly' : 'readonly'});
                        $('#actividadID').val(data.id);
                        $('#Descripcion').val(data.Descripcion);
                        $('#valorKPI').val(data.KPI);
                    }
                });
            }
        });

        //boton eliminar fila de la lista
        $(document).on('click', '.borrar', function (event) {
            if($("#actividadesTable tr").length > 1){
                $(this).closest('tr').remove();
            }
        });

        //Funcionalidad del boton agregar
        function agregarActividad(){
            //Toma los valores de las input
            var id  = document.getElementById('actividadID').value;
            var nom = document.getElementById('Nombre_actividad').value;
            var des = document.getElementById('Descripcion').value;
            var valkpi = document.getElementById('valorKPI').value;

            if( validarIgresoLista(nom, des,valkpi) ){
                //Reinicia los input
                document.getElementById('actividadID').value = "";
                document.getElementById('Nombre_actividad').value = "";
                document.getElementById('Descripcion').value = "";
                document.getElementById('valorKPI').value = "";
                document.getElementById("Descripcion").readOnly = false;
                document.getElementById("valorKPI").readOnly = false;

                //Se crea la fila
                var bodyTable = '<td hidden>'+ id  +'</td>' +
                    '<td id="nombreAct">' + nom.charAt(0).toUpperCase() + nom.substr(1) +'</td>'+
                    '<td id="descripcion">' + des.charAt(0).toUpperCase() + des.substr(1) +'</td>'+
                    '<td id="kpi">' + valkpi  +'</td>' +
                    '<td><a class="borrar btn btn-danger" title="Eliminar Usuario"><i class="fas fa-trash-alt" style="color: white"></i></a>';
                //Se agrega la fila creada a la tabla
                document.getElementById("actividadesTable").insertRow(-1).innerHTML = bodyTable;
            }
        }


        //funcion que crea la lista de actividades
        function listaActividades(){
            for(var j = 1; j < document.getElementById("actividadesTable").rows.length; j++){
                var idT = document.getElementById("actividadesTable").rows[j].cells[0].innerHTML;
                var nombreT = document.getElementById("actividadesTable").rows[j].cells[1].innerHTML;
                var descripcionT = document.getElementById("actividadesTable").rows[j].cells[2].innerHTML;
                var kpiT = document.getElementById("actividadesTable").rows[j].cells[3].innerHTML;
                $('<input>').attr({
                    type: 'hidden',
                    id: 'idT',
                    name: 'idT[]',
                    value : idT
                }).appendTo('form');
                $('<input>').attr({
                    type: 'hidden',
                    id: 'nombreT',
                    name: 'nombreT[]',
                    value : nombreT
                }).appendTo('form');
                $('<input>').attr({
                    type: 'hidden',
                    id: 'descripcionT',
                    name: 'descripcionT[]',
                    value : descripcionT
                }).appendTo('form');
                $('<input>').attr({
                    type: 'hidden',
                    id: 'kpiT',
                    name: 'kpiT[]',
                    value : kpiT
                }).appendTo('form');
            }
        }

        //funcion que valida los datos ingresados del participante
        function validarIgresoLista(nombre, descripcion, kpi){
            if(nombre == "" || descripcion == "" || kpi ==""){
                mensaje = 'Los campos nombre, descripción y kpi son obligatorios';
                $("#mensaje").html(mensaje);
                $('#error').modal('show');
                return false;
            }else{
                if(isNaN(kpi)){
                    mensaje = 'El campo kpi debe ser numerico';
                    $("#mensaje").html(mensaje);
                    $('#error').modal('show');
                    return false;
                }else{
                    var flagExiste = false;
                    for(var j = 1; j < document.getElementById("actividadesTable").rows.length; j++){
                        var nombre = document.getElementById("actividadesTable").rows[j].cells[1].innerHTML;
                        if(document.getElementById("Nombre_actividad").value == nombre){
                            flagExiste = true;
                            break;
                        }
                    }
                    if(flagExiste){
                        mensaje = 'Esta actividad ya ha sido ingresado en la lista';
                        $("#mensaje").html(mensaje);
                        $('#error').modal('show');
                    return false;
                    }else{
                        if(kpi < 0){
                            mensaje = 'El campo kpi debe ser mayor a 0';
                            $("#mensaje").html(mensaje);
                            $('#error').modal('show');
                            return false;
                        }
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
                Actividades del Departamento {{ $depto->Nombre_departamento }}
            </font></h1>
        </div>
        <form
            name="update"
            method="POST"
            action="{{ route('departamento.actividades.update', $depto->id) }}" 
            class="form-horizontal form-label-left"
            autocomplete="off"
            enctype="multipart/form-data"
            onsubmit="return listaActividades();">
                @csrf
                <div class="row" style="padding: 20px">
                    <div class="col-md-5">
                        <div class="card-body">
                            <div class="form-group{{ $errors->has('Nombre_actividad') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">
                                    Actividad<span class="required">*</span></label>
                                </label>
                                <div class="col-md-8">
                                    <input placeholder="Ingrese nombre de actividad" id="Nombre_actividad" type="text" name="Nombre_actividad" class="form-control">
                                </div>
                                @if ($errors->has('Nombre_actividad'))
                                    <span class="col-md-8 col-md-offset-4 help-block">
                                        <strong>{{ $errors->first('Nombre_actividad') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Descripcion') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">
                                    Descripción<span class="required">*</span></label>
                                </label>
                                <div class="col-md-8">
                                    <input id="Descripcion" type="text" name="Descripcion" class="form-control" placeholder="Ingrese Descripcion">
                                </div>
                                @if ($errors->has('Descripcion'))
                                    <span class="col-md-8 col-md-offset-4 help-block">
                                        <strong>{{ $errors->first('Descripcion') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('valorKPI') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">
                                    KPI<span class="required">*</span></label>
                                </label>
                                <div class="col-md-8">
                                    <input id="valorKPI" type="number" name="valorKPI" class="form-control"
                                        placeholder="Ingrese valorKPI">
                                </div>
                                @if ($errors->has('valorKPI'))
                                    <span class="col-md-8 col-md-offset-4 help-block">
                                        <strong>{{ $errors->first('valorKPI') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <input hidden type="text" id="actividadID" value="0">
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
                           <table class="table table-hover table-striped" id="actividadesTable">
                                <thead>
                                <tr>
                                    <th>Actividad</th>
                                    <th>Descripción</th>
                                    <th>KPI</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($depto->actividades as $actividad)
                                    <tr>
                                        <td hidden>{{ $actividad->id }}</td>'
                                        <td id="nombreAct">{{$actividad->Nombre_actividad}}</td>
                                        <td id="descripcion">{{$actividad->Descripcion}}</td>
                                        <td id="kpi">{{$actividad->KPI }}</td>
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
