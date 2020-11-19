@extends('layoutGeneral')
@section('titulo', 'Editar cargo')
@push('estilos')
@endpush
@push('acciones')
<script>
    $(document).ready(function (){
        @if (old('Tipo_cargo'))
            $("#Tipo_cargo").val('{{ old('Tipo_cargo') }}');
        @endif
        @if (old('Descripcion'))
            $("#Descripcion").val('{{ old('Descripcion') }}');
        @endif
    });

    $('#Tipo_cargo').on('keyup', function(){
        var tipo = document.getElementById('Tipo_cargo').value;
        if( tipo.length  > 0){
            document.getElementById('Tipo_cargo').value = tipo.charAt(0).toUpperCase() + tipo.substr(1)
        }
    });
    $('#Descripcion').on('keyup', function(){
        var desc = document.getElementById('Descripcion').value;
        if( desc.length  > 0){
            document.getElementById('Descripcion').value = desc.charAt(0).toUpperCase() + desc.substr(1)
        }
    });
</script>
@endpush
@section('cuerpo')
    <div class="card" style="background-color: #FFFFFF;width: 100%">
        <div class="card-header">
            @include('error_formulario')
            <h1 align="center">Editar Cargo</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md">
                    <form  method="POST"
                        action="{{ route('cargos.update', $cargo->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <ul class="form-style-1">
                            <div class="form-group{{ $errors->has('Tipo_cargo') ? ' has-error' : '' }}">
                                <label>Cargo<span class="required">*</span></label>
                                <input placeholder="Ingrese el cargo" type="text"
                                    id="Tipo_cargo" name="Tipo_cargo" class="form-style-1"
                                    value="{{ $cargo->Tipo_cargo }}">
                                @if ($errors->has('Tipo_cargo'))
                                    <label>
                                        <span class="required">
                                            <strong>{{ $errors->first('Tipo_cargo') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Descripcion') ? ' has-error' : '' }}">
                                <label>Descripcion<span class="required">*</span></label>
                                <textarea class="form-style-1" id="Descripcion" name="Descripcion">{{ $cargo->Descripcion }}</textarea>
                                @if ($errors->has('Descripcion'))
                                    <label>
                                        <span class="required">
                                            <strong>{{ $errors->first('Descripcion') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <hr>
                            <a href="{{ route('cargos.index') }}" class="btn btn-primary" >Atrás</a>
                            <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary"
                                data-toggle="modal">Agregar
                            </a>
                        </ul>
                        @include('pop-up')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection