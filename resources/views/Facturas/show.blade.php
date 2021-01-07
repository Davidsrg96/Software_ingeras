@extends('layouts.app', [
    'namePage' => 'Mostrar Factura',
    'class' => 'sidebar-mini',
    'activePage' => 'Facturas',
])
@push('estilos')
<style>
    .ventana{
        width: 100%;
        border: 1px solid #484848;
        margin: 0 auto; 
    }
    iframe.documento{
        width: 100%;
        height: 680px;
    }
    .card{
        padding: 20px;
    }
    .espacioChico{
        padding-bottom: 10px;
    }
    .item{
        font-size: 18px;
        font-weight: 450;
    }
    .espacioGrande{
        padding-top: 80px
    }
    .modal-body {
       max-height:500px;
       overflow:auto;
    }
    th{
        text-align: center;
    }
    td{
        text-align: center;
    }
</style>
@endpush
@push('acciones')
    <script>
        function imprimirDIV(contenido) {
            var ficha = document.getElementById(contenido);
            console.log(ficha);
            var ventanaImpresion = window.open(' ', 'popUp');
            ventanaImpresion.document.write(ficha.innerHTML);
            ventanaImpresion.document.close();
            ventanaImpresion.print();
            ventanaImpresion.close();
        }
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
    <div class="panel-header panel-header-sm"></div>
    <div class="content col-md-10 offset-1">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h2 class="title text-center">Factura N° {{ $factura->Numero }}</h2>
                </div>
                <hr>
                <div class="card-body">
                    <a type="button" class="btn btn-primary" href="{{ route('factura.index') }}" role="button">
                        <i class="fas fa-arrow-left"></i> Volver a la lista
                    </a>
                    <a href="#" class="btn btn-warning">Validar Factura</a>
                    <div class="row">
                        <div class="card-body col-md-6">
                            <h4 class="espacioChico" align="center"><strong>Información General</strong></h4>
                            <div class="row">
                                <div class="col-md-4 item"><strong>Número</strong></div>
                                <div class="col-md-8 espacioChico">{{ $factura->Numero }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 item"><strong>Fecha de ingreso</strong></div>
                                <div class="col-md-8 espacioChico">{{ $factura->Fecha_ingreso }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 item"><strong>Proveedor</strong></div>
                                <div class="col-md-8 espacioChico">{{ $factura->proveedor->Nombre_proveedor }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 item"><strong>Estado</strong></div>
                                <div class="col-md-8 espacioChico }}">{{ $factura->Estado }}</div>
                            </div>
                            @if($factura->Observacion)
                                <div class="row">
                                    <div class="col-md-4 item"><strong>Obseracion</strong></div>
                                    <div class="col-md-8 espacioChico">{{ $factura->Observacion }}</div>
                                </div>
                            @endif
                            @if(!$factura->productos->isEmpty())
                                <h4 class="espacioGrande espacioChico" align="center"><strong>Productos</strong></h4>
                                <div class="btn-group col-md-6 offset-3">
                                    <button role="button" class="btn btn-info btn-round"
                                        title="Mostrar Productos" data-toggle="modal"
                                        data-target="#productos{{ $factura->id }}">
                                            {{ $factura->productos->count() }}
                                    </button>
                                    <button
                                        class="btn btn-success btn-round" title="Imprimir"
                                        onclick="javascript:window.imprimirDIV('codigos');">
                                            <i class="fas fa-print" style="color: white"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="card-body col-md-6">
                            <object data="{{ asset(Storage::disk('factura')->url($factura->Documento)) }}"
                                    type="application/pdf" 
                                    width="100%" 
                                    height="100%">
                            </object>
                        </div>
                        <div id="productos{{ $factura->id }}" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Lista de Productos</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body" id="codigoB">
                                        @if(!$factura->productos->isEmpty())
                                            <table id="tabla_productos" class="table table-hover table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Codigo</th>
                                                        <th>Descripción</th>
                                                        <th>Precio</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($factura->productos as $producto)
                                                        <tr>
                                                            <td>{!!DNS1D::getBarcodeSVG($producto->Codigo, 'C128')!!}</td>
                                                            <td>{{ $producto->Descripcion }}</td>
                                                            <td>${{ $producto->Precio_producto }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <p style="color: black">La bodega no tiene productos asignados</p>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Salir</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('Facturas.partials.codigoBarra')
            </div>
        </div>
    </div>
@endsection
