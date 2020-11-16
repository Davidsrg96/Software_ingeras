@extends('layoutGeneral')
@section('titulo', 'Crear departamento')
@push('estilos')
@endpush
@push('acciones')
<script>
    $(document).ready(function (){
        @if (old('Nombre_departamento'))
            $("#Nombre_departamento").val('{{ old('Nombre_departamento') }}');
        @endif
        @if (old('Objetivo'))
            $("#Objetivo").val('{{ old('Objetivo') }}');
        @endif
    });
</script>
@endpush
@section('cuerpo')
    <div>
        <div class="card" style="color: #abdde5">
            @include('error_formulario')
            <h1 align="center">Agregar Departamento</h1>
            <div class="row">
                <div class="col-md">
                    <form  method="POST"
                        action="{{route('departamentos.store')}}"
                        enctype="multipart/form-data">
                        @csrf
                        <ul class="form-style-1">
                            <div class="form-group{{ $errors->has('Nombre_departamento') ? ' has-error' : '' }}">
                                <label>Nombre<span class="required">*</span></label>
                                <input placeholder="Ingrese el nombre del departamento" type="text"
                                    id="Nombre_departamento" name="Nombre_departamento" class="form-style-1">
                                @if ($errors->has('Nombre_departamento'))
                                    <label>
                                        <span class="required">
                                            <strong>{{ $errors->first('Nombre_departamento') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Objetivo') ? ' has-error' : '' }}">
                                <label>Objetivo<span class="required">*</span></label>
                                <input placeholder="Ingrese el objetivo..." type="text" id="Objetivo" name="Objetivo" class="form-style-1" >
                                @if ($errors->has('Objetivo'))
                                    <label>
                                        <span class="required">
                                            <strong>{{ $errors->first('Objetivo') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <hr>
                            <a href="{{ route('departamentos.index') }}" class="btn btn-primary" >Atrás</a>
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
