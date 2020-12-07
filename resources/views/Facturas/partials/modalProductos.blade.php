@foreach($facturas as $factura)
    <div id="productos{{ $factura->id }}" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Lista de Productos</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    @if(!$factura->productos->isEmpty())
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $anterior;
                                    $cant = 1;
                                @endphp
                                @foreach($factura->productos as $key => $producto)
                                    @if($key  == $factura->productos->count() - 1)
                                        @if($anterior->Descripcion == $producto->Descripcion)
                                            @php
                                                $cant= $cant + 1;
                                            @endphp
                                            <tr>
                                                <td>{{ $anterior->Codigo }}</td>
                                                <td>{{ $anterior->Descripcion }}</td>
                                                <td>{{ $cant }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>{{ $anterior->Codigo }}</td>
                                                <td>{{ $anterior->Descripcion }}</td>
                                                <td>{{ $cant }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ $producto->Codigo }}</td>
                                                <td>{{ $producto->Descripcion }}</td>
                                                <td>1</td>
                                            </tr>
                                        @endif
                                    @else
                                        @if ( $key > 0)
                                            @if($producto->Descripcion == $anterior->Descripcion)
                                                @php
                                                    $cant = $cant + 1;
                                                @endphp
                                            @else
                                                <tr>
                                                    <td>{{ $anterior->Codigo }}</td>
                                                    <td>{{ $anterior->Descripcion }}</td>
                                                    <td>{{ $cant }}</td>
                                                </tr>
                                                @php
                                                    $cant = 1;
                                                    $anterior= $producto;
                                                @endphp
                                            @endif
                                        @else
                                            @php
                                                $anterior = $producto;
                                            @endphp
                                        @endif
                                    @endif
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
@endforeach