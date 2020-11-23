@extends('layoutGeneral')
@section('titulo', 'Lista Proyectos')
@push('estilos')
@endpush
@push('acciones')
    <script>
        $(document).ready(function() {
            var table = $('#tabla_proyectos').DataTable({
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
    <div class="card">
        <div class="card-header">
            <h1 align="center"><font color="black">Proyectos</font></h1>
        </div>
        <div class="card-body">
            <div class="column" align="left" style="padding-left: 1.5%">
                <a type="button" class="btn btn-primary" href="{{ route('home.index') }}"
                    role="button"><i class="fas fa-arrow-left"></i>
                         Regresar
                 </a>
                <a type="button" class="btn btn-primary" href="{{ route('proyectos.create') }}" role="button">
                    Agregar Proyecto
                </a>
            </div>
            <hr>
            <table class="table table-hover table-striped" id="tabla_proyectos">
                <thead>
                <tr>
                    <th>Nombre del Proyecto</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Termino</th>
                    <th>Encargado de Proyecto</th>
                    <th>Acción</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($proyectos as $dato)
                        <tr>
                            <td>{{$dato->Nombre_proyecto}}</td>
                            <td>{{$dato->Fecha_inicio}}</td>
                            <td>{{$dato->Fecha_termino}}</td>
                            <td>{{ ($dato->encargado)? $dato->encargado->getNombreCompleto() : 'Sin asignar' }}</td>
                            <td>
                                <form
                                    method="POST"
                                    action="{{ route('proyectos.destroy', $dato->id) }}"
                                    style='display:inline-flex'>
                                        @csrf
                                        @method('DELETE')
                                        
                                    <div class="btn-group">
                                        <a href="{{route('proyectos.edit', $dato->id)}}"
                                            class="btn btn-primary" title="Editar Tipo Usuario">
                                                <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="{{route('proyectos.show', $dato->id)}}"
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
