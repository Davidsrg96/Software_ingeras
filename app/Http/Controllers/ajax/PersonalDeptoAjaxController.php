<?php

namespace App\Http\Controllers\ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\usuario;

class PersonalDeptoAjaxController extends Controller
{
    public function nombre($id)
	{
		$usuarios = usuario::all();

		foreach ($usuarios as $usuario) {
			if( strtoupper($usuario->getNombreCompleto()) == strtoupper($id) ){
				$datos = [
					'id'     => $usuario->id,
					'rut'    => $usuario->Rut,
				];
				return response()->json($datos);
				break;
			}
		}
		return null;
	}
    public function rut($id)
	{
		$usuario = usuario::where('Rut', $id)->first();
		if($usuario){
			$datos = [
				'id'     => $usuario->id,
				'nombre' => $usuario->getNombreCompleto(),
			];
			return response()->json($datos);
		}
		return null;
	}
}
