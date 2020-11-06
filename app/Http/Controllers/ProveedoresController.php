<?php

namespace App\Http\Controllers;

use App\Repositories\ProveedorRepository;
use App\proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class  ProveedoresController extends Controller
{

    public function index()
    {
        $proveedor = proveedor::orderBy('id','ASC')->paginate();
        return view('Proveedores.index_proveedores', compact('proveedor'));
    }

    public function create()
    {
        return view('Proveedores.create_proveedores');
    }

    public function store(Request $request)
    {
        DB::insert('INSERT INTO proveedors (Nombre_proveedor,Rut_proveedor,Nombre_vendedor,Direccion,
                                        Telefono,Rubro,Correo) 
                                VALUES (?,?,?,?,?,?,?)',[$request->get('nom_proveedor'),
                                                         $request->get('rut_proveedor'),
                                                         $request->get('vendedor'),
                                                         $request->get('direccion'),
                                                         $request->get('telefono'),
                                                         $request->get('rubro'),
                                                         $request->get('correo')]);

        return redirect()->route('proveedores.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $p = proveedor::find($id);
        return view('Proveedores.create_proveedores',compact('p'));
    }

    public function update(Request $request, $id)
    {
        DB::update('UPDATE proveedors SET Nombre_proveedor = ?, Rut_proveedor = ?, Nombre_vendedor = ?, Direccion = ?,
                                        Telefono = ?, Rubro = ?, Correo = ? 
                           WHERE  id = ?',[$request->get('nom_proveedor'),
                                           $request->get('rut_proveedor'),
                                           $request->get('vendedor'),
                                           $request->get('direccion'),
                                           $request->get('telefono'),
                                           $request->get('rubro'),
                                           $request->get('correo'),
                                           $id]);
        return redirect()->route('proveedores.index');
    }

    public function destroy($id)
    {
        DB::delete('DELETE FROM proveedors WHERE id = ?',[$id]);
        return redirect()->route('proveedores.index');
    }
}
