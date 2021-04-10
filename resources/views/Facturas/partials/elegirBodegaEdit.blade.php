<div class="modal fade" id="selectBodega">
    <div class="modal-dialog selectBodega">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bodegas</h5>
                <button tyle="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <label style="color: black">Seleccione la bodega en la que se almacenaran los productos</label>
                <select class="form-control" id="bodega" name="bodega">
                    @foreach($bodegas as $bodega)
                        <option value={{ $bodega->id}}>
                                {{ $bodega->Nombre }}, {{ $bodega->Ubicacion}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="modal-footer">
                <div>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        Cancelar
                    </button>
                </div>
                <div>
                    <button type="submit"  value="store" class="btn btn-success">
                        Guardar Cambios
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>