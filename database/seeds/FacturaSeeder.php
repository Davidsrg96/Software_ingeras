<?php

use Illuminate\Database\Seeder;
use App\factura;
use App\proveedor;
use Carbon\Carbon;

class FacturaSeeder extends Seeder
{

    public function run()
    {
    	$pcFctory = proveedor::where('Nombre_proveedor','PERSONAL COMPUTER FACTORY S.A.')->first();
        factura::create([
            'Numero'        => '3649386',
            'Fecha_ingreso' =>  '2019/01/23',
            'Estado'        => 'Completa',
            'Documento'     => 'factura -trancito 2020-0001-PC.pdf',
            'proveedor_id'  => $pcFctory->id,
        ]);

        factura::create([
            'Numero'        => '3647369',
            'Fecha_ingreso' => '2019/12/06',
            'Estado'        => 'Completa',
            'Documento'     => 'factura -trancito 2020-0002- redes.pdf',
            'proveedor_id'  => $pcFctory->id,
        ]);

        factura::create([
            'Numero'        => '3337616',
            'Fecha_ingreso' => '2019/02/12',
            'Estado'        => 'Completa',
            'Documento'     => 'factura -trancito 2020-0003- Impresion.pdf',
            'proveedor_id'  => $pcFctory->id,
        ]);

        factura::create([
            'Numero'        => '2501101',
            'Fecha_ingreso' => '2017/07/17',
            'Estado'        => 'Completa',
            'Documento'     => 'factura -trancito 2020-0004-PC.pdf',
            'proveedor_id'  => $pcFctory->id,
        ]);

        factura::create([
            'Numero'        => '3339032',
            'Fecha_ingreso' => '2019/03/13',
            'Estado'        => 'Completa',
            'Documento'     => 'factura -trancito 2020-0005-Tablet.pdf',
            'proveedor_id'  => $pcFctory->id,
        ]);

        $ferreteria = proveedor::where('Nombre_proveedor','COMERCIALIZADORA FERNORTE INDUSTRIAL LTDA.')->first();
        factura::create([
            'Numero'        => '58019',
            'Fecha_ingreso' => '2020/02/06',
            'Estado'        => 'Completa',
            'Documento'     => 'Factura transito Ferret-001 - Herr.pdf',
            'proveedor_id'  => $ferreteria->id,
        ]);

        factura::create([
            'Numero'        => '58504',
            'Fecha_ingreso' => '2020/02/25',
            'Estado'        => 'Completa',
            'Documento'     => 'Factura transito Ferret-002 - Tecle -palas.pdf',
            'proveedor_id'  => $ferreteria->id,
        ]);

        factura::create([
            'Numero'        => '57680',
            'Fecha_ingreso' => '2020/01/27',
            'Estado'        => 'Completa',
            'Documento'     => 'Factura transito Ferret-003 - Mascara -insumos soldar.pdf',
            'proveedor_id'  => $ferreteria->id,
        ]);

        factura::create([
            'Numero'        => '56835',
            'Fecha_ingreso' => '2019/12/18',
            'Estado'        => 'Completa',
            'Documento'     => 'Factura transito Ferret-004 - Esmeril -insumos.pdf',
            'proveedor_id'  => $ferreteria->id,
        ]);

        factura::create([
            'Numero'        => '56840',
            'Fecha_ingreso' => '2019/12/18',
            'Estado'        => 'Completa',
            'Documento'     => 'Factura transito Ferret-005 - Llave de torque -caja herramientas.pdf',
            'proveedor_id'  => $ferreteria->id,
        ]);
    }
}
