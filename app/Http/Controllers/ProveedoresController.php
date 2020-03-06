<?php

namespace App\Http\Controllers;

use App\Repositories\ProveedorRepository;
use App\proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class  ProveedoresController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedor = proveedor::orderBy('id','ASC')->paginate();
        return view('Proveedores.index_proveedores', compact('proveedor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Proveedores.create_proveedores');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $p = proveedor::find($id);
        return view('Proveedores.create_proveedores',compact('p'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('DELETE FROM proveedors WHERE id = ?',[$id]);
        return redirect()->route('proveedores.index');
    }
}
