@extends('layoutGeneral')
@section('titulo', 'Crear Bodega')
@push('estilos')
@endpush
@push('acciones')
<script>
    $(document).ready(function (){
        @if (old('Nombre'))
            $("#Nombre").val('{{ old('Nombre') }}');
        @endif
        @if (old('Ubicacion'))
            $("#Ubicacion").val('{{ old('Ubicacion') }}');
        @endif
        @if (old('encargado_id'))
            $("#encargado_id").val('{{ old('encargado_id') }}');
            $("#encargado_id").change();
        @endif
    });

    $('#Nombre').on('keyup', function(){
        var tipo = document.getElementById('Nombre').value;
        if( tipo.length  > 0){
            document.getElementById('Nombre').value = tipo.charAt(0).toUpperCase() + tipo.substr(1)
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
            <h1 align="center">Crear Bodega</h1>
        </div>
        <div class="card-body">
            
            <div class="row">
                <div class="col-md">
                    <form  method="POST"
                        action="{{ route('bodega.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <ul class="form-style-1">
                            <div class="form-group{{ $errors->has('Nombre') ? ' has-error' : '' }}">
                                <label>Nombre<span class="required">*</span></label>
                                <input placeholder="Ingrese el nombre del Bodega" type="text"
                                    id="Nombre" name="Nombre" class="form-style-1">
                                @if ($errors->has('Nombre'))
                                    <label>
                                        <span class="required">
                                            <strong>{{ $errors->first('Nombre') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Ubicacion') ? ' has-error' : '' }}">
                                <label>Ubicación<span class="required">*</span></label>
                                <input placeholder="Ingrese la ubicación" type="text"
                                    id="Ubicacion" name="Ubicacion" class="form-style-1">
                                @if ($errors->has('Ubicacion'))
                                    <label>
                                        <span class="required">
                                            <strong>{{ $errors->first('Ubicacion') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('encargado_id') ? ' has-error' : '' }}">
                                <label>Encargado</label><br>
                                <select id="encargado_id" name="encargado_id">
                                    <option value>-- Seleccione un encargado --</option>
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
                            <a href="{{ route('bodega.index') }}" class="btn btn-primary" >Atrás</a>
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