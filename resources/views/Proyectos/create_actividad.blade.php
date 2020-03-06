@extends('layoutGeneral')
@section('cuerpo')
    <div>
        <div class="card" style="color: #abdde5">
            @include('error_formulario')
            <h1 align="center">Agregar Actividad</h1>
            <div class="row">
                <div class="col-md">
                    @if(isset($act))
                        <form role="form" method="POST" enctype="multipart/form-data">
                            <ul class="form-style-1">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <li>
                                    <label for="nom_act">Nombre de la Actividad<span class="required">*</span></label>
                                    <input placeholder="Actividad..." type="text" id="nom_act" name="nom_act" class="form-style-1" value="{{$act->Nombre_actividad}}">
                                </li>
                                <li>
                                    <label for="descripcion">Descripción<span class="required">*</span></label>
                                    <input placeholder="Descripcion..." type="text" id="descipcion" name="descripcion" class="form-style-1" value="{{$act->Descripcion}}">
                                </li>
                                <li>
                                    <label for="proyecto">Proyecto a cargo del área</label>
                                    <select id="proyecto" name="proyecto">
                                        <option value="{{$p->id}}">{{$p->Nombre_proyecto}}</option>
                                    </select>
                                </li>
                                <li>
                                    <label for="area">Área a cargo</label>
                                    <select id="area" name="area">
                                        <option value="{{$a->id}}">{{$a->Nombre_area}}</option>
                                    </select>
                                </li>
                                <li>
                                    <a href="{{ route('area.index',$p->id) }}" class="btn btn-primary" >Atrás</a>
                                    <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary" data-toggle="modal">Editar</a>
                                </li>
                            </ul>
                            @include('pop-up')
                        </form>
                    @else
                        <form role="form" method="POST" action="{{action('ActividadesProyectosController@store',[$p->id, $a->id])}}" enctype="multipart/form-data">
                            <ul class="form-style-1">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <li>
                                    <label for="nom_act">Nombre de la Actividad<span class="required">*</span></label>
                                    <input placeholder="Actividad..." type="text" id="nom_act" name="nom_act" class="form-style-1">
                                </li>
                                <li>
                                    <label for="descripcion">Descripción<span class="required">*</span></label>
                                    <input placeholder="Descripcion..." type="text" id="descipcion" name="descripcion" class="form-style-1">
                                </li>
                                <li>
                                    <label for="proyecto">Proyecto a cargo del área</label>
                                    <select id="proyecto" name="proyecto">
                                        <option value="{{$p->id}}">{{$p->Nombre_proyecto}}</option>
                                    </select>
                                </li>
                                <li>
                                    <label for="area">Área a cargo</label>
                                    <select id="area" name="area">
                                        <option value="{{$a->id}}">{{$a->Nombre_area}}</option>
                                    </select>
                                </li>
                                <li>
                                    <a href="{{ route('area.index',$p->id) }}" class="btn btn-primary" >Atrás</a>
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
