<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    if(Auth::guest()){
        return view('auth.login');
    }else{
        return view('home');
    }
});


//Rutas de actividad por departamento
Route::get('admin/departamentos/actividades/{id}', ['as' => 'actividadesdepto.index','uses' => 'DepartamentosController@actividades'])->where('id','[0-9]+');
Route::get('admin/departamentos/actividades/crear/{id}',['as' =>'actividadesdepto.crear', 'uses' => 'DepartamentosController@crearActividad'])->where('id','[0-9]+');
Route::get('admin/departamentos/actividades/edit/{act}/{depto}', ['as' => 'actividadesdepto.edit','uses' => 'DepartamentosController@editarActividad']);
Route::get('admin/departamentos/actividades/delete/{act}/{depto}', ['as' => 'actividadesdepto.eliminar','uses' => 'DepartamentosController@eliminarActividad']);
Route::post('admin/departamentos/actividades/edit/{act}/{depto}', ['as' => 'actividadesdepto.actualizar','uses' => 'DepartamentosController@actualizarActividad']);
Route::post('admin/departamentos/actividades/{depto}/crear-actividad', ['as' => 'actividadesdepto.store','uses' => 'DepartamentosController@guardarActividad']);

//Rutas correspondientes a departamento
Route::resource('admin/departamentos', 'DepartamentosController');
Route::get('/admin/departamento/{depto}', 'DepartamentosController@show')->where('depto','[0-9]+');
Route::get('admin/departamentos/edit/{id}', 'DepartamentosController@edit');
Route::get('admin/departamentos/delete/{id}', 'DepartamentosController@destroy');
Route::post('admin/departamentos/edit/{id}', 'DepartamentosController@update');
Route::post('admin/departamentos/crear-departamento', 'DepartamentosController@store');

//Rutas de Usuario
Route::resource('admin/usuarios', 'UsuariosController');
Route::get('admin/usuarios/edit/{id}', 'UsuariosController@edit');
Route::get('admin/usuarios/delete/{id}', 'UsuariosController@destroy');
Route::post('admin/usuarios/edit/{id}', 'UsuariosController@update');
Route::post('admin/usuarios/crear-usuario', 'UsuariosController@store');

//Rutas de Trabajadores
Route::resource('admin/trabajadores', 'TrabajadoresController');
Route::get('admin/trabajadores/edit/{id}', 'TrabajadoresController@edit');
Route::get('admin/trabajadores/delete/{id}', 'TrabajadoresController@destroy');
Route::post('admin/trabajadores/edit/{id}', 'TrabajadoresController@update');
Route::post('admin/trabajadores/create', 'TrabajadoresController@store');

//Rutas de Tipos de Usuarios
Route::resource('admin/tipo_usuario','TipoUsuarioController');
Route::get('admin/tipo_usuario/edit/{id}','TipoUsuarioController@edit');
Route::get('admin/tipo_usuario/delete/{id}','TipoUsuarioController@destroy');
Route::post('admin/tipo_usuario/edit/{id}','TipoUsuarioController@update');
Route::post('admin/tipo_usuario/create-T-U','TipoUsuarioController@store');

//Rutas de Cargos
Route::resource('admin/cargos','CargosController');
Route::get('admin/cargos/edit/{id}','CargosController@edit');
Route::get('admin/cargos/delete/{id}','CargosController@destroy');
Route::post('admin/cargos/edit/{id}','CargosController@update');
Route::post('admin/cargos/create-cargo','CargosController@store');

//Rutas de Proovedores
Route::resource('admin/proveedores', 'ProveedoresController');
Route::get('admin/proveedores/edit/{id}', 'ProveedoresController@edit');
Route::get('admin/proveedores/delete/{id}', 'ProveedoresController@destroy');
Route::post('admin/proveedores/edit/{id}', 'ProveedoresController@update');
Route::post('admin/proveedores/crear-proveedor', 'ProveedoresController@store');

//Rutas de Bodega
Route::resource('admin/abastecimiento/bodega', 'BodegaController');
Route::get('admin/abastecimiento/bodega/edit/{id}', 'BodegaController@edit');
Route::get('admin/abastecimiento/bodega/delete/{id}', 'BodegaController@destroy');
Route::post('admin/abastecimiento/bodega/mover/{id}', ['as' =>'bodega.mover', 'uses' => 'BodegaController@mover']);
Route::post('admin/abastecimiento/bodega/edit/{id}', 'BodegaController@update');
Route::post('admin/abastecimiento/bodega/crear-factura', 'BodegaController@store');

//Rutas para Factura
Route::resource('admin/abastecimiento/facturas', 'FacturaController');
Route::get('admin/abastecimiento/facturas/ver/{oc}/{proveedor}',['as' =>'factura.oc', 'uses' => 'FacturaController@factura_oc']);
Route::get('admin/abastecimiento/facturas/edit/{id}', 'FacturaController@edit');
Route::get('admin/abastecimiento/facturas/delete/{id}', 'FacturaController@destroy');
Route::post('admin/abastecimiento/facturas/edit/{id}', 'FacturaController@update');
Route::post('admin/abastecimiento/facturas/crear-factura', 'FacturaController@store');

//Rutas de Orden de Compra
Route::resource('admin/abastecimiento/orden_de_compra', 'OrdenDeCompraController');
Route::get('admin/abastecimiento/orden_de_compra/edit/{id}', 'OrdenDeCompraController@edit');
Route::get('admin/abastecimiento/orden_de_compra/delete/{id}', 'OrdenDeCompraController@destroy');
Route::post('admin/abastecimiento/orden_de_compra/edit/{id}', 'OrdenDeCompraController@update');
Route::post('admin/abastecimiento/orden_de_compra/crear_OC', 'OrdenDeCompraController@store');

//Rutas de Almacenamientos
Route::resource('admin/almacenamiento', 'AlmacenamientosController');
Route::get('admin/almacenamiento/edit/{id}', 'AlmacenamientosController@edit');
Route::get('admin/almacenamiento/delete/{id}', 'AlmacenamientosController@destroy');
Route::post('admin/almacenamiento/edit/{id}', 'AlmacenamientosController@update');
Route::post('admin/almacenamiento/crear-almacenamiento', 'AlmacenamientosController@store');

//Rutas de Guías de Despacho
Route::resource('admin/abastecimiento/guia_despacho','GuiaDespachoController');
Route::get('admin/abastecimiento/guia_despacho/edit/{id}','GuiaDespachoController@edit');
Route::get('admin/abastecimiento/guia_despacho/delete/{id}','GuiaDespachoController@destroy');
Route::post('admin/abastecimiento/guia_despacho/edit/{id}','GuiaDespachoController@update');
Route::post('admin/abastecimiento/guia_despacho/crear_guia','GuiaDespachoController@store');
Route::get('admin/abastecimiento/guia_despacho/devolver_producto/{id}/{almacen}',['as' =>'despacho.bodega_central', 'uses' => 'GuiaDespachoController@devolver']);
Route::post('admin/abastecimiento/guia_despacho/movimiento_almacenes/{id}',['as' =>'despacho.almacenes', 'uses' => 'GuiaDespachoController@movimientoProducto']);
Route::post('admin/abastecimiento/guia_despacho/movimiento_almacenes/store/{origen}/{destino}',['as' =>'despacho.movimiento', 'uses' => 'GuiaDespachoController@updateMovimiento']);

//Rutas de Solicitudes
Route::resource('solicitudes','SolicitudController');
Route::get('solicitudes/edit/{id}','SolicitudController@edit');
Route::get('solicitudes/delete/{id}','SolicitudController@destroy');
Route::get('solicitudes/solicitud_bodega/{id}',['as' =>'solicitudes.bodega', 'uses' => 'SolicitudController@crearSolicitudBodega']);
Route::get('solicitudes/solicitud_almacen/{id}',['as' =>'solicitudes.almacen', 'uses' => 'SolicitudController@crearSolicitudMovimiento']);
Route::post('solicitudes/show/{id}','SolicitudController@update');
Route::post('solicitudes/create','SolicitudController@store');
Route::post('solicitudes/solicitud_bodega',['as' =>'solicitudes.guardar_sol_bodega', 'uses' => 'SolicitudController@storeSolicitudBodega']);

//Rutas de las Preguntas
Route::resource('admin/preguntas','PreguntasController');
Route::get('admin/preguntas/edit/{id}','PreguntasController@edit');
Route::get('admin/preguntas/delete/{id}','PreguntasController@destroy');
Route::post('admin/preguntas/edit/{id}','PreguntasController@update');
Route::post('admin/preguntas/create-pregunta','PreguntasController@store');

//Rutas de Proyectos
Route::resource('proyectos', 'ProyectosController');
Route::get('proyectos/edit/{id}', 'ProyectosController@edit');
Route::get('proyectos/delete/{id}', 'ProyectosController@destroy');
Route::get('proyectos/{proyecto}/usuarios-index',['as' =>'proyectos.usuarios', 'uses' => 'ProyectosController@usuarios']);
Route::get('proyectos/{proyecto}/usuarios/asignacion',['as' =>'proyectos.asignacion', 'uses' => 'ProyectosController@createUsuariosProyecto']);
Route::get('proyectos/{proyecto}/usuarios/delete/{id}',['as' =>'proyectos.destroyUsuarios', 'uses' => 'ProyectosController@destroyUsuarios']);
Route::post('proyectos/edit/{id}', 'ProyectosController@update');
Route::post('proyectos/crear-proyecto', 'ProyectosController@store');
Route::post('proyectos/{proyecto}/usuarios/asignar-usuario',['as' =>'proyectos.storeUsuarios', 'uses' => 'ProyectosController@storeUsuarios']);

//Rutas de Area de proyecto
Route::resource('proyectos/{proyecto}/area', 'AreaProyectosController');
Route::get('proyectos/{proyecto}/area/edit/{id}', 'AreaProyectosController@edit');
Route::get('proyectos/{proyecto}/area/delete/{id}', 'AreaProyectosController@destroy');
Route::post('proyectos/{proyecto}/area/edit/{id}', 'AreaProyectosController@update');
Route::post('proyectos/{proyecto}/area/crear-area', 'AreaProyectosController@store');

//Rutas de Actividad de un Area de proyecto
Route::resource('proyectos/{proyecto}/{area}/actividades', 'ActividadesProyectosController');
Route::get('proyectos/{proyecto}/{area}/actividades/edit/{id}', 'ActividadesProyectosController@edit');
Route::get('proyectos/{proyecto}/{area}/actividades/delete/{id}', 'ActividadesProyectosController@destroy');
Route::post('proyectos/{proyecto}/{area}/actividades/edit/{id}', 'ActividadesProyectosController@update');
Route::post('proyectos/{proyecto}/{area}/actividades/crear-actividad', 'ActividadesProyectosController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
