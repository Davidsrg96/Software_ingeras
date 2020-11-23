@extends('layoutGeneral')
@section('titulo', 'Lista Preguntas')
@push('estilos')
@endpush
@push('acciones')
    <script>
        $(document).ready(function() {
            var table = $('#tabla_preguntas').DataTable({
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
            <h1 align="center"><font color="black">Preguntas</font></h1>
        </div>
        <div class="card-body">
            <div class="column" align="left" style="padding-left: 1.5%">
                <a type="button" class="btn btn-primary" href="{{ route('home.index') }}" role="button"><i class="fas fa-arrow-left"></i> Regresar</a>
                <a href="{{ route('preguntas.create') }}" type="button" class="btn btn-primary pull-right">
                    Agregar Tipo de Usuario
                </a>
            </div>
            <hr>
            <table class="table table-hover table-striped" id="tabla_preguntas">
                <thead>
                <tr>
                    <th width="20px">ID</th>
                    <th>Pregunta</th>
                    <th>Tipo de pregunta</th>
                    <th>Acción</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($preguntas as $dato)
                        <tr>
                            <td>{{$dato->id}}</td>
                            <td>{{$dato->Pregunta}}</td>
                            <td>{{$dato->Tipo_pregunta}}</td>
                            <td>
                                <form
                                    method="POST"
                                    action="{{ route('preguntas.destroy', $dato->id) }}"
                                    style='display:inline-flex'>
                                        @csrf
                                        @method('DELETE')
                                        
                                    <div class="btn-group">
                                        <a href="{{route('preguntas.edit', $dato->id)}}"
                                            class="btn btn-primary" title="Editar Tipo Usuario">
                                                <i class="fas fa-pencil-alt"></i>
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
