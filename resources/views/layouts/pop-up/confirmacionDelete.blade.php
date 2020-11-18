<div class="modal fade" id="del{{$dato->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmacion</h5>
                <button tyle="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p><font color="black">Si presiona cancelar, no se eliminaran los cambios</font> </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                <button
                class="btn btn-primary btn-danger"
                type="submit">
                    Eliminar
            </button>
            </div>
        </div>
    </div>
</div>