@extends('layoutGeneral')
@section('titulo', 'Crear Proyecto')
@push('estilos')
@endpush
@push('acciones')
<script>
    $(document).ready(function (){
        @if (old('Nombre_proyecto'))
            $("#Nombre_proyecto").val('{{ old('Nombre_proyecto') }}');
        @endif
        @if (old('Fecha_inicio'))
            $("#Fecha_inicio").val('{{ old('Fecha_inicio') }}');
        @endif
        @if (old('Fecha_termino'))
            $("#Fecha_termino").val('{{ old('Fecha_termino') }}');
        @endif
        @if (old('Presupuesto_oferta'))
            $("#Presupuesto_oferta").val('{{ old('Presupuesto_oferta') }}');
        @endif
        @if (old('Presupuesto_control'))
            $("#Presupuesto_control").val('{{ old('Presupuesto_control') }}');
        @endif
        @if (old('encargado_id'))
            $("#encargado_id").val('{{ old('encargado_id') }}');
            $("#encargado_id").change();
        @endif
    });

    $('#Nombre_proyecto').on('keyup', function(){
        var tipo = document.getElementById('Nombre_proyecto').value;
        if( tipo.length  > 0){
            document.getElementById('Nombre_proyecto').value = tipo.charAt(0).toUpperCase() + tipo.substr(1)
        }
    });
    $('#Ubicacion').on('keyup', function(){
        var desc = document.getElementById('Ubicacion').value;
        if( desc.length  > 0){
            document.getElementById('Ubicacion').value = desc.charAt(0).toUpperCase() + desc.substr(1)
        }
    });
</script>
@endpush
@section('cuerpo')
    <div class="card" style="background-color: #FFFFFF;width: 100%">
        <div class="card-header">
            @include('error_formulario')
            <h1 align="center">Crear Proyecto</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md">
                    <form  method="POST"
                        action="{{ route('proyectos.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <ul class="form-style-1">
                            <div class="form-group{{ $errors->has('Nombre_proyecto') ? ' has-error' : '' }}">
                                <label>Nombre del Proyecto<span class="required">*</span></label>
                                <input placeholder="Ingrese el Nombre del proyecto" type="text"
                                    id="Nombre_proyecto" name="Nombre_proyecto" class="form-style-1">
                                @if ($errors->has('Nombre_proyecto'))
                                    <label>
                                        <span class="required">
                                            <strong>{{ $errors->first('Nombre_proyecto') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Fecha_inicio') ? ' has-error' : '' }}">
                                <label>Fecha de inicio<span class="required">*</span></label>
                                <input type="date" id="Fecha_inicio" name="Fecha_inicio" class="form-style-1">
                                @if ($errors->has('Fecha_inicio'))
                                    <label>
                                        <span class="required">
                                            <strong>{{ $errors->first('Fecha_inicio') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            <div class="form-group{{ $errors->has('Fecha_termino') ? ' has-error' : '' }}">
                                <label>Fecha de termino<span class="required">*</span></label>
                                <input type="date" id="Fecha_termino" name="Fecha_termino" class="form-style-1">
                                @if ($errors->has('Fecha_termino'))
                                    <label>
                                        <span class="required">
                                            <strong>{{ $errors->first('Fecha_termino') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Presupuesto_oferta') ? ' has-error' : '' }}">
                                <label>Presupuesto de oferta<span class="required">*</span></label>
                                <input placeholder="Ingrese el presupuesto de oferta" type="number"
                                    id="Presupuesto_oferta" name="Presupuesto_oferta" class="form-style-1">
                                @if ($errors->has('Presupuesto_oferta'))
                                    <label>
                                        <span class="required">
                                            <strong>{{ $errors->first('Presupuesto_oferta') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Presupuesto_control') ? ' has-error' : '' }}">
                                <label>Presupuesto de control<span class="required">*</span></label>
                                <input placeholder="Ingrese el presupuesto de control" type="number"
                                    id="Presupuesto_control" name="Presupuesto_control" class="form-style-1">
                                @if ($errors->has('Presupuesto_control'))
                                    <label>
                                        <span class="required">
                                            <strong>{{ $errors->first('Presupuesto_control') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('encargado_id') ? ' has-error' : '' }}">
                                <label>Encargado</label>
                                <select id="encargado_id" name="encargado_id">
                                    <option value>-- Seleccione un proveedor --</option>
                                    @foreach($usuarios as $usuario)
                                        <option value={{$usuario->id}}>{{ $usuario->getNombreCompleto()}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('encargado_id'))
                                    <label>
                                        <span class="required">
                                            <strong>{{ $errors->first('encargado_id') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <hr>
                            <a href="{{ route('proyectos.index') }}" class="btn btn-primary">Atrás</a>
                            <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary"
                                data-toggle="modal">
                                    Agregar
                            </a>
                        </ul>
                        @include('pop-up')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
