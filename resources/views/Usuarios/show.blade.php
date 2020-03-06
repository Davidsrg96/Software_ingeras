@extends('layoutGeneral')
@section('cuerpo')
    <div class="card">
        <div class="card-header">
            <h1 align="center">{{$usuario->Nombre}}</h1>
            <a type="button" class="btn btn-primary" href="{{action('UsuariosController@index')}}" role="button"><i class="fas fa-arrow-left"></i> Regresar</a>
        </div>
        <div class="card-body">
            <table>
                <tr>
                    <td>Nombre</td>
                    <td>{{$usuario->Nombre}}</td>
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
                    <td>{{$usuario->Ciudad}}</td>
                </tr>
                <tr>
                    <td>Carga de proyectos(en porcentaje)</td>
                    <td>{{$usuario->Carga_proyecto}}</td>
                </tr>
                <tr>
                    <td>Cargo</td>
                    <td>{{$cargo}}</td>
                </tr>
                <tr>
                    <td>Tipo de usuario</td>
                    <td>{{$tipo}}</td>
                </tr>
                @foreach($atributos as $a)
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection