<?php

namespace App\Http\Controllers\ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\actividad;

class ActividadDeptoController extends Controller
{
    
	public function actividad($id)
	{
		$actividad = actividad::where('Nombre_actividad', $id)->first();
		if($actividad){
			$datos = [
				'id'          => $actividad->id,
				'nombre'      => $actividad->Nombre_actividad,
				'Descripcion' => $actividad->Descripcion,
				'KPI'         => $actividad->KPI,
			];
			return response()->json($datos);
		}
		return null;
	}
}
