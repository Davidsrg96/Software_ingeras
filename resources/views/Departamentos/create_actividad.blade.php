@extends('layoutGeneral')
@section('cuerpo')
    <div>
        <div class="card" style="color: #abdde5">
            @include('error_formulario')
            <h1 align="center"> Agregar Actividad</h1>
            <div class="row">
                <div class="col-md">
                    @if(isset($act))
                        <form role="form" method="POST" action="{{route('actividadesdepto.actualizar', [$act->id, $id])}}" enctype="multipart/form-data">
                            <ul class="form-style-1">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <li>
                                    <label for="nom_actividad">Nombre de la Actividad<span class="required">*</span></label>
                                    <input placeholder="Ingrese el nombre de la Actividad" type="text" id="nom_actividad" name="nom_actividad" class="form-style-1" value="{{$act->Nombre_actividad}}">
                                </li>
                                <li>
                                    <label for="descripcion">Descripcion de la actividad<span class="required">*</span></label>
                                    <input placeholder="Descripcion de la actividad..." type="text" id="descripcion" name="descripcion" class="form-style-1" value="{{$act->Descripcion}}">
                                </li>
                                <li>
                                    <a href="{{ route('actividadesdepto.index', $id) }}" class="btn btn-primary" >Atrás</a>
                                    <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary" data-toggle="modal">Editar</a>
                                </li>
                            </ul>
                            @include('pop-up')
                        </form>
                    @else
                        <form role="form" method="POST" action="{{route('actividadesdepto.store', $id)}}" enctype="multipart/form-data">
                            <ul class="form-style-1">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <li>
                                    <label for="nom_actividad">Nombre de la Actividad<span class="required">*</span></label>
                                    <input placeholder="Ingrese el nombre de la Actividad" type="text" id="nom_actividad" name="nom_actividad" class="form-style-1">
                                </li>
                                <li>
                                    <label for="descripcion">Descripcion de la actividad<span class="required">*</span></label>
                                    <input placeholder="Descripcion de la actividad..." type="text" id="descripcion" name="descripcion" class="form-style-1">
                                </li>
                                <li>
                                    <a href="{{ route('actividadesdepto.index', $id) }}" class="btn btn-primary" >Atrás</a>
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
