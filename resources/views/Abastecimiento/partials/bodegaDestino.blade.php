<div id="bodega{{$bodega->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Seleccione una Bodega de destino</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form role="form"
                method="POST" 
                action="{{route('despacho.bodegas',$bodega->id)}}"
                enctype="multipart/form-data">
                @csrf
                    <div class="modal-body">
                        <div class="col-md-8 offset-2">
                            <select class="required form-control" id="bodega" name="bodegaID" style="width:100%;">
                                <option value>-- Seleccione una bodega --</option>
                                @foreach($bodegas as $dato)
                                    @if($bodega->id != $dato->id)
                                        <option value="{{$dato->id}}"> {{$dato->Nombre}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Aceptar</button>
                    </div>
            </form>
        </div>
    </div>
</div>