<div class="modal fade" id="listaActividades">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><strong>Lista de Actividades</strong></h5>
                <button tyle="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                @if(!$depto->actividades->isEmpty())
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>KPI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($depto->actividades as $actividad)
                                <tr>
                                    <td>{{ $actividad->Nombre_actividad }}</td>
                                    <td>{{ $actividad->Descripcion }}</td>
                                    <td>{{ $actividad->KPI }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p style="color: black">Actividades sin asignar</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>