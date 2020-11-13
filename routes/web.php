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

Route::get('/', 'Auth\LoginController@formLogin')->name('fLogin');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('home', 'HomeController@index')->name('home.index');


//RUTAS PARA ADMINISTRACION

Route::prefix('admin')->group(function(){
	
	//Rutas de Usuario
	Route::resource('usuarios', 'UsuariosController');

	//Rutas de Trabajadores
	Route::resource('admin/trabajadores', 'TrabajadoresController');
	
	//Rutas de Tipos de Usuarios
	Route::resource('tipo_usuario','TipoUsuarioController');

	//Rutas de Cargos
	Route::resource('cargos','CargosController');

	//Rutas de Proovedores
	Route::resource('proveedores', 'ProveedoresController');

	//Rutas de Bodega
	Route::resource('abastecimiento/bodega', 'BodegaController');
	Route::post('abastecimiento/bodega/mover/{id}', ['as' =>'bodega.mover', 'uses' => 'BodegaController@mover']);
	
	//Rutas de Orden de Compra
	Route::resource('abastecimiento/orden_de_compra', 'OrdenDeCompraController');
	
	//Rutas de las Preguntas
	Route::resource('preguntas','PreguntasController');
	
	//Rutas para Factura
	Route::resource('abastecimiento/facturas', 'FacturaController');
	Route::get('abastecimiento/facturas/ver/{oc}/{proveedor}',['as' =>'factura.oc', 'uses' => 'FacturaController@factura_oc']);

	//Rutas de Almacenamientos
	Route::resource('almacenamiento', 'AlmacenamientosController');
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

