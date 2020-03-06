@extends('layoutGeneral')
@section('cuerpo')
<div class="card">
    <div class="col-8">
        <a type="button" role="button" class="btn btn-primary" href="{{action('SolicitudController@index')}}"><i class="fas fa-arrow-left"></i> Regresar</a>
    </div>
    <div class="card-header">
        <h1><font color="black">Solicitud {{$solicitud->Titulo}} enviada por {{$solicitante[0]->Nombre}}</font></h1>
        <p><font color="black">Fecha de emisión: {{$solicitud->Fecha_inicio}}</font></p>
        <p><font color="black">Fecha de Termino: {{$solicitud->Fecha_termino}}</font></p>
        <p><font color="black">Status de la solicitud: {{$solicitud->Status}}</font></p>
    </div>
    <hr>
    <div class="card-body">
        @if($solicitud->Status == 'Pendiente' && $solicitud->destino_id == Auth::id())
            <form role="form" method="POST" action="{{action('SolicitudController@update',$solicitud->id)}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <input type="hidden" id="status" name="status" value="Declinado">
                <button type="submit" role="button" class="btn btn-primary">Declinar</button>
            </form>
            <form role="form" method="POST" action="{{action('SolicitudController@update',$solicitud->id)}}">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <input type="hidden" id="status" name="status" value="Aprobado">
                <button type="submit" role="button" class="btn btn-primary">Finalizar</button>
            </form>
        @endif
        <hr>
        <h2>Mensaje de la solicitud</h2>
        <p><font color="black">{{$solicitud->Mensaje}}</font></p>
    </div>

</div>
@endsection
