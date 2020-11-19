@extends('layoutGeneral')
@section('titulo', 'Mostrar usuario')
@section('estilos')
@endsection
@section('acciones')
@endsection
@section('cuerpo')
    <div class="card"  style="background-color: #FFFFFF;width: 100%">
        <div class="card-header">
            <h1 align="center">Información de usuario</h1>
            <a type="button" class="btn btn-primary" href="{{ route('usuarios.index') }}" role="button"><i class="fas fa-arrow-left"></i> Regresar</a>
        </div>
        <div class="card-body">
            <table>
                <tr>
                    <td>Nombre</td>
                    <td>{{$usuario->getNombreCompleto()}}</td>
                </tr>
                <tr>
                    <td>Rut</td>
                    <td>{{$usuario->Rut}}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{$usuario->email}}</td>
                </tr>
                <tr>
                    <td>¿Es Interno o Externo?</td>
                    <td>
                        @if($usuario->Es_externo == true)
                            Interno
                        @else
                            Externo
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Confiabilidad</td>
                    <td>{{$usuario->Confiabilidad}}</td>
                </tr>
                <tr>
                    <td>Ciudad</td>
                    <td>{{$usuario->ciudad->Nombre}}</td>
                </tr>
                <tr>
                    <td>Carga de proyectos</td>
                    <td>{{$usuario->Carga_proyecto}}%</td>
                </tr>
                <tr>
                    <td>Cargo</td>
                <td>
                    @if($usuario->cargo)
                        {{$usuario->cargo->Tipo_cargo}}
                    @else
                        No definido
                    @endif
                </td>
                </tr>
                <tr>
                    <td>Tipo de usuario</td>
                    <td>{{$usuario->tipo_usuario->Tipo_usuario}}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection