<?php

namespace App\Http\Controllers\ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\proveedor;
use App\orden_de_compra;

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

	public function getOrden($id)
	{
		$orden = orden_de_compra::findOrFail($id);
		if($orden){
			$datos = [
				'id'        => $orden->id,
				'idP'       => $orden->proveedor->id,
				'rut'       => $orden->proveedor->Rut_proveedor,
				'nombre'    => $orden->proveedor->Nombre_proveedor,
				'correo'    => $orden->proveedor->Correo,
				'direccion' => $orden->proveedor->Direccion,
				'rubro'     => $orden->proveedor->Rubro,
				'telefono'  => $orden->proveedor->Telefono,
			];
			return response()->json($datos);
		}
		return null;
	}
}
