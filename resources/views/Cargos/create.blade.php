@extends('layouts.app', [
    'namePage' => 'Crear Cargo',
    'class' => 'sidebar-mini',
    'activePage' => 'Cargos',
])
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
    <div class="panel-header panel-header-sm"></div>
    <div class="content col-md-10 offset-1">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    @include('error_formulario')
                    <h2 class="title text-center">Crear Cargo</h2>
                </div>
                <hr>
                <form  method="POST"
                    action="{{ route('cargos.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                        <div class="card-body col-md-6 offset-3">
                            <div class="form-group{{ $errors->has('Tipo_cargo') ? ' has-error' : '' }}">
                                <label>Cargo<span class="required">*</span></label>
                                <input placeholder="Ingrese el cargo" type="text"
                                    id="Tipo_cargo" name="Tipo_cargo" class="form-control">
                                @if ($errors->has('Tipo_cargo'))
                                    <label>
                                        <span class="required form-error">
                                            <strong>{{ $errors->first('Tipo_cargo') }}</strong>
                                        </span>
                                    </label>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('Descripcion') ? ' has-error' : '' }}">
                                <label>Descripcion<span class="required">*</span></label>
                                <textarea class="form-control" id="Descripcion" name="Descripcion"></textarea>
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
                        <div class="card-footer col-md-4 offset-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ route('cargos.index') }}"
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