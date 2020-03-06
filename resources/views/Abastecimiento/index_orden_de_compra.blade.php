@extends('layoutGeneral')
@section('cuerpo')
    <div align="center">
        <p></p>
        <h1 align="center"> Ordenes de Compra </h1>
        <div>
            <a type="button" class="btn btn-primary" href="/" role="button"><i class="fas fa-arrow-left"></i> Regresar</a>
            <a type="button" class="btn btn-primary" href="{{action('OrdenDeCompraController@create')}}" role="button" >Ingresar Orden de compra</a>
            <input type="text" id="buscar" onkeyup="myFunction()" placeholder="Buscar por nombre" title="Type in a name">
        </div>
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th width="20px">ID</th>
                <th>Orden de Compra</th>
                <th>Proveedor</th>
                <th>Fecha de ingreso</th>
                <th>Factura asociada</th>

            </tr>
            @foreach($orden_compra as $oc)
                <tr>
                    <th>{{$oc->id}}</th>
                    <th>{{$oc->Orden_De_compra}}</th>
                    @foreach($proveedores as $p)
                        @if($p->id == $oc->proveedor_id)
                            <th>{{$p->Nombre_proveedor}}</th>
                        @endif
                    @endforeach
                    <th>{{$oc->Fecha_ingreso}}</th>
                    <th><a type="button" class="btn btn-primary" href="{{action('FacturaController@factura_oc',[$oc->id,$oc->proveedor_id])}}" role="button">Facturas</a></th>
                </tr>
            @endforeach
            </thead>
        </table>
    </div>
    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("buscar");
            filter = input.value.toUpperCase();
            table = document.getElementById("tabla_bodega");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
@endsection
