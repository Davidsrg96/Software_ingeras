@foreach($ordenes as $orden)
    <div id="productos{{ $orden->id }}" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Lista de Productos</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    @if(!$orden->productos->isEmpty())
                        <table class="table table-hover table-striped" id="tabla_productos{{ $orden->id }}">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    @else
                        <p style="color: black">La orden de compra no tiene productos asignados</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Salir</button>
                </div>
            </div>
        </div>
    </div>
@endforeach