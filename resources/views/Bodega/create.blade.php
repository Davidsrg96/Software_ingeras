@extends('layouts.app', [
    'namePage' => 'Crear Bodega',
    'class' => 'sidebar-mini',
    'activePage' => 'Bodegas',
])
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
    <div class="panel-header panel-header-sm"></div>
    <div class="content col-md-10 offset-1">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    @include('error_formulario')
                    <h2 class="title text-center">Crear Bodega</h2>
                </div>
                <hr>
                <form  method="POST"
                    action="{{ route('bodega.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                        <div class="card-body col-md-6 offset-3">
                            <div class="form-group{{ $errors->has('Nombre') ? ' has-error' : '' }}">
                                <label>Nombre<span class="required">*</span></label>
                                <input placeholder="Ingrese el nombre del Bodega" type="text"
                                    id="Nombre" name="Nombre" class="form-control">
                                @if ($errors->has('Nombre'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('Nombre') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Ubicacion') ? ' has-error' : '' }}">
                                <label>Ubicación<span class="required">*</span></label>
                                <input placeholder="Ingrese la ubicación" type="text"
                                    id="Ubicacion" name="Ubicacion" class="form-control">
                                @if ($errors->has('Ubicacion'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('Ubicacion') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('encargado_id') ? ' has-error' : '' }}">
                                <label>Encargado</label><br>
                                <select class="form-control" id="encargado_id" name="encargado_id">
                                    <option value>-- Seleccione un encargado --</option>
                                    @foreach($usuarios as $usuario)
                                        <option value={{$usuario->id}}>{{ $usuario->getNombreCompleto()}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('encargado_id'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('encargado_id') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="card-footer col-md-4 offset-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ route('bodega.index') }}"
                                        class="btn btn-danger btn-block">
                                            Atrás
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#confirmation" class="btn btn-success btn-block"
                                        data-toggle="modal">
                                            Agregar
                                    </a>
                                </div>
                            </div>
                            @include('pop-up')
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection