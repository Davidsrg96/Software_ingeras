<?php

use Illuminate\Database\Seeder;
use App\producto;
use App\bodega;
use App\factura;

class ProductoSeeder extends Seeder
{

    public function run()
    {
    	$bodega = bodega::where('Nombre','Bodega Central')->first();
    	$factura = factura::where('Documento','factura -trancito 2020-0001-PC.pdf')->first();
    	$codigo = 1111111111110;

    	$codigo = $codigo + 1;
		producto::create([
			'Codigo'          => $codigo,
        	'Descripcion'     => 'Notebook X507UA 15.6" HD Pentium Gold N4417 4GB 500GB Windows 10 X507UA-BR1006T',
        	'Precio_producto' => '199235',
        	'Estado'          => 'Disponible',
        	'Tipo_producto'   => 'Herramienta',
        	'factura_id'      => $factura->id,
        	'proveedor_id'    => $factura->proveedor->id,
        	'bodega_id'       => $bodega->id,
        ]);

        $codigo = $codigo + 1;
		producto::create([
			'Codigo'          => $codigo,
        	'Descripcion'     => 'Notebook 15.6" HD Intel Pentium Gold 4417U 4GB 500GB Windows 10 15-da0039la',
        	'Precio_producto' => '225202',
        	'Estado'          => 'Disponible',
        	'Tipo_producto'   => 'Herramienta',
        	'factura_id'      => $factura->id,
        	'proveedor_id'    => $factura->proveedor->id,
        	'bodega_id'       => $bodega->id,
        ]);


    	$factura = factura::where('Documento','factura -trancito 2020-0002- redes.pdf')->first();
        $codigo = $codigo + 1;
        producto::create([
			'Codigo'          => $codigo,
        	'Descripcion'     => 'Router AC1900 DIR-878',
        	'Precio_producto' => '115118',
        	'Estado'          => 'Disponible',
        	'Tipo_producto'   => 'Herramienta',
        	'factura_id'      => $factura->id,
        	'proveedor_id'    => $factura->proveedor->id,
        	'bodega_id'       => $bodega->id,
        ]);

        $codigo = $codigo + 1;
        producto::create([
			'Codigo'          => $codigo,
        	'Descripcion'     => 'Switch 24b DGS-1024D 10/100/1000',
        	'Precio_producto' => '88227',
        	'Estado'          => 'Disponible',
        	'Tipo_producto'   => 'Herramienta',
        	'factura_id'      => $factura->id,
        	'proveedor_id'    => $factura->proveedor->id,
        	'bodega_id'       => $bodega->id,
        ]);

        $factura = factura::where('Documento','factura -trancito 2020-0003- Impresion.pdf')->first();
        $codigo = $codigo + 1;
        producto::create([
			'Codigo'          => $codigo,
        	'Descripcion'     => 'Multifuncional Led Color Ethernet/WiFi/Fax/D?plex/ADF MFC-L3750CDW',
        	'Precio_producto' => '285874',
        	'Estado'          => 'Disponible',
        	'Tipo_producto'   => 'Herramienta',
        	'factura_id'      => $factura->id,
        	'proveedor_id'    => $factura->proveedor->id,
        	'bodega_id'       => $bodega->id,
        ]);

        $codigo = $codigo + 1;
        producto::create([
			'Codigo'          => $codigo,
        	'Descripcion'     => 'Garant?a Extendida N? ???? por 12 meses [ID 31608]',
        	'Precio_producto' => '19151',
        	'Estado'          => 'Disponible',
        	'Tipo_producto'   => 'Herramienta',
        	'factura_id'      => $factura->id,
        	'proveedor_id'    => $factura->proveedor->id,
        	'bodega_id'       => $bodega->id,
        ]);

        $codigo = $codigo + 1;
        producto::create([
			'Codigo'          => $codigo,
        	'Descripcion'     => 'Bolsa PCF 60x40x25 * Promocion',
        	'Precio_producto' => '412',
        	'Estado'          => 'Disponible',
        	'Tipo_producto'   => 'Material',
        	'factura_id'      => $factura->id,
        	'proveedor_id'    => $factura->proveedor->id,
        	'bodega_id'       => $bodega->id,
        ]);

        $codigo = $codigo + 1;
        producto::create([
			'Codigo'          => $codigo,
        	'Descripcion'     => 'Toner TN-217 Negro',
        	'Precio_producto' => '68143',
        	'Estado'          => 'Disponible',
        	'Tipo_producto'   => 'Herramienta',
        	'factura_id'      => $factura->id,
        	'proveedor_id'    => $factura->proveedor->id,
        	'bodega_id'       => $bodega->id,
        ]);

        $codigo = $codigo + 1;
        producto::create([
			'Codigo'          => $codigo,
        	'Descripcion'     => 'Toner TN-217 Cyan',
        	'Precio_producto' => '73017',
        	'Estado'          => 'Disponible',
        	'Tipo_producto'   => 'Herramienta',
        	'factura_id'      => $factura->id,
        	'proveedor_id'    => $factura->proveedor->id,
        	'bodega_id'       => $bodega->id,
        ]);

        $codigo = $codigo + 1;
        producto::create([
			'Codigo'          => $codigo,
        	'Descripcion'     => 'Toner TN-217 Magenta',
        	'Precio_producto' => '73017',
        	'Estado'          => 'Disponible',
        	'Tipo_producto'   => 'Herramienta',
        	'factura_id'      => $factura->id,
        	'proveedor_id'    => $factura->proveedor->id,
        	'bodega_id'       => $bodega->id,
        ]);

        $codigo = $codigo + 1;
        producto::create([
			'Codigo'          => $codigo,
        	'Descripcion'     => 'Toner TN-217 Amarillo',
        	'Precio_producto' => '73017',
        	'Estado'          => 'Disponible',
        	'Tipo_producto'   => 'Herramienta',
        	'factura_id'      => $factura->id,
        	'proveedor_id'    => $factura->proveedor->id,
        	'bodega_id'       => $bodega->id,
        ]);


        $factura = factura::where('Documento','factura -trancito 2020-0004-PC.pdf')->first();
        $codigo = $codigo + 1;
        producto::create([
			'Codigo'          => $codigo,
        	'Descripcion'     => 'Notebook 240 G5 Intel Core i5-6200U 4GB 1TB 14" Windows 10',
        	'Precio_producto' => '303185',
        	'Estado'          => 'Disponible',
        	'Tipo_producto'   => 'Herramienta',
        	'factura_id'      => $factura->id,
        	'proveedor_id'    => $factura->proveedor->id,
        	'bodega_id'       => $bodega->id,
        ]);


        $factura = factura::where('Documento','factura -trancito 2020-0005-Tablet.pdf')->first();

        for ($i=0; $i < 2; $i++) { 
	        $codigo = $codigo + 1;
	        producto::create([
				'Codigo'          => $codigo,
	        	'Descripcion'     => 'Tablet MediaPad T3 10 2GB 16GB 9.6" IPS Android 7.0 Negro',
	        	'Precio_producto' => '100832',
	        	'Estado'          => 'Disponible',
	        	'Tipo_producto'   => 'Herramienta',
	        	'factura_id'      => $factura->id,
	        	'proveedor_id'    => $factura->proveedor->id,
	        	'bodega_id'       => $bodega->id,
	        ]);
        }
        
        $codigo = $codigo + 1;
        producto::create([
			'Codigo'          => $codigo,
        	'Descripcion'     => 'Office 365 Personal 32/64 bit',
        	'Precio_producto' => '36126',
        	'Estado'          => 'Disponible',
        	'Tipo_producto'   => 'Herramienta',
        	'factura_id'      => $factura->id,
        	'proveedor_id'    => $factura->proveedor->id,
        	'bodega_id'       => $bodega->id,
        ]);
        
        $codigo = $codigo + 1;
        producto::create([
			'Codigo'          => $codigo,
        	'Descripcion'     => 'Bolsa PCF 60x40x25 * Promocion',
        	'Precio_producto' => '412',
        	'Estado'          => 'Disponible',
        	'Tipo_producto'   => 'Material',
        	'factura_id'      => $factura->id,
        	'proveedor_id'    => $factura->proveedor->id,
        	'bodega_id'       => $bodega->id,
        ]);


        $factura = factura::where('Documento','Factura transito Ferret-001 - Herr.pdf')->first();
        $codigo = $codigo + 1;
        producto::create([
			'Codigo'          => $codigo,
        	'Descripcion'     => 'TERRAJA DE 1/2 A 2 NPT. MOD:6107200. MARCA:SMART',
        	'Precio_producto' => '112621.02',
        	'Estado'          => 'Disponible',
        	'Tipo_producto'   => 'Herramienta',
        	'factura_id'      => $factura->id,
        	'proveedor_id'    => $factura->proveedor->id,
        	'bodega_id'       => $bodega->id,
        ]);

        for ($i=0; $i < 2; $i++) { 
	        $codigo = $codigo + 1;
	        producto::create([
				'Codigo'          => $codigo,
	        	'Descripcion'     => 'DISCO ZIRCONIO DE METAL LAMINA 4.5 GRANO 80, DIAM',
	        	'Precio_producto' => '859.19',
	        	'Estado'          => 'Disponible',
	        	'Tipo_producto'   => 'Material',
	        	'factura_id'      => $factura->id,
	        	'proveedor_id'    => $factura->proveedor->id,
	        	'bodega_id'       => $bodega->id,
	        ]);
        }
        
        for ($i=0; $i < 10; $i++) { 
	        $codigo = $codigo + 1;
	        producto::create([
				'Codigo'          => $codigo,
	        	'Descripcion'     => 'HOJA SIERRA BI-METAL SANDFLEX 12 x24DIENTES, BAHCO',
	        	'Precio_producto' => '859.19',
	        	'Estado'          => 'Disponible',
	        	'Tipo_producto'   => 'Material',
	        	'factura_id'      => $factura->id,
	        	'proveedor_id'    => $factura->proveedor->id,
	        	'bodega_id'       => $bodega->id,
	        ]);
        }

        $codigo = $codigo + 1;
        producto::create([
			'Codigo'          => $codigo,
        	'Descripcion'     => 'JUEGO DE LLAVES PUNTA CORONA 14 PZS. DE 10 - 32 MM',
        	'Precio_producto' => '58849.7',
        	'Estado'          => 'Disponible',
        	'Tipo_producto'   => 'Herramienta',
        	'factura_id'      => $factura->id,
        	'proveedor_id'    => $factura->proveedor->id,
        	'bodega_id'       => $bodega->id,
        ]);
        
        $codigo = $codigo + 1;
        producto::create([
			'Codigo'          => $codigo,
        	'Descripcion'     => 'JUEGO DE DADOS HEX. [] 1/2 , S240, 24PCS. DE 10-36',
        	'Precio_producto' => '66495.55',
        	'Estado'          => 'Disponible',
        	'Tipo_producto'   => 'Herramienta',
        	'factura_id'      => $factura->id,
        	'proveedor_id'    => $factura->proveedor->id,
        	'bodega_id'       => $bodega->id,
        ]);
        
        $codigo = $codigo + 1;
        producto::create([
			'Codigo'          => $codigo,
        	'Descripcion'     => 'DOBLADORA DE TUBOS HIDRAULICA 3P, HHW-3J, ROBERT T',
        	'Precio_producto' => '415360',
        	'Estado'          => 'Disponible',
        	'Tipo_producto'   => 'Herramienta',
        	'factura_id'      => $factura->id,
        	'proveedor_id'    => $factura->proveedor->id,
        	'bodega_id'       => $bodega->id,
        ]);

        $codigo = $codigo + 1;
        producto::create([
			'Codigo'          => $codigo,
        	'Descripcion'     => 'JUEGO DE BROCAS HSS CILINDRICAS DE 1 A 13 MM 21 PZ',
        	'Precio_producto' => '36387.03',
        	'Estado'          => 'Disponible',
        	'Tipo_producto'   => 'Herramienta',
        	'factura_id'      => $factura->id,
        	'proveedor_id'    => $factura->proveedor->id,
        	'bodega_id'       => $bodega->id,
        ]);



        $factura = factura::where('Documento','Factura transito Ferret-002 - Tecle -palas.pdf')->first();

        for ($i=0; $i < 8; $i++) {
	        $codigo = $codigo + 1;
	        producto::create([
				'Codigo'          => $codigo,
	        	'Descripcion'     => 'PALA CARBONERA M/FIBRA PCAY-F, TRUPER',
	        	'Precio_producto' => '12084.3',
	        	'Estado'          => 'Disponible',
	        	'Tipo_producto'   => 'Herramienta',
	        	'factura_id'      => $factura->id,
	        	'proveedor_id'    => $factura->proveedor->id,
	        	'bodega_id'       => $bodega->id,
	        ]);
        }

        $codigo = $codigo + 1;
        producto::create([
			'Codigo'          => $codigo,
        	'Descripcion'     => 'SET DE TIZADOR 30 MTS INCLUYE TIZA AZUL 227GR Y NI',
        	'Precio_producto' => '8092.45',
        	'Estado'          => 'Disponible',
        	'Tipo_producto'   => 'Herramienta',
        	'factura_id'      => $factura->id,
        	'proveedor_id'    => $factura->proveedor->id,
        	'bodega_id'       => $bodega->id,
        ]);

        $codigo = $codigo + 1;
        producto::create([
			'Codigo'          => $codigo,
        	'Descripcion'     => 'TECLE MANUAL PALANCA 750 KG. X 1,5 MT LEV. R.TOOLS',
        	'Precio_producto' => '97599.24',
        	'Estado'          => 'Disponible',
        	'Tipo_producto'   => 'Herramienta',
        	'factura_id'      => $factura->id,
        	'proveedor_id'    => $factura->proveedor->id,
        	'bodega_id'       => $bodega->id,
        ]);


		$factura = factura::where('Documento','Factura transito Ferret-003 - Mascara -insumos soldar.pdf')->first();
		for ($i=0; $i < 10; $i++) {
			$codigo = $codigo + 1;
			producto::create([
				'Codigo'          => $codigo,
				'Descripcion'     => 'SOLDADURA? E 6011? 3/32 ? 2.5MM? 1 KG KRAFTER',
				'Precio_producto' => '2365.52',
				'Estado'          => 'Disponible',
				'Tipo_producto'   => 'Material',
				'factura_id'      => $factura->id,
				'proveedor_id'    => $factura->proveedor->id,
				'bodega_id'       => $bodega->id,
			]);
		}

		for ($i=0; $i < 10; $i++) {
			$codigo = $codigo + 1;
			producto::create([
				'Codigo'          => $codigo,
				'Descripcion'     => 'SOLDADURA? E 7018? 3/32 ? 2.5MM? 1 KG, KRAFTER',
				'Precio_producto' => '2540.16',
				'Estado'          => 'Disponible',
				'Tipo_producto'   => 'Material',
				'factura_id'      => $factura->id,
				'proveedor_id'    => $factura->proveedor->id,
				'bodega_id'       => $bodega->id,
			]);
		}

		for ($i=0; $i < 50; $i++) {
			$codigo = $codigo + 1;
			producto::create([
				'Codigo'          => $codigo,
				'Descripcion'     => 'DISCO CORTE RECTO 7 X7/8 3MM ESPES GRANO 30 BOSCH',
				'Precio_producto' => '886.98',
				'Estado'          => 'Disponible',
				'Tipo_producto'   => 'Material',
				'factura_id'      => $factura->id,
				'proveedor_id'    => $factura->proveedor->id,
				'bodega_id'       => $bodega->id,
			]);
		}

		for ($i=0; $i < 50; $i++) {
			$codigo = $codigo + 1;
			producto::create([
				'Codigo'          => $codigo,
				'Descripcion'     => 'DISCO CORTE RECTO 4 1/2 X 7/8 , 2,5MM GR 30 BOSCH',
				'Precio_producto' => '531.81',
				'Estado'          => 'Disponible',
				'Tipo_producto'   => 'Material',
				'factura_id'      => $factura->id,
				'proveedor_id'    => $factura->proveedor->id,
				'bodega_id'       => $bodega->id,
			]);
		}

		for ($i=0; $i < 5; $i++) {
			$codigo = $codigo + 1;
			producto::create([
				'Codigo'          => $codigo,
				'Descripcion'     => 'DISCO CORTE RECTO 14 X1 2,8MM ESPE GRANO 30 BOSCH',
				'Precio_producto' => '3055.58',
				'Estado'          => 'Disponible',
				'Tipo_producto'   => 'Material',
				'factura_id'      => $factura->id,
				'proveedor_id'    => $factura->proveedor->id,
				'bodega_id'       => $bodega->id,
			]);
		}

		for ($i=0; $i < 10; $i++) { 
			$codigo = $codigo + 1;
			producto::create([
				'Codigo'          => $codigo,
				'Descripcion'     => 'DISCO DESBASTE 7 X7/8 6MM ESPESOR, GRANO 24 BOSCH',
				'Precio_producto' => '1360.54',
				'Estado'          => 'Disponible',
				'Tipo_producto'   => 'Material',
				'factura_id'      => $factura->id,
				'proveedor_id'    => $factura->proveedor->id,
				'bodega_id'       => $bodega->id,
			]);
		}

		$codigo = $codigo + 1;
		producto::create([
			'Codigo'          => $codigo,
			'Descripcion'     => 'MASCARA FOTOSENSIBLE EAGLE BLISTER. MARCA:KRAFTE',
			'Precio_producto' => '36529.5',
			'Estado'          => 'Disponible',
			'Tipo_producto'   => 'Material',
			'factura_id'      => $factura->id,
			'proveedor_id'    => $factura->proveedor->id,
			'bodega_id'       => $bodega->id,
		]);

		$codigo = $codigo + 1;
		producto::create([
			'Codigo'          => $codigo,
			'Descripcion'     => 'MASCARA FOTOSENSIBLE FLAMA BLISTER, KRAFTER',
			'Precio_producto' => '42809.2',
			'Estado'          => 'Disponible',
			'Tipo_producto'   => 'Material',
			'factura_id'      => $factura->id,
			'proveedor_id'    => $factura->proveedor->id,
			'bodega_id'       => $bodega->id,
		]);


		$factura = factura::where('Documento','Factura transito Ferret-004 - Esmeril -insumos.pdf')->first();
		for ($i=0; $i < 50; $i++) { 
			$codigo = $codigo + 1;
			producto::create([
				'Codigo'          => $codigo,
				'Descripcion'     => 'DISCO CORTE RECTO 7 X7/8 3MM ESPES GRANO 30 BOSCH',
				'Precio_producto' => '821',
				'Estado'          => 'Disponible',
				'Tipo_producto'   => 'Material',
				'factura_id'      => $factura->id,
				'proveedor_id'    => $factura->proveedor->id,
				'bodega_id'       => $bodega->id,
			]);
		}

		for ($i=0; $i < 50; $i++) {
			$codigo = $codigo + 1;
			producto::create([
				'Codigo'          => $codigo,
				'Descripcion'     => 'DISCO CORTE RECTO 4 1/2 X 7/8 , 2,5MM GR 30 BOSCH',
				'Precio_producto' => '493',
				'Estado'          => 'Disponible',
				'Tipo_producto'   => 'Material',
				'factura_id'      => $factura->id,
				'proveedor_id'    => $factura->proveedor->id,
				'bodega_id'       => $bodega->id,
			]);
		}

		for ($i=0; $i < 2; $i++) {
			$codigo = $codigo + 1;
			producto::create([
				'Codigo'          => $codigo,
				'Descripcion'     => 'DISCO ZIRCONIO DE METAL LAMINA 7 GRANO 60, DIAMET',
				'Precio_producto' => '2346',
				'Estado'          => 'Disponible',
				'Tipo_producto'   => 'Material',
				'factura_id'      => $factura->id,
				'proveedor_id'    => $factura->proveedor->id,
				'bodega_id'       => $bodega->id,
			]);
		}

		for ($i=0; $i < 2; $i++) {
			$codigo = $codigo + 1;
			producto::create([
				'Codigo'          => $codigo,
				'Descripcion'     => 'FEELER METRICO DE 20 PIEZAS, RANGO DE 0.05 - 1.00',
				'Precio_producto' => '5352',
				'Estado'          => 'Disponible',
				'Tipo_producto'   => 'Herramienta',
				'factura_id'      => $factura->id,
				'proveedor_id'    => $factura->proveedor->id,
				'bodega_id'       => $bodega->id,
			]);
		}

		$codigo = $codigo + 1;
		producto::create([
			'Codigo'          => $codigo,
			'Descripcion'     => 'ESMERIL ANGULAR 7 180MM 2200W 8500RPM HM, MAKITA',
			'Precio_producto' => '106662',
			'Estado'          => 'Disponible',
			'Tipo_producto'   => 'Herramienta',
			'factura_id'      => $factura->id,
			'proveedor_id'    => $factura->proveedor->id,
			'bodega_id'       => $bodega->id,
		]);

		$codigo = $codigo + 1;
		producto::create([
			'Codigo'          => $codigo,
			'Descripcion'     => 'ROLLO TEFLON DE 3/4 X 0.075 MM X 10 MTS.',
			'Precio_producto' => '235',
			'Estado'          => 'Disponible',
			'Tipo_producto'   => 'Material',
			'factura_id'      => $factura->id,
			'proveedor_id'    => $factura->proveedor->id,
			'bodega_id'       => $bodega->id,
		]);

		for ($i=0; $i < 2; $i++) { 
			$codigo = $codigo + 1;
			producto::create([
				'Codigo'          => $codigo,
				'Descripcion'     => 'ESMERIL ANGULAR 4.1/2 ELEC 220V, 720W, H/M, MAKITA',
				'Precio_producto' => '50475',
				'Estado'          => 'Disponible',
				'Tipo_producto'   => 'Herramienta',
				'factura_id'      => $factura->id,
				'proveedor_id'    => $factura->proveedor->id,
				'bodega_id'       => $bodega->id,
			]);
		}


		$factura = factura::where('Documento','Factura transito Ferret-005 - Llave de torque -caja herramientas.pdf')->first();
		for ($i=0; $i < 2; $i++) {
			$codigo = $codigo + 1;
			producto::create([
				'Codigo'          => $codigo,
				'Descripcion'     => 'CAJA DE HERRAMIENTA METALICA NARANJA, 5 CAJONES, 2',
				'Precio_producto' => '15791',
				'Estado'          => 'Disponible',
				'Tipo_producto'   => 'Herramienta',
				'factura_id'      => $factura->id,
				'proveedor_id'    => $factura->proveedor->id,
				'bodega_id'       => $bodega->id,
			]);
		}

		$codigo = $codigo + 1;
		producto::create([
			'Codigo'          => $codigo,
			'Descripcion'     => 'JUEGO DE LLAVES ALLEN 13 PZS. DE 1/16 - 3/4 MOD.',
			'Precio_producto' => '18904',
			'Estado'          => 'Disponible',
			'Tipo_producto'   => 'Herramienta',
			'factura_id'      => $factura->id,
			'proveedor_id'    => $factura->proveedor->id,
			'bodega_id'       => $bodega->id,
		]);
		
		for ($i=0; $i < 2; $i++) {
			$codigo = $codigo + 1;
			producto::create([
				'Codigo'          => $codigo,
				'Descripcion'     => 'HUINCHA DE 5 MTS, TRUPER.',
				'Precio_producto' => '3142',
				'Estado'          => 'Disponible',
				'Tipo_producto'   => 'Material',
				'factura_id'      => $factura->id,
				'proveedor_id'    => $factura->proveedor->id,
				'bodega_id'       => $bodega->id,
			]);
		}
		
		for ($i=0; $i < 2; $i++) {
			$codigo = $codigo + 1;
			producto::create([
				'Codigo'          => $codigo,
				'Descripcion'     => 'MACETA DE BRONCE BRASS DE 4 LB. CON MANGO ORIGINAL',
				'Precio_producto' => '43056',
				'Estado'          => 'Disponible',
				'Tipo_producto'   => 'Herramienta',
				'factura_id'      => $factura->id,
				'proveedor_id'    => $factura->proveedor->id,
				'bodega_id'       => $bodega->id,
			]);
		}
		
		for ($i=0; $i < 2; $i++) {
			$codigo = $codigo + 1;
			producto::create([
				'Codigo'          => $codigo,
				'Descripcion'     => 'CHUZO DE 7/8X 1 MTS.3.2 KLS, TRUPER',
				'Precio_producto' => '43056',
				'Estado'          => 'Disponible',
				'Tipo_producto'   => 'Herramienta',
				'factura_id'      => $factura->id,
				'proveedor_id'    => $factura->proveedor->id,
				'bodega_id'       => $bodega->id,
			]);
		}

		$codigo = $codigo + 1;
		producto::create([
			'Codigo'          => $codigo,
			'Descripcion'     => 'JUEGO DE LLAVES DE DADO POLIGONAL [] 1/4 Y 1/2 P',
			'Precio_producto' => '65883',
			'Estado'          => 'Disponible',
			'Tipo_producto'   => 'Herramienta',
			'factura_id'      => $factura->id,
			'proveedor_id'    => $factura->proveedor->id,
			'bodega_id'       => $bodega->id,
		]);

		$codigo = $codigo + 1;
		producto::create([
			'Codigo'          => $codigo,
			'Descripcion'     => 'LLAVE TORQUE []1/2 RNG30-250FT-LB 2503MFRMH, CDI',
			'Precio_producto' => '157921',
			'Estado'          => 'Disponible',
			'Tipo_producto'   => 'Herramienta',
			'factura_id'      => $factura->id,
			'proveedor_id'    => $factura->proveedor->id,
			'bodega_id'       => $bodega->id,
		]);

		for ($i=0; $i < 2; $i++) {
			$codigo = $codigo + 1;
			producto::create([
				'Codigo'          => $codigo,
				'Descripcion'     => 'JUEGO DE DESTORNILLADORES PARA TORNILLOS PHILLIPS',
				'Precio_producto' => '11868',
				'Estado'          => 'Disponible',
				'Tipo_producto'   => 'Herramienta',
				'factura_id'      => $factura->id,
				'proveedor_id'    => $factura->proveedor->id,
				'bodega_id'       => $bodega->id,
			]);
		}

		for ($i=0; $i < 2; $i++) {
			$codigo = $codigo + 1;
			producto::create([
				'Codigo'          => $codigo,
				'Descripcion'     => 'SET ALICATES UNIV. 180MM CORT. 160MM PTA 200MM, IR',
				'Precio_producto' => '11501',
				'Estado'          => 'Disponible',
				'Tipo_producto'   => 'Herramienta',
				'factura_id'      => $factura->id,
				'proveedor_id'    => $factura->proveedor->id,
				'bodega_id'       => $bodega->id,
			]);
		}

		$codigo = $codigo + 1;
		producto::create([
			'Codigo'          => $codigo,
			'Descripcion'     => 'PIE DE METRO 8 GRAD.1/128 - 0.05 MM. MOD:530-114',
			'Precio_producto' => '58695',
			'Estado'          => 'Disponible',
			'Tipo_producto'   => 'Herramienta',
			'factura_id'      => $factura->id,
			'proveedor_id'    => $factura->proveedor->id,
			'bodega_id'       => $bodega->id,
		]);
	}
}
