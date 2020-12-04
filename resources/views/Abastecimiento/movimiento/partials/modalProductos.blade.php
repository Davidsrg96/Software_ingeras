@foreach($bodegas as $bodega)
    <div id="productos{{ $bodega->id }}" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Lista de Productos</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    @if(!$bodega->productos->isEmpty())
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Descripción</th>
                                    <th>Calidad</th>
                                    <th>Proveedor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bodega->productos as $producto)
                                    <tr>
                                        <td>{{ $producto->Codigo }}</td>
                                        <td>{{ $producto->Descripcion }}</td>
                                        <td>{{ $producto->Calidad }}</td>
                                        <td>{{ $producto->proveedor->Nombre_proveedor }}</td>
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
@endforeach