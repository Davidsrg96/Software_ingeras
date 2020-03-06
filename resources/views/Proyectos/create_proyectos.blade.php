@extends('layoutGeneral')
@section('cuerpo')
    <div>
        <div class="card" style="color: #abdde5">
            @include('error_formulario')
            <h1 align="center">Agregar Proyecto</h1>
            <div class="row">
                <div class="col-md">
                    @if(isset($p))
                        <form role="form" method="POST"  enctype="multipart/form-data">
                            <ul class="form-style-1">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <li>
                                    <label for="nom_proyecto">Nombre del proyecto<span class="required">*</span></label>
                                    <input value="{{$p->Nombre_proyecto}}" placeholder="Ingrese el nombre del proyecto" type="text" id="nom_proyecto" name="nom_proyecto" class="form-style-1">
                                </li>
                                <li>
                                    <label for="f_inicio">Fecha de Inicio<span class="required">*</span></label>
                                    <input value="{{$p->Fecha_inicio}}" type="date" id="f_inicio" name="f_inicio" class="form-style-1">
                                </li>
                                <li>
                                    <label for="f_termino">Fecha de Termino<span class="required">*</span></label>
                                    <input value="{{$p->Fecha_termino}}" type="date" id="f_termino" name="f_termino" class="form-style-1">
                                </li>
                                <li>
                                    <label for="p_oferta">Presupuesto de Oferta<span class="required">*</span></label>
                                    <input value="{{$p->Presupuesto_oferta}}" type="number" id="p_oferta" name="p_oferta" class="form-style-1">
                                </li>
                                <li>
                                    <label for="p_control">Presupuesto de Control<span class="required">*</span></label>
                                    <input value="{{$p->Presupuesto_control}}" type="number" id="p_control" name="p_control" class="form-style-1">
                                </li>
                                <li>
                                    <label for="encargado">Personal<span class="required">*</span></label>
                                    <input value="{{$p->Nombre}}" type="text" id="encargado" name="encargado" class="form-style-1">
                                </li>
                                <li>
                                    <a href="{{ route('proyectos.index') }}" class="btn btn-primary" >Atrás</a>
                                    <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary" data-toggle="modal">Editar</a>
                                </li>
                            </ul>
                            @include('pop-up')
                        </form>
                    @else
                        <form role="form" method="POST" action="{{action('ProyectosController@store')}}" enctype="multipart/form-data">
                            <ul class="form-style-1">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <li>
                                    <label for="nom_proyecto">Nombre del proyecto<span class="required">*</span></label>
                                    <input placeholder="Ingrese el nombre del proyecto" type="text" id="nom_proyecto" name="nom_proyecto" class="form-style-1">
                                </li>
                                <li>
                                    <label for="f_inicio">Fecha de Inicio<span class="required">*</span></label>
                                    <input type="date" id="f_inicio" name="f_inicio" class="form-style-1">
                                </li>
                                <li>
                                    <label for="f_termino">Fecha de Termino<span class="required">*</span></label>
                                    <input type="date" id="f_termino" name="f_termino" class="form-style-1">
                                </li>
                                <li>
                                    <label for="p_oferta">Presupuesto de Oferta<span class="required">*</span></label>
                                    <input type="number" id="p_oferta" name="p_oferta" class="form-style-1">
                                </li>
                                <li>
                                    <label for="p_control">Presupuesto de Control<span class="required">*</span></label>
                                    <input type="number" id="p_control" name="p_control" class="form-style-1">
                                </li>
                                <li>
                                    <label for="encargado">Encargado del Proyecto<span class="required">*</span></label>
                                    <select name="encargado" id="encargado">
                                        <option value="">--Seleccione un Usuario--</option>
                                        @foreach($usuarios as $u)
                                            <option value="{{$u->id}}">{{$u->Nombre}}</option>
                                        @endforeach
                                    </select>
                                </li>
                                <li>
                                    <a href="{{ route('proyectos.index') }}" class="btn btn-primary" >Atrás</a>
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
