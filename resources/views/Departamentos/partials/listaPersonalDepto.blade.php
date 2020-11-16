<div class="modal fade" id="listaPersonal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><strong>Lista de Personal</strong></h5>
                <button tyle="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                @if(!$depto->personal->isEmpty())
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Rut</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($depto->personal as $usuario)
                                <tr>
                                    <td>{{ $usuario->Rut }}</td>
                                    <td>{{ $usuario->getNombreCompleto() }}</td>
                                    <td>{{ $usuario->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p style="color: black">Personal sin asignar</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>