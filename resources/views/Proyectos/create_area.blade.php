@extends('layoutGeneral')
@section('cuerpo')
    <div>
        <div class="card" style="color: #abdde5">
            @include('error_formulario')
            <h1 align="center">Agregar Area</h1>
            <div class="row">
                <div class="col-md">
                @if(isset($a))
                    <form role="form" method="POST"  enctype="multipart/form-data">
                        <ul class="form-style-1">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <li>
                                <label for="nom_area">Nombre del Área<span class="required">*</span></label>
                                <input value="{{$a->Nombre_area}}" placeholder="Ingrese el nombre del área" type="text" id="nom_area" name="nom_area" class="form-style-1">
                            </li>
                            <li>
                                <label for="porcentaje">Porcentaje Asignado<span class="required">*</span></label>
                                <input value="{{$a->Porcentaje_asignado}}" type="number" id="porcentaje" name="porcentaje" class="form-style-1">
                            </li>
                            <li>
                                <label for="personal">Personal<span class="required">*</span></label>
                                <input value="{{$a->Personal}}" placeholder="Ingrese nombre del personal" type="text" id="personal" name="personal" class="form-style-1">
                            </li>
                            <li>
                                <label for="proyecto">Proyecto a cargo del área</label>
                                <select id="proyecto" name="proyecto">
                                    <option value="{{$p->id}}">{{$p->Nombre_proyecto}}</option>
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
                    <form role="form" method="POST" action="{{action('AreaProyectosController@store',$p->id)}}" enctype="multipart/form-data">
                        <ul class="form-style-1">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <li>
                                <label for="nom_area">Nombre del Área<span class="required">*</span></label>
                                <input placeholder="Ingrese el nombre del área" type="text" id="nom_area" name="nom_area" class="form-style-1">
                            </li>
                            <li>
                                <label for="porcentaje">Porcentaje Asignado<span class="required">*</span></label>
                                <input type="number" id="porcentaje" name="porcentaje" class="form-style-1">
                            </li>
                            <li>
                                <label for="personal">Personal<span class="required">*</span></label>
                                <input placeholder="Ingrese nombre del personal" type="text" id="personal" name="personal" class="form-style-1">
                            </li>
                            <li>
                                <label for="proyecto">Proyecto a cargo del área</label>
                                <select id="proyecto" name="proyecto">
                                    <option value="{{$p->id}}">{{$p->Nombre_proyecto}}</option>
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
    <script type="text/javascript">
        function ShowSelected()
        {
            /* Para obtener los valores de la etiqueta select */
            var tipo = document.getElementById("proyecto").value;
        }
    </script>
@endsection

