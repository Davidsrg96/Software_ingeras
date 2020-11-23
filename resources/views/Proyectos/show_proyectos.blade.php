@extends('layoutGeneral')
@section('cuerpo')
    <div class="card">
        <div class="card-header">
            <h1 class="card-title" align="center">Proyecto {{$p->Nombre_proyecto}} </h1>
            <a href="{{ route('proyectos.index')}}}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Atrás</a>
            <a type="button" class="btn btn-primary" href="{{route('area.index', $p->id)}}" role="button"> Ver Areas</a>
            <a type="button" class="btn btn-primary" href="{{route('proyectos.usuarios', $p->id)}}" role="button"> Ver Usuarios</a>
        </div>
        <div class="card-body">

            <h2 class="card-subtitle">A cerca del Proyecto</h2>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"> Fecha de Inicio: {{$p->Fecha_inicio}}</li>
                <li class="list-group-item"> Fecha de Término: {{$p->Fecha_termino}}</li>
            </ul>
        </div>
    </div>
@endsection
