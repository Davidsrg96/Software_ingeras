@extends('layouts.app', [
    'namePage' => 'Validar Factura',
    'class' => 'sidebar-mini',
    'activePage' => 'Facturas',
])
@push('estilos')
<style>
    tbody{
        display: block;
        border: 1px solid #F96332;
        height: 300px;
        overflow-y: scroll;
    }
    .validate{
        border: 1px solid #18ce0f;
    }
    .subtitulo{
        margin-top: 10px;
        font-size: 18px;
        color: #9A9A9A;
        font-weight: 600;
    }
    .separador{
        margin-top: 50px;
    }
    .borrar{
        opacity: .7;
    }
</style>
@endpush
@push('acciones')
<script>
    const $codigoProducto = document.querySelector("#codigoProducto");
    // Escuchamos el keydown y prevenimos el evento
    $codigoProducto.addEventListener("keydown", (evento) => {
        if (evento.key == "Enter") {
            // Prevenir
            addValidado();
            evento.preventDefault();
            return false;
        }
    });

    //elimina espacios
    $("#codigoProducto").keyup(function(){
        var letra = $("#codigoProducto").val().replace(/ /g, "");
        $("#codigoProducto").val(letra);
    });

    function addValidado(){
        var validar = document.getElementById("codigoProducto");
        for(var j = 0; j < document.getElementById("tabla_productosF").rows.length; j++){
            var codigo = document.getElementById("tabla_productosF").rows[j].cells[0].innerHTML;
            if( codigo == validar.value){
                var row = document.getElementById("tabla_productosF")
                var bodyTable ='<td>' + codigo +'</td>'+
                    '<td>' + row.rows[j].cells[1].innerHTML +'</td>'+
                    '<td><a class="borrar btn btn-danger" title="Borrar">-</a></td>' ;

                document.getElementById("tabla_validada").insertRow(-1).innerHTML = bodyTable;
                row.deleteRow(j);
                validar.value = "";

                if(document.getElementById("tabla_productosF").rows.length == 0){
                    $('#Estado').val("Completa");
                }
                return;
            }
        }
        mensaje = 'Codigo no encontrado';
        $("#mensaje").html(mensaje);
        $('#error').modal('show');
    }

    $(document).on('click', '.borrar', function (event) {
        if($("#tabla_validada tr").length > 0){
            var j = $(this).closest('tr');
            var row = document.getElementById("tabla_validada");
            var bodyTable ='<td>' + row.rows[j[0].rowIndex].cells[0].innerHTML  +'</td>'+
                '<td>' + row.rows[j[0].rowIndex].cells[1].innerHTML +'</td>';

            document.getElementById("tabla_productosF").insertRow(-1).innerHTML = bodyTable;
            j.remove();

            if($('#Estado').val() == "Completa"){
                $('#Estado').val("Gestionando");
            }
        }
    });

    function crearListas(){
        for(var j = 0; j < document.getElementById("tabla_productosF").rows.length; j++){
            var codigo = document.getElementById("tabla_productosF").rows[j].cells[0].innerHTML;
            var desc = document.getElementById("tabla_productosF").rows[j].cells[1].innerHTML;
            $('<input>').attr({
                type: 'hidden',
                id: 'codigoF',
                name: 'codigoF[]',
                value : codigo
            }).appendTo('form');
            $('<input>').attr({
                type: 'hidden',
                id: 'descF',
                name: 'descF[]',
                value : desc
            }).appendTo('form');
        }
        for(var j = 0; j < document.getElementById("tabla_validada").rows.length; j++){
            var codigo = document.getElementById("tabla_validada").rows[j].cells[0].innerHTML;
            var desc = document.getElementById("tabla_validada").rows[j].cells[1].innerHTML;
            $('<input>').attr({
                type: 'hidden',
                id: 'codigoV',
                name: 'codigoV[]',
                value : codigo
            }).appendTo('form');
            $('<input>').attr({
                type: 'hidden',
                id: 'descV',
                name: 'descV[]',
                value : desc
            }).appendTo('form');
        }
    }
    $(document).ready(function (){
        @if (old('Observacion'))
            $("#Observacion").val('{{ old('Observacion') }}');
        @endif
        @if (old('Estado'))
            $("#Estado").val('{{ old('Estado') }}');
            $("#Estado").change();
        @endif
        @if (old('codigoF'))
            for (var i = document.getElementById("tabla_productosF").rows.length - 1; i >= 0; i--) {
                document.getElementById("tabla_productosF").deleteRow(i);
            }
            @foreach( old('codigoF') as $key => $codigo)
                var bodyTable ='<td>' + '{{ $codigo }}' + '</td>'+
                    '<td>' + '{{ old('descF')[$key] }}' +'</td>';
                document.getElementById("tabla_productosF").insertRow(-1).innerHTML = bodyTable;
            @endforeach
        @endif
        @if (old('codigoV'))
            @foreach( old('codigoV') as $key => $codigo)
                var bodyTable ='<td>' + '{{ $codigo }}' + '</td>'+
                    '<td>' + '{{ old('descV')[$key] }}' +'</td>'+
                    '<td><a class="borrar btn btn-danger" title="Borrar">-</a></td>' ;
                document.getElementById("tabla_validada").insertRow(-1).innerHTML = bodyTable;
            @endforeach
        @endif
    });
</script>
@endpush
@section('cuerpo')
    <div class="panel-header panel-header-sm"></div>
    <div class="content col-md-10 offset-1">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    @include('error_formulario')
                    <h2 class="title text-center">Factura N° {{ $factura->Numero }}</h2>
                </div>
                <hr>
                <form
                    role="form"
                    method="POST"
                    action="{{ route('factura.validar.update', $factura->id) }}"
                    enctype="multipart/form-data"
                    onsubmit="return crearListas();">
                    @csrf
                    @method('PUT')
                        <div class="card-body offset-1">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('Estado') ? ' has-error' : '' }}">
                                        <label>Estado</label>
                                        <select class="form-control" id="Estado" name="Estado">
                                            <option value="Gestionando"
                                                {{ ($factura->Estado == "Gestionando") ? 'selected' : '' }}>
                                                    Gestionando
                                            </option>
                                            <option value="Incompleta"
                                                {{ ($factura->Estado == "Incompleta") ? 'selected' : '' }}>
                                                    Incompleta
                                            </option>
                                            <option value="Completa"
                                                {{ ($factura->Estado == "Completa") ? 'selected' : '' }}>
                                                    Completa
                                            </option>
                                        </select>
                                        @if ($errors->has('Estado'))
                                            <label>
                                                <span class="required form-error">
                                                    <strong>{{ $errors->first('Estado') }}</strong>
                                                </span>
                                            </label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 offset-1">
                                     <div class="form-group
                                         {{ $errors->has('Observacion') ? ' has-error' : '' }}">
                                        <label>Observacion</label>
                                        <textarea class="form-control" id="Observacion" name="Observacion">{{ $factura->Observacion }}</textarea>
                                        @if ($errors->has('Observacion'))
                                            <label>
                                                <span class="required form-error">
                                                    <strong>{{ $errors->first('Observacion') }}</strong>
                                                </span>
                                            </label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row separador">
                                <div class="col-md-5 text-center">
                                    <p class="subtitulo">Productos en factura</p>
                                    <table class="table" id="tabla_productosF">
                                        <tbody>
                                            @foreach($factura->productos as $producto)
                                                <tr>
                                                    <td>{{ $producto->Codigo }}</td>
                                                    <td>{{ $producto->Descripcion }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>                                  
                                </div>
                                <div class="col-md-5 offset-1 text-center">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Codigo producto</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input autofocus placeholder="Ingrese Codigo" type="text"
                                                id="codigoProducto"class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="button" class="btn btn-success btn-round"
                                                id="addProducto()" onClick="addValidado()"value="+" />
                                        </div>
                                    </div>
                                    <table class="table" id="tabla_validada">
                                        <tbody class="validate">
                                        </tbody>
                                    </table>                                  
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="card-footer col-md-4 offset-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ route('factura.show', $factura->id) }}"
                                        class="btn btn-danger btn-block">
                                            Atrás
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#confirmation" class="btn btn-success btn-block"
                                        data-toggle="modal">
                                            Guardar
                                    </a>
                                </div>
                            </div>
                            @include('pop-up')
                            @include('layouts.pop-up.error')
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
