<div class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body" id="codigos">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($factura->productos as $producto)
                            <tr>
                                <td>{!!DNS1D::getBarcodeSVG($producto->Codigo, 'C128')!!}</td>
                                <td>{{ $producto->Descripcion }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>