@extends('layouts.app', [
    'namePage' => 'Editar tipo de usuario',
    'class' => 'sidebar-mini',
    'activePage' => 'Tipo usuario',
])
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
    <div class="panel-header panel-header-sm"></div>
    <div class="content col-md-10 offset-1">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    @include('error_formulario')
                    <h2 class="title text-center">Editar Tipo de Usuario</h2>
                </div>
                <hr>
                <form  method="POST"
                    action="{{ route('tipo_usuario.update', $tipo->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="card-body col-md-6 offset-3">
                            <div class="form-group{{ $errors->has('Tipo_usuario') ? ' has-error' : '' }}">
                                <label>Tipo de Usuario<span class="required">*</span></label>
                                <input placeholder="Ingrese el tipo de usuario" type="text"
                                    id="Tipo_usuario" name="Tipo_usuario" class="form-control"
                                    value="{{ $tipo->Tipo_usuario }}">
                                @if ($errors->has('Tipo_usuario'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('Tipo_usuario') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Descripcion') ? ' has-error' : '' }}">
                                <label>Descripcion<span class="required">*</span></label>
                                <textarea class="form-control" id="Descripcion"
                                    name="Descripcion">{{ $tipo->Descripcion }}</textarea>
                                @if ($errors->has('Descripcion'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('Descripcion') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <dir class="card-footer col-md-4 offset-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ route('tipo_usuario.index') }}"
                                        class="btn btn-danger btn-block">
                                            Atrás
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#confirmation" class="btn btn-success btn-block"
                                        data-toggle="modal">
                                            Editar
                                    </a>
                                </div>
                            </div>
                            @include('pop-up')
                        </dir>
                </form>
            </div>
        </div>
    </div>
@endsection
