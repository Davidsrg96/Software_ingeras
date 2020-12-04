<?php

namespace App\Http\Controllers\ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\proveedor;

class FacturaAjaxController extends Controller
{
	public function getProveedor($id)
	{
		$proveedor = proveedor::findOrFail($id);
		if($proveedor){
			$datos = [
				'id'        => $proveedor->id,
				'rut'       => $proveedor->Rut_proveedor,
				'nombre'    => $proveedor->Nombre_proveedor,
				'correo'    => $proveedor->Correo,
				'direccion' => $proveedor->Direccion,
				'rubro'     => $proveedor->Rubro,
				'telefono'  => $proveedor->Telefono,
			];
			return response()->json($datos);
		}
		return null;
	}
}
