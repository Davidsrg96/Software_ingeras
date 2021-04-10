@extends('layoutGeneral')
@section('titulo', 'Lista Departamentos')
@push('estilos')
@endpush
@push('acciones')
    <script>
        $(document).ready(function() {
            var table = $('#tablaDepto').DataTable({
                language: {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
        });


        //Toaster
        @if(Session::has('success'))
            mensajeEmergente('{{ Session::get('success')['titulo'] }}', '{{ Session::get('success')['mensaje'] }}');
        @endif
        @if(Session::has('fail'))
            mensajeEmergente('{{ Session::get('fail')['titulo'] }}', '{{ Session::get('fail')['mensaje'] }}', 'error');
        @endif
    </script>
@endpush
@section('cuerpo')
<<<<<<< HEAD
    <div class="panel-header panel-header-sm"></div>
    <div class="content col-md-10 offset-1">
        <div class="row">
             <div class="card">
                <div class="card-header">
                    <h2 class="title text-center">Departamentos</h2>
                </div>
                <hr>
                <div class="card-body">
                    <a type="button" class="btn btn-primary" href="{{route('home')}}" role="button">
                        <i class="fas fa-arrow-left"></i>Regresar
                    </a>
                    <a href="{{ route('departamentos.create') }}" type="button" class="btn btn-success" >
                        Agregar Departamento
                    </a>
                   <table class="table table-hover table-striped" id="tablaDepto">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Objetivo</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($departamentos as $dato)
                            <tr>
                                <td>{{$dato->Nombre_departamento}}</td>
                                <td>{{$dato->Objetivo}}</td>
                                <td>
                                    <form
                                        method="POST"
                                        action="{{ route('departamentos.destroy', $dato->id) }}"
                                        style='display:inline-flex'>
                                            @csrf
                                            @method('DELETE')
                                            
                                        <div class="btn-group">
                                            <a href="{{route('departamentos.edit', $dato->id)}}"
                                                class="btn btn-primary btn-round" title="Editar Usuario">
                                                    <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href="{{route('departamentos.show', $dato->id)}}"
                                                class="btn btn-warning" title="Mostrar Usuario">
                                                    <i class="fas fa-eye" style="color: white"></i>
                                            </a>
                                            <a href="" data-target="#del{{$dato->id}}"
                                                class="btn btn-danger btn-round" data-toggle="modal"
                                                title="Eliminar Usuario">
                                                    <i class="fas fa-trash-alt" style="color: white"></i>
                                            </a>
                                        </div>
                                        <!--pop up confirmacion -->
                                        @include('layouts.pop-up.confirmacionDelete')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
=======
     <div class="card">
        <div class="card-header">
            <h1 align="center"><font color="black">Departamentos</font></h1>
            <div class="column" align="left" style="padding-left: 1.5%">
                <a type="button" class="btn btn-primary" href="{{route('home.index')}}" role="button"><i class="fas fa-arrow-left"></i> Regresar</a>
                <a href="{{route('departamentos.create')}}" type="button" class="btn btn-primary pull-right" >
                    Agregar Departamento
                </a>
>>>>>>> parent of 2c803cf (modificaciones)
            </div>
        </div>
        <div class="card-body">
           <table class="table table-hover table-striped" id="tablaDepto">
                <thead>
                <tr>
                    <th>Nombre del Departamento</th>
                    <th>Objetivo</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($departamentos as $dato)
                    <tr>
                        <td>{{$dato->Nombre_departamento}}</td>
                        <td>{{$dato->Objetivo}}</td>
                        <td>
                            <form
                                method="POST"
                                action="{{ route('departamentos.destroy', $dato->id) }}"
                                style='display:inline-flex'>
                                    @csrf
                                    @method('DELETE')
                                    
                                <div class="btn-group">
                                    <a href="{{route('departamentos.edit', $dato->id)}}"
                                        class="btn btn-primary" title="Editar Usuario">
                                            <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="{{route('departamentos.show', $dato->id)}}"
                                        class="btn btn-warning" title="Mostrar Usuario">
                                            <i class="fas fa-eye" style="color: white"></i>
                                    </a>
                                    <a href="" data-target="#del{{$dato->id}}" class="btn btn-danger" 
                                        data-toggle="modal" title="Eliminar Usuario">
                                            <i class="fas fa-trash-alt" style="color: white"></i>
                                    </a>
                                </div>
                                <!--pop up confirmacion -->
                                @include('layouts.pop-up.confirmacionDelete')
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
