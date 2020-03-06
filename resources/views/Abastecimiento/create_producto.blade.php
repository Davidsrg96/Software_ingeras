@extends('layoutGeneral')
@section('cuerpo')
    <div>
        <div class="card" style="color: #abdde5">
            @include('error_formulario')

            <div class="row">
                <div class="col-md">
                    @if(isset($p))
                        <h1 align="center">Editar Producto</h1>
                        <form role="form" method="POST"  enctype="multipart/form-data">
                            <ul class="form-style-1">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <li>
                                    <label for=codigo>Codigo</label>
                                    <input placeholder="N° de Factura" type="number" id="codigo" name="codigo" class="form-style-1" value="{{$p->Codigo}}">
                                </li>
                                <li>
                                    <label for="nom_producto">Nombre del Producto<span class="required">*</span></label>
                                    <input placeholder="Nombre del producto" type="text" id="producto" name="nom_producto" class="form-style-1" value="{{$p->Nombre_producto}}">
                                </li>
                                <li>
                                    <label for="precio">Precio del Producto<span class="required">*</span></label>
                                    <input placeholder="Precio del Producto" type="number" id="precio" name="precio" class="form-style-1" value="{{$p->Precio_producto}}">
                                </li>
                                <li>
                                    <label for="cantidad">Cantidad<span class="required">*</span></label>
                                    <input placeholder="Cantidad" type="number" id="cantidad" name="cantidad" class="form-style-1" value="{{$p->Cantidad}}">
                                </li>
                                <li>
                                    <label for="proveedor">Seleccione el Proveedor<span class="required">*</span></label><br>
                                    <select id="proveedor" name="proveedor" onchange="ShowSelected();">
                                        <option value={{$p->id}}>{{ $p->Nombre_proveedor}}</option>
                                    </select>
                                </li>
                                <li>
                                    <a href="{{ action('BodegaController@index') }}" class="btn btn-primary" >Atrás</a>
                                    <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary" data-toggle="modal">Editar</a>
                                </li>
                            </ul>
                            @include('pop-up')
                        </form>
                    @else
                        <h1 align="center">Agregar Producto</h1>
                        <form role="form" method="POST" action="{{action('BodegaController@store')}}"  enctype="multipart/form-data">
                            <ul class="form-style-1">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <li>
                                    <label for=codigo>Codigo</label>
                                    <input placeholder="Ingrese el N° de Factura" type="number" id="codigo" name="codigo" class="form-style-1">
                                </li>
                                <li>
                                    <label for="nom_producto">Nombre del Producto</label>
                                    <input placeholder="Ingrese el Nombre del producto" type="text" id="producto" name="producto" class="form-style-1">
                                </li>
                                <li>
                                    <label for="precio">Precio del Producto</label>
                                    <input placeholder="Ingrese el precio del Producto" type="number" id="precio" name="precio" class="form-style-1">
                                </li>
                                <li>
                                    <label for="cantidad">Cantidad</label>
                                    <input placeholder="Ingrese la cantidad" type="number" id="cantidad" name="cantidad" class="form-style-1">
                                </li>
                                <li>
                                    <label for="proveedor">Seleccione el Proveedor<span class="required">*</span></label><br>
                                    <select id="proveedor" name="proveedor" onchange="ShowSelected();">
                                        <option value="0">-- Seleccione --</option>
                                        @foreach($proveedores as $pr)
                                            <option value={{$pr->id}}>{{ $pr->Nombre_proveedor}}</option>
                                        @endforeach
                                    </select>
                                </li>
                                <span class="add">Add fields</span>
                                </p>
                                <li>
                                    <a href="{{ action('BodegaController@index') }}" class="btn btn-primary" >Atrás</a>
                                    <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary" data-toggle="modal">Guardar</a>
                                </li>
                            </ul>
                            @include('pop-up')
                        </form>
                    @endif
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
