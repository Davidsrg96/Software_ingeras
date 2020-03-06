@extends('layoutGeneral')
@section('cuerpo')
<div>
    <h1 align="center">Departamento de {{$d->Nombre_departamento}} </h1>
    <br>
    <a type="button" class="btn btn-primary" href="{{ route('departamentos.index') }}" role="button" style="alignment: left"><i class="fas fa-arrow-left"></i> Regresar</a>
    <a type="button" class="btn btn-primary" href="{{route('actividadesdepto.index', $id)}}" role="button" style="alignment: right"> Ver Actividades</a>
    <?php if(strcmp($d->Nombre_departamento,"Abastecimiento") == 0){?>
    <a type="button" class="btn btn-primary" href="{{action('ProveedoresController@index')}}" role="button">Proveedores</a>
    <a type="button" class="btn btn-primary" href="{{action('BodegaController@index')}}" role="button">Ver Bodega</a>
    <a type="button" class="btn btn-primary" href="{{action('OrdenDeCompraController@index')}}" role="button" >Ordenes de compra</a>
    <?php }?>
    <div class="text-body" align="center">
        <h2>Objetivo del Departamento</h2>
        {{$d->Objetivo}}
    </div>
</div>
@endsection
