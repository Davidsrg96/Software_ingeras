@extends('layoutGeneral')
@section('titulo', 'Mostrar Factura')
@push('estilos')
<style>
    .ventana{
        width: 100%;
        border: 1px solid #484848;
        margin: 0 auto; 
    }
    img.documento{
        width: 100%;
        height: 100%;
        float: none;
        padding: 0;
    }
</style>
@endpush
@push('acciones')
    <script>
        //Toaster
        @if(Session::has('success'))
            mensajeEmergente('{{ Session::get('success')['titulo'] }}', '{{ Session::get('success')['mensaje'] }}');
        @endif
        @if(Session::has('fail'))
            mensajeEmergente('{{ Session::get('fail')['titulo'] }}', '{{ Session::get('fail')['mensaje'] }}', 'error');
        @endif
    </script>
@endpush
@section('cuerpo')
    <div class="card">
        <div class="card-header">
            <h1 align="center"><font color="black">Factura N° {{ $factura->Numero }}</font></h1>
            <div class="column" align="left" style="padding-left: 1.5%">
            </div>
        </div>
        <div class="card-body">
            <a type="button" class="btn btn-primary" href="{{ route('factura.index') }}" role="button"><i class="fas fa-arrow-left"></i> Volver a la lista</a>
            <hr>
            <div class="row">
                <div class="card-body col-md-6">
                    <div class="row">
                        <label>Numero</label>
                        <label>{{ $factura->Numero }}</label>
                    </div>
                </div>
                <div class="card-body col-md-6">
                    <div class="ventana">
                        <img class="documento" src="{{ asset(Storage::disk('factura')->url($factura->Documento)) }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
