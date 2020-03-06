@extends('layoutGeneral')
@section('cuerpo')
    <div>
        <div class="card" style="color: #abdde5">
            @include('error_formulario')
            <h1 align="center">Agregar Departamento</h1>
            <div class="row">
                <div class="col-md">
                    @if(isset($d))
                    <form role="form" method="POST" enctype="multipart/form-data">
                        <ul class="form-style-1">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <li>
                                    <label for="n_depto">Nombre del Departamento<span class="required">*</span></label>
                                    <input placeholder="Ingrese el nombre del departamento" type="text" id="nombre_depto" name="nombre_depto" class="form-style-1" value="{{$d->Nombre_departamento}}">
                                </li>
                                <li>
                                    <label for="objetivo">Objetivo del departamento<span class="required">*</span></label>
                                    <input placeholder="Ingrese el objetivo..." type="text" id="objetivo" name="objetivo" class="form-style-1" value="{{$d->Objetivo}}">
                                </li>
                                <li>
                                    <a href="{{ route('departamentos.index') }}" class="btn btn-primary" >Atrás</a>
                                    <a style="background-color: #1c7430" href="#confirmation" class="btn btn-primary" data-toggle="modal">Editar</a>
                                </li>
                        </ul>
                        @include('pop-up')
                    </form>
                    @else
                    <form role="form" method="POST" action="{{action('DepartamentosController@store')}}" enctype="multipart/form-data">
                        <ul class="form-style-1">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <li>
                                    <label for="n_depto">Nombre del Departamento<span class="required">*</span></label>
                                    <input placeholder="Ingrese el nombre del departamento" type="text" id="nombre_depto" name="nombre_depto" class="form-style-1">
                                </li>
                                <li>
                                    <label for="objetivo">Objetivo del departamento<span class="required">*</span></label>
                                    <input placeholder="Ingrese el objetivo..." type="text" id="objetivo" name="objetivo" class="form-style-1" >
                                </li>
                                <li>
                                    <a href="{{ route('departamentos.index') }}" class="btn btn-primary" >Atrás</a>
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
