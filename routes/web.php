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



	Route::prefix('admin')->group(function(){
		
		//Rutas de Usuario
		Route::resource('usuarios', 'UsuariosController');

		//Rutas de Trabajadores
		Route::resource('trabajadores', 'TrabajadoresController');
		
		//Rutas de Tipos de Usuarios
		Route::resource('tipo_usuario','TipoUsuarioController');

		//Rutas de Cargos
		Route::resource('cargos','CargosController');

		//Rutas de Proovedores
		Route::resource('proveedores', 'ProveedoresController');

		//Rutas de las Preguntas
		Route::resource('preguntas','PreguntasController');

		//Rutas de Bodegas
		Route::resource('bodega', 'BodegaController');

		//Rutas correspondientes a departamento
		Route::resource('departamentos', 'DepartamentosController');

		//Rutas de actividad por departamento
		Route::prefix('departamentos')->name('departamento.')->group(function(){

			Route::resource('actividad', 'ActividadDeptoController', [
				'except' => ['show'],
			]);

			Route::prefix('actividades')->name('actividades.')->group(function(){
				Route::get('edit/{id}', 'DepartamentosController@editActividades')->name('edit');
				Route::post('update/{id}', 'DepartamentosController@updateActividades')->name('update');
			});

			Route::prefix('personal')->name('personal.')->group(function(){
				Route::get('edit/{id}', 'DepartamentosController@editPersonal')->name('edit');
				Route::post('update/{id}', 'DepartamentosController@updatePersonal')->name('update');
			});
		});
	});

	Route::prefix('abastecimiento')->group(function(){

		//Rutas de Productos
		Route::resource('producto', 'ProductoController');
		Route::post('producto/mover/{id}', ['as' =>'producto.mover', 'uses' => 'productoController@mover']);
		
		//Rutas de Orden de Compra
		Route::resource('orden_de_compra', 'OrdenDeCompraController');

		//Rutas de factura
		Route::resource('factura', 'FacturaController');
		Route::get('factura/validar/{factura}/show', 'FacturaController@validar')->name('factura.validar');
		Route::put('factura/validar/{factura}', 'FacturaController@updateValidar')->name('factura.validar.update');

		//Rutas de Guías de Despacho
		Route::prefix('guia_despacho')->name('despacho.')->group(function(){
		Route::resource('/','GuiaDespachoController');
			Route::get('listaBodegas', 'GuiaDespachoController@bodegas')->name('listaBodegas');
			Route::get('devolver_producto/{id}/{almacen}',['as' =>'producto_central', 'uses' => 'GuiaDespachoController@devolver']);
			Route::post('movimiento_almacenes/{id}',['as' =>'bodegas', 'uses' => 'GuiaDespachoController@movimientoProducto']);
			Route::post('movimiento_almacenes/store/{origen}/{destino}',['as' =>'movimiento', 'uses' => 'GuiaDespachoController@updateMovimiento']);
		});
	});

	//Rutas de Solicitudes
	Route::resource('solicitudes','SolicitudController');
	Route::get('solicitudes/edit/{id}','SolicitudController@edit');
	Route::get('solicitudes/delete/{id}','SolicitudController@destroy');
	Route::get('solicitudes/solicitud_producto/{id}',['as' =>'solicitudes.producto', 'uses' => 'SolicitudController@crearSolicitudProducto']);
	Route::get('solicitudes/solicitud_almacen/{id}',['as' =>'solicitudes.bodega', 'uses' => 'SolicitudController@crearSolicitudMovimiento']);
	Route::post('solicitudes/show/{id}','SolicitudController@update');
	Route::post('solicitudes/create','SolicitudController@store');
	Route::post('solicitudes/solicitud_producto',['as' =>'solicitudes.guardar_sol_producto', 'uses' => 'SolicitudController@storeSolicitudproducto']);


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

	//Ruta para funciones ajax
	Route::prefix('ajax')->namespace('ajax')->name('ajax.')->group(function(){
		Route::get('departamento/actividad/{id}', 'ActividadDeptoController@actividad')->name('departamento.actividad');
		Route::get('departamento/personal/nombre/{id}','PersonalDeptoAjaxController@nombre')
					->name('departamento.personal.nombre');
		Route::get('departamento/personal/rut/{id}','PersonalDeptoAjaxController@rut')
					->name('departamento.personal.rut');

		Route::get('factura/proveedor/{id}', 'FacturaAjaxController@getProveedor')
					->name('factura.proveedor');
		Route::get('factura/orden/{id}', 'FacturaAjaxController@getOrden')->name('factura.orden');

		Route::get('trabajador/usuario/{rut}', 'TrabajadorAjaxController@getUsuario')
					->name('trabajador.usuario');
	});

//Rutas de Solicitudes
Route::resource('solicitudes','SolicitudController');
Route::get('solicitudes/edit/{id}','SolicitudController@edit');
Route::get('solicitudes/delete/{id}','SolicitudController@destroy');
Route::get('solicitudes/solicitud_producto/{id}',['as' =>'solicitudes.producto', 'uses' => 'SolicitudController@crearSolicitudProducto']);
Route::get('solicitudes/solicitud_almacen/{id}',['as' =>'solicitudes.bodega', 'uses' => 'SolicitudController@crearSolicitudMovimiento']);
Route::post('solicitudes/show/{id}','SolicitudController@update');
Route::post('solicitudes/create','SolicitudController@store');
Route::post('solicitudes/solicitud_producto',['as' =>'solicitudes.guardar_sol_producto', 'uses' => 'SolicitudController@storeSolicitudproducto']);


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

//Ruta para funciones ajax
Route::prefix('ajax')->namespace('ajax')->name('ajax.')->group(function(){
	Route::get('departamento/actividad/{id}', 'ActividadDeptoController@actividad')->name('departamento.actividad');
	Route::get('departamento/personal/nombre/{id}','PersonalDeptoAjaxController@nombre')
				->name('departamento.personal.nombre');
	Route::get('departamento/personal/rut/{id}','PersonalDeptoAjaxController@rut')
				->name('departamento.personal.rut');

	Route::get('factura/proveedor/{id}', 'FacturaAjaxController@getProveedor')->name('factura.proveedor');
});
Auth::routes();

