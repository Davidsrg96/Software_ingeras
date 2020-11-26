<div id="bodega" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Seleccione una Bodega de destino</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="{{route('despacho.bodegas',$bodega->id)}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <select class="required" id="bodega" name="bodega" style="width: 80%">
                        <option value="0" style="alignment: center">-- Seleccione --</option>
                        @foreach($bodegas as $bodega)
                            <option value="{{$bodega->id}}"> {{$bodega->Nombre}}</option>
                        @endforeach
                    </select>
                    <li>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </li>
                </form>
            </div>
        </div>
    </div>
</div>