@extends('layoutGeneral')
@section('cuerpo')
    <div>
        <h1 align="center">Área de {{$area->Nombre_area}} del Proyecto {{$p->Nombre_proyecto}}</h1>
        <br>
        <a type="button" class="btn btn-primary" href="{{ route('area.index',$p->id) }}" role="button" style="alignment: left"><i class="fas fa-arrow-left"></i> Regresar</a>
        <a type="button" class="btn btn-primary" href="{{route('actividades.index',[$p->id,$area->id])}}" role="button" style="alignment: right"> Ver Actividades</a>
        <div class="text-body" align="center">
        </div>
    </div>
@endsection
