<?php

use Illuminate\Database\Seeder;
use App\usuario;
use App\proveedor;
use App\producto;
use App\tipo_usuario;
use App\bodega;
use App\factura;
use App\orden_de_compra;

class FakerSeeder extends Seeder
{

    public function run()
    {
    	//USUARIOS FAKERS
        $cant = 40;
        factory(usuario::class, $cant)->create();

        $cant = 10;
		//PROVEEDORES FAKERS
		factory(proveedor::class, $cant)->create();

        $cant = 10;
        //FACTURAS FAKERS
        factory(factura::class, $cant)->create()->each(function($factura){
            //PRODUCTOS FAKERS

            $productos = producto::all();
            $codigo = ($productos->isEmpty())? 1111111111110 : producto::all()->last()->Codigo;
            $cant = rand(1,10);
            for ($i=0; $i < $cant ; $i++) {
                $codigo = $codigo + 1;
                factory(producto::class,1)
                    ->create([
                        'factura_id' => $factura->id,
                        'Codigo'     => $codigo
                    ]);
            }
        });
        
   //      factory(producto::class, 100)->create()
			// ->each(function($producto){
			// 	$producto->bodegas()->attach(bodega::all()->random()->id, ['Cantidad_almacenada' => $producto->Cantidad]);
		 // });


		//ENCARGADO BODEGA FAKER
		$tipoAbastecimiento = tipo_usuario::where('Tipo_usuario', 'Abastecimiento')->first()->id;
        $usuarios = usuario::where('tipo_usuario_id', $tipoAbastecimiento)->get();

        foreach (bodega::all() as $bodega) {
        	$bodega->update(['encargado_id'=> $usuarios->random()->id]);
        }

        //Ordenes de compra
        $pcFctory = proveedor::where('Nombre_proveedor','PERSONAL COMPUTER FACTORY S.A.')->first();
        orden_de_compra::create([
            'Numero'        => '3649386',
            'Fecha_ingreso' =>  '2019/01/23',
            'Documento'     => 'factura -trancito 2020-0001-PC.pdf',
            'proveedor_id'  => $pcFctory->id,
        ]);

        orden_de_compra::create([
            'Numero'        => '3647369',
            'Fecha_ingreso' => '2019/12/06',
            'Documento'     => 'factura -trancito 2020-0002- redes.pdf',
            'proveedor_id'  => $pcFctory->id,
        ]);

    }
}
