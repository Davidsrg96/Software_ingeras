@extends('layoutGeneral')
@section('titulo', 'Editar Pregunta')
@push('estilos')
@endpush
@push('acciones')
<script>
    $(document).ready(function (){
        @if (old('Pregunta'))
            $("#Pregunta").val('{{ old('Pregunta') }}');
        @endif
        @if (old('Tipo_pregunta'))
            $("#Tipo_pregunta").val('{{ old('Tipo_pregunta') }}');
            $("#Tipo_pregunta").change();
        @endif
    });

    $('#Pregunta').on('keyup', function(){
        var tipo = document.getElementById('Pregunta').value;
        if( tipo.length  > 0){
            document.getElementById('Pregunta').value = tipo.charAt(0).toUpperCase() + tipo.substr(1)
        }
    });
</script>
@endpush
@section('cuerpo')
    <div class="card" style="background-color: #FFFFFF;width: 100%">
        <div class="card-header">
            @include('error_formulario')
            <h1 align="center">Editar Pregunta</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md">
                    <form  method="POST"
                        action="{{ route('preguntas.update', $pregunta->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <ul class="form-style-1">
                            <div class="form-group{{ $errors->has('Tipo_pregunta') ? ' has-error' : '' }}">
                                <label>Tipo de pregunta<span class="required">*</span></label>
                                <select id="Tipo_pregunta" name="Tipo_pregunta">
                                    <option value="">--Seleccione un tipo de Pregunta--</option>
                                    <option value="Usuario"
                                        {{($pregunta->Tipo_pregunta == "Usuario") ? 'selected' : '' }}>
                                            Usuario
                                    </option>
                                    <option value="Actividad"
                                        {{($pregunta->Tipo_pregunta == "Actividad") ? 'selected' : '' }}>
                                            Actividad
                                    </option>
                                    <option value="Proyecto"
                                        {{($pregunta->Tipo_pregunta == "Proyecto") ? 'selected' : '' }}>
                                            Proyecto
                                    </option>
                                    <option value="Bodega"
                                        {{($pregunta->Tipo_pregunta == "Bodega") ? 'selected' : '' }}>
                                            Bodega
                                    </option>
                                </select>
                                @if ($errors->has('Tipo_pregunta'))
                                    <label>
                                        <span class="required">
                                            <strong>{{ $errors->first('Tipo_pregunta') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Pregunta') ? ' has-error' : '' }}">
                                <label>Pregunta<span class="required">*</span></label>
                                <input placeholder="Ingrese la pregunta" type="text"
                                    id="Pregunta" name="Pregunta" class="form-style-1" value="{{ $pregunta->Pregunta }}">
                                @if ($errors->has('Pregunta'))
                                    <label>
                                        <span class="required">
                                            <strong>{{ $errors->first('Pregunta') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <hr>
                            <a href="{{ route('preguntas.index') }}" class="btn btn-primary">Atrás</a>
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