@extends('layoutGeneral')
@section('cuerpo')
    <div class="card">
        <div class="card-header">
            @if(isset($pregunta))
                <h1 align="center"><font color="black">Editar Pregunta</font></h1>
            @else
                <h1 align="center"><font color="black">Crear Pregunta</font></h1>
            @endif
        </div>
        <div class="card-body">
            @if(isset($pregunta))
                <form role="form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="form-style-1">
                        <label>Pregunta</label>
                        <input type="text" id="pregunta" name="pregunta" class="form-style-1" placeholder="Pregunta..." value="{{$pregunta->Pregunta}}">
                    </div>
                    <div class="form-style-1">
                        <label>Tipo de Pregunta</label>
                        <select id="tipo_pregunta" name="tipo_pregunta">
                            <option value="{{$pregunta->Tipo_pregunta}}">{{$pregunta->Tipo_pregunta}}</option>
                            <option value="">--Seleccione un tipo de Pregunta--</option>
                            <option value="Usuario">Usuario</option>
                            <option value="Actividad">Actividad</option>
                            <option value="Proyecto">Proyecto</option>
                            <option value="Bodega">Bodega</option>
                        </select>
                    </div>
                    <div class="form-style-1">
                        <a href="{{ action('PreguntasController@index') }}" class="btn btn-primary">Cancelar</a>
                        <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary" data-toggle="modal">Editar</a>
                    </div>
                    @include('pop-up')
                </form>
            @else
                <form role="form" method="POST" action="{{action('PreguntasController@store')}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="form-style-1">
                        <label>Pregunta</label>
                        <input type="text" id="pregunta" name="pregunta" class="form-style-1" placeholder="Pregunta...">
                    </div>
                    <div class="form-style-1">
                        <label>Tipo de Pregunta</label>
                        <select id="tipo_pregunta" name="tipo_pregunta">
                            <option value="">--Seleccione un tipo de Pregunta--</option>
                            <option value="Usuario">Usuario</option>
                            <option value="Actividad">Actividad</option>
                            <option value="Proyecto">Proyecto</option>
                            <option value="Bodega">Bodega</option>
                        </select>
                    </div>
                    <div class="form-style-1">
                        <a href="{{ action('PreguntasController@index') }}" class="btn btn-primary">Cancelar</a>
                        <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary" data-toggle="modal">Crear</a>
                    </div>
                    @include('pop-up')
                </form>
            @endif
        </div>
    </div>
@endsection
