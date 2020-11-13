@extends('layoutGeneral')
@section('titulo', 'Lista usuarios')
@push('estilos')
@endpush
@push('acciones')
    <script src="jquery-3.4.1.min.js" ></script>
    <script>
        $(document).ready(function() {
            var table = $('#tabla_usuario').DataTable({
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
            <h1 align="center"><font color="black">Usuarios</font></h1>
            <div class="column" align="left" style="padding-left: 1.5%">
                <a type="button" class="btn btn-primary" href="{{route('home.index')}}" role="button"><i class="fas fa-arrow-left"></i> Regresar</a>
                <a href="{{route('usuarios.create')}}" type="button" class="btn btn-primary pull-right" > Agregar Usuario</a>
            </div>
        </div>
        <div class="card-body">
           <table class="table table-hover table-striped" id="tabla_usuario">
                <thead>
                <tr>
                    <th width="20px">ID</th>
                    <th>Nombre</th>
                    <th>Rut</th>
                    <th>Tipo de usuario</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($usuarios as $u)
                    <tr>
                        <td>{{$u->id}}</td>
                        <td>{{$u->getNombreCompleto()}}</td>
                        <td>{{$u->Rut}}</td>
                        <td>{{$u->tipo_usuario->Tipo_usuario }}</td>
                        <td>
                        <form
                                method="POST"
                                action="{{ route('usuarios.destroy', $u->id) }}"
                                style='display:inline-flex'>
                                    @csrf
                                    @method('DELETE')
                                    
                                <div class="btn-group">
                                    <a href="{{route('usuarios.edit', $u->id)}}"
                                        class="btn btn-primary" title="Editar Usuario">
                                            <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="{{route('usuarios.show', $u->id)}}"
                                        class="btn btn-warning" title="Mostrar Usuario">
                                            <i class="fas fa-eye" style="color: white"></i>
                                    </a>
                                    <a href="" data-target="#del{{$u->id}}" class="btn btn-danger" 
                                        data-toggle="modal" title="Eliminar Usuario">
                                            <i class="fas fa-trash-alt" style="color: white"></i>
                                    </a>
                                </div>
                                <!--pop up confirmacion -->
                                <div class="modal fade" id="del{{$u->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirmacion</h5>
                                                <button tyle="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p><font color="black">Si presiona cancelar, no se eliminaran los cambios</font> </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                                                <button
                                                class="btn btn-primary btn-danger"
                                                type="submit">
                                                    Eliminar
                                            </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
