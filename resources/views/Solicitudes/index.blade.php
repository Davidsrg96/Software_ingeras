@extends('layoutGeneral')
@section('cuerpo')
    <h1>Solicitudes</h1>
    <div class="col">
        <a type="button" role="button" class="btn btn-primary" href="/"><i class="fas fa-arrow-left"></i> Regresar</a>
        <a type="button" role="button" class="btn btn-primary" href="{{action('SolicitudController@create')}}">Nueva Solicitud</a>
    </div>
    <h2>Solicitudes pendientes</h2>
    <table class="table table-striped table-hover" >
        <thead>
        <tr>
            <th width="20px">ID</th>
            <th>Título</th>
            <th>Status</th>
            <th>Solicitante</th>
            <th>Destinatario</th>
            <th>Fecha de Inicio</th>
            <th>Fecha de Termino</th>
            <th>Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pendientes as $p)
            <tr>
                <td>{{$p->id}}</td>
                <td>{{$p->Titulo}}</td>
                <td>{{$p->Status}}</td>
                <td>
                    @foreach($usuarios as $u)
                        @if($p->solicitante_id == $u->id)
                            {{$u->Nombre}}
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach($usuarios as $u)
                        @if($p->destino_id == $u->id)
                            {{$u->Nombre}}
                        @endif
                    @endforeach
                </td>
                <td>{{$p->Fecha_inicio}}</td>
                <td>{{$p->Fecha_termino}}</td>
                <td>
                    <a type="button" role="button" href="{{action('SolicitudController@show',$p->id)}}">
                        <i class="fas fa-eye"> Visualizar</i></a>
                </td>
                @if($p->Fecha_termino == now())
                    <div class="alert alert-warning alert-dismissible">
                        <button class="btn btn-primary" type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>¡Cuidado!</strong> Hoy es el plazo limite de la solicitud {{$p->Titulo}}
                    </div>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
    @if($solicitudes != null)
        <hr>
        <h2>Solicitudes Aprobadas y Declinadas</h2>
        <table class="table table-striped table-hover" >
            <thead>
            <tr>
                <th width="20px">ID</th>
                <th>Título</th>
                <th>Status</th>
                <th>Solicitante</th>
                <th>Destinatario</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Termino</th>
                <th>Acción</th>
            </tr>
            </thead>
            <tbody>
            @foreach($solicitudes as $s)
                <tr>
                    <td>{{$s->id}}</td>
                    <td>{{$s->Titulo}}</td>
                    <td>{{$s->Status}}</td>
                    <td>
                        @foreach($usuarios as $u)
                            @if($s->solicitante_id == $u->id)
                                {{$u->Nombre}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($usuarios as $u)
                            @if($s->destino_id == $u->id)
                                {{$u->Nombre}}
                            @endif
                        @endforeach
                    </td>
                    <td>{{$s->Fecha_inicio}}</td>
                    <td>{{$s->Fecha_termino}}</td>
                    <td>
                        <a type="button" role="button" href="{{action('SolicitudController@show',$s->id)}}">
                            <i class="fas fa-eye"> Visualizar</i></a>
                    </td>
                    <td>
                        <a type="button" role="button" href="{{action('SolicitudController@show',[$s->id])}}"></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
