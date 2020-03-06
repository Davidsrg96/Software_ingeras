@extends('layoutGeneral')
@section('cuerpo')

    <div>
        <div class="card" style="color: #abdde5">
            @include('error_formulario')
            <h1 align="center">Agregar Proveedor</h1>
            <div class="row">
                <div class="col-md">
                    @if(isset($p))
                        <form role="form" method="POST"  enctype="multipart/form-data">
                            <ul class="form-style-1">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <li>
                                    <label for="nom_proveedor">Nombre del Proveedor<span class="required">*</span></label>
                                    <input placeholder="Ingrese el Nombre del Proveedor" type="text" id="nom_proveedor" name="nom_proveedor" class="form-style-1" pattern="([A-z]|ñ|\s)*" value="{{$p->Nombre_proveedor}}">
                                </li>
                                <li>
                                    <label for="rut_proveedor">RUT del Proveedor<span class="required">*</span></label>
                                    <input placeholder="Ingrese el RUT del Proveedor" type="text" id="rut_proveedor" name="rut_proveedor" class="form-style-1" value="{{$p->Rut_proveedor}}">
                                </li>
                                <li>
                                    <label for="vendedor">Nombre del Vendedor<span class="required">*</span></label>
                                    <input placeholder="Ingrese el nombre del Vendedor" type="text" id="vendedor" name="vendedor" class="form-style-1" value="{{$p->Nombre_vendedor}}">
                                </li>
                                <li>
                                    <label for="direccion">Dirección del establecimiento<span class="required">*</span></label>
                                    <input placeholder="Ingrese la Direccion" type="text" id="direccion" name="direccion" class="form-style-1" value="{{$p->Direccion}}">
                                </li>
                                <li>
                                    <label for="telefono">Telefono<span class="required">*</span></label>
                                    <input placeholder="Ingrese el telefono" type="text" id="telefono" name="telefono" class="form-style-1" value="{{$p->Telefono}}">
                                </li>
                                <li>
                                    <label for="rubro">Rubro de la Empresa<span class="required">*</span></label>
                                    <input placeholder="Ingrese el Rubro" type="text" id="rubro" name="rubro" class="form-style-1" value="{{$p->Rubro}}">
                                </li>
                                <li>
                                    <label for="correo">Correo de contacto<span class="required">*</span></label>
                                    <input placeholder="Ingrese el correo" type="text" id="correo" name="correo" class="form-style-1" value="{{$p->Correo}}">
                                </li>
                                <li>
                                    <a href="{{ action('ProveedoresController@index') }}" class="btn btn-primary" >Atrás</a>
                                    <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary" data-toggle="modal">Editar</a>
                                </li>
                            </ul>
                            @include('pop-up')
                        </form>
                    @else
                        <form role="form" method="POST" action="{{action('ProveedoresController@store')}}" enctype="multipart/form-data">
                            <ul class="form-style-1">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <li>
                                    <label for="nom_proveedor">Nombre del Proveedor</label>
                                    <input placeholder="Ingrese el Nombre del Proveedor" type="text" id="nom_proveedor" name="nom_proveedor" class="form-style-1" pattern="([A-z]|ñ|\s)*">
                                </li>
                                <li>
                                    <label for="rut_proveedor">RUT del Proveedor</label>
                                    <input placeholder="Ingrese el RUT del Proveedor" type="text" id="rut_proveedor" name="rut_proveedor" class="form-style-1">
                                </li>
                                <li>
                                    <label for="vendedor">Nombre del Vendedor</label>
                                    <input placeholder="Ingrese el nombre del Vendedor" type="text" id="vendedor" name="vendedor" class="form-style-1">
                                </li>
                                <li>
                                    <label for="direccion">Dirección del establecimiento</label>
                                    <input placeholder="Ingrese la Direccion" type="text" id="direccion" name="direccion" class="form-style-1">
                                </li>
                                <li>
                                    <label for="telefono">Telefono</label>
                                    <input placeholder="Ingrese el telefono" type="text" id="telefono" name="telefono" class="form-style-1">
                                </li>
                                <li>
                                    <label for="rubro">Rubro de la Empresa</label>
                                    <input placeholder="Ingrese el Rubro" type="text" id="rubro" name="rubro" class="form-style-1">
                                </li>
                                <li>
                                    <label for="correo">Correo de contacto</label>
                                    <input placeholder="Ingrese el correo" type="text" id="correo" name="correo" class="form-style-1">
                                </li>
                                <li>
                                    <a href="{{ action('ProveedoresController@index') }}" class="btn btn-primary" >Atrás</a>
                                    <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary" data-toggle="modal">Agregar</a>
                                </li>
                            </ul>
                            @include('pop-up')
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
