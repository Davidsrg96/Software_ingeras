@extends('layoutGeneral')
@section('titulo', 'Crear tipo de usuario')
@push('estilos')
@endpush
@push('acciones')
<script>
    $(document).ready(function (){
        @if (old('Tipo_usuario'))
            $("#Tipo_usuario").val('{{ old('Tipo_usuario') }}');
        @endif
        @if (old('Descripcion'))
            $("#Descripcion").val('{{ old('Descripcion') }}');
        @endif
    });

    $('#Tipo_usuario').on('keyup', function(){
        var tipo = document.getElementById('Tipo_usuario').value;
        if( tipo.length  > 0){
            document.getElementById('Tipo_usuario').value = tipo.charAt(0).toUpperCase() + tipo.substr(1)
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
    <div>
        <div class="card" style="color: #abdde5">
            @include('error_formulario')
            <h1 align="center">Crear Tipo de Usuario</h1>
            <div class="row">
                <div class="col-md">
                    <form  method="POST"
                        action="{{ route('tipo_usuario.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <ul class="form-style-1">
                            <div class="form-group{{ $errors->has('Tipo_usuario') ? ' has-error' : '' }}">
                                <label>Tipo de Usuario<span class="required">*</span></label>
                                <input placeholder="Ingrese el tipo de usuario" type="text"
                                    id="Tipo_usuario" name="Tipo_usuario" class="form-style-1">
                                @if ($errors->has('Tipo_usuario'))
                                    <label>
                                        <span class="required">
                                            <strong>{{ $errors->first('Tipo_usuario') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Descripcion') ? ' has-error' : '' }}">
                                <label>Descripcion<span class="required">*</span></label>
                                <textarea class="form-style-1" id="Descripcion" name="Descripcion"></textarea>
                                @if ($errors->has('Descripcion'))
                                    <label>
                                        <span class="required">
                                            <strong>{{ $errors->first('Descripcion') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <hr>
                            <a href="{{ route('tipo_usuario.index') }}" class="btn btn-primary" >Atrás</a>
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