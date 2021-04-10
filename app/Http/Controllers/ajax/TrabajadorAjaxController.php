<?php

namespace App\Http\Controllers\ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\usuario;

class TrabajadorAjaxController extends Controller
{
    public function getUsuario($rut)
	{
		$usuario = usuario::where('Rut',$rut)->first();
		if($usuario){
			$datos = [
				'id'           => $usuario->id,
				'rut'          => $usuario->Rut,
				'nombre'       => $usuario->getNombreCompleto(),
				'correo'       => $usuario->email,
				'ciudad'       => $usuario->ciudad->Nombre,
				'tipo_usuario' => $usuario->tipo_usuario->Tipo_usuario,
				'cargo'        => $usuario->cargo? $usuario->cargo->Tipo_cargo : 'Sin asignar',
			];
			return response()->json($datos);			
		}
		return null;
	}
}
