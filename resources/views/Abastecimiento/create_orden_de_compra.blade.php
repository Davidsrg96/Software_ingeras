@extends('layoutGeneral')
@section('cuerpo')
    <div>
        <div class="card" style="color: #abdde5">
            @include('error_formulario')

            <div class="row">
                <div class="col-md">
                    <form method="POST" action="{{action('OrdenDeCompraController@store')}}" accept-charset="UTF-8" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Orden de Compra</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="file" >
                            </div>
                        </div>
                        <div class="form-group">
                            <select id="proveedor" name="proveedor" onchange="ShowSelected();">
                                <option value="0">-- Seleccione --</option>
                                @foreach($proveedores as $pr)
                                    <option value={{$pr->id}}>{{ $pr->Nombre_proveedor}}</option>
                                @endforeach
                            </select>
                        </div>
                        <a href="{{ action('OrdenDeCompraController@index') }}" class="btn btn-primary" >Atrás</a>
                        <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary" data-toggle="modal">Guardar</a>
                        @include('pop-up')
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function ShowSelected()
        {
            /* Para obtener el valor de la etiqueta select */
            var proveedor = document.getElementById("proveedor").value;
        }
    </script>
@endsection
