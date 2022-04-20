<?php

use App\Http\Controllers\AdmAccionVentanaController;
use App\Http\Controllers\AdmModuloController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmRegistroController;
use App\Http\Controllers\AdmRoleController;
use App\Http\Controllers\AdmSessionController;
use App\Http\Controllers\AdmSucursalController;
use App\Http\Controllers\AdmRubroController;
use App\Http\Controllers\AdmUserController;
use App\Http\Controllers\AdmUserRoleSucursalController;
use App\Http\Controllers\AdmVentanaModuloController;
use App\Http\Controllers\RrhCargoController;
use App\Http\Controllers\RrhEmpleadoController;
use App\Http\Controllers\RrhFormacionController;
use App\Http\Controllers\RrhProfesionController;
use App\Http\Controllers\RrhUnidadOrganizacionalController;


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
    if(!is_null(session('idsucursal')))
        return redirect()->to('/selectsuc');    
    else
        return view('contenido/contenido');    
    
})->middleware('auth');

Route::get('/login',[AdmSessionController::class,'create'])
    ->middleware('guest')
    ->name('login.index');

Route::get('/selectsuc',[AdmSessionController::class,'sucursal'])
    ->middleware('auth')
    ->name('login.sucursal');

Route::post('/selectsuc',[AdmSessionController::class,'entrar'])
    ->middleware('auth')
    ->name('login.entrar');


Route::post('/login',[AdmSessionController::class,'store'])
    ->middleware('guest')
    ->name('login.store');
Route::get('/logout',[AdmSessionController::class,'destroy'])
->middleware('auth')
    ->name('login.destroy');

Route::get('/registro',[AdmRegistroController::class,'create'])
    ->middleware('auth')
    ->name('registro.index');
Route::post('/registro',[AdmRegistroController::class,'store'])
    ->middleware('auth')
    ->name('registro.store');



/* Route::get('/', function () {
    return view('contenido/contenido');
}); */

Route::group(['middleware'=>'auth'],function(){

    //adm///////////////////////////////////////////////////////////////////////////////////
    
    Route::get('/rubro',[AdmRubroController::class,'index']);
    Route::post('/rubro/registrar', [AdmRubroController::class,'store']);
    Route::put('/rubro/actualizar', [AdmRubroController::class,'update']);
    Route::put('/rubro/desactivar', [AdmRubroController::class,'desactivar']);
    Route::put('/rubro/activar', [AdmRubroController::class,'activar']);
    Route::get('/rubro/selectrubro',[AdmRubroController::class,'selectRubro']);

    Route::get('/sucursal',[AdmSucursalController::class,'index']);
    Route::post('/sucursal/registrar', [AdmSucursalController::class,'store']);
    Route::put('/sucursal/actualizar', [AdmSucursalController::class,'update']);
    Route::put('/sucursal/desactivar', [AdmSucursalController::class,'desactivar']);
    Route::put('/sucursal/activar', [AdmSucursalController::class,'activar']);
    Route::get('/sucursal/selectsucursal',[AdmSucursalController::class,'selectSucursal']);

    Route::get('/modulo',[AdmModuloController::class,'index']);
    Route::post('/modulo/registrar', [AdmModuloController::class,'store']);
    Route::put('/modulo/actualizar', [AdmModuloController::class,'update']);
    Route::put('/modulo/desactivar', [AdmModuloController::class,'desactivar']);
    Route::put('/modulo/activar', [AdmModuloController::class,'activar']);
    Route::get('/modulo/selectmodulo',[AdmModuloController::class,'selectModulo']);

    Route::get('/ventana',[AdmVentanaModuloController::class,'index']);
    Route::post('/ventana/registrar', [AdmVentanaModuloController::class,'store']);
    Route::put('/ventana/actualizar', [AdmVentanaModuloController::class,'update']);
    Route::put('/ventana/desactivar', [AdmVentanaModuloController::class,'desactivar']);
    Route::put('/ventana/activar', [AdmVentanaModuloController::class,'activar']);
    Route::get('/ventana/selectventana',[AdmVentanaModuloController::class,'selectVentana']);

    Route::get('/accion',[AdmAccionVentanaController::class,'index']);
    Route::post('/accion/registrar', [AdmAccionVentanaController::class,'store']);
    Route::put('/accion/actualizar', [AdmAccionVentanaController::class,'update']);
    Route::put('/accion/desactivar', [AdmAccionVentanaController::class,'desactivar']);
    Route::put('/accion/activar', [AdmAccionVentanaController::class,'activar']);
    Route::get('/accion/selectaccion',[AdmAccionVentanaController::class,'selectAccion']);


    Route::get('/usuario',[AdmUserController::class,'index']);
    Route::post('/usuario/registrar', [AdmUserController::class,'store']);
    Route::put('/usuario/actualizar', [AdmUserController::class,'update']);
    Route::put('/usuario/desactivar', [AdmUserController::class,'desactivar']);
    Route::put('/usuario/activar', [AdmUserController::class,'activar']);
    Route::get('/usuario/selectusuario',[AdmUserController::class,'selectUsuario']);

    Route::get('/role',[AdmRoleController::class,'index']);
    Route::post('/role/registrar', [AdmRoleController::class,'store']);
    Route::put('/role/actualizar', [AdmRoleController::class,'update']);
    Route::put('/role/desactivar', [AdmRoleController::class,'desactivar']);
    Route::put('/role/activar', [AdmRoleController::class,'activar']);
    Route::get('/role/selectrole',[AdmRoleController::class,'selectRole']);

    Route::get('/userrolesuc',[AdmUserRoleSucursalController::class,'index']);
    Route::post('/userrolesuc/registrar', [AdmUserRoleSucursalController::class,'store']);
    Route::put('/userrolesuc/desactivar', [AdmUserRoleSucursalController::class,'desactivar']);
    Route::put('/userrolesuc/activar', [AdmUserRoleSucursalController::class,'activar']);


    //rrhh ////////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('/empleado',[RrhEmpleadoController::class,'index']);
    Route::post('/empleado/registrar', [RrhEmpleadoController::class,'store']);
    Route::put('/empleado/actualizar', [RrhEmpleadoController::class,'update']);
    Route::put('/empleado/desactivar', [RrhEmpleadoController::class,'desactivar']);
    Route::put('/empleado/activar', [RrhEmpleadoController::class,'activar']);
    Route::get('/empleado/selectempleado',[RrhEmpleadoController::class,'selectEmpleado']);
    Route::get('/empleado/selectnouser',[RrhEmpleadoController::class,'selectNoUser']);

    Route::get('/formacion',[RrhFormacionController::class,'index']);
    Route::post('/formacion/registrar', [RrhFormacionController::class,'store']);
    Route::put('/formacion/actualizar', [RrhFormacionController::class,'update']);
    Route::put('/formacion/desactivar', [RrhFormacionController::class,'desactivar']);
    Route::put('/formacion/activar', [RrhFormacionController::class,'activar']);
    Route::get('/formacion/selectformacion',[RrhFormacionController::class,'selectFormacion']);

    Route::get('/profesion',[RrhProfesionController::class,'index']);
    Route::post('/profesion/registrar', [RrhProfesionController::class,'store']);
    Route::put('/profesion/actualizar', [RrhProfesionController::class,'update']);
    Route::put('/profesion/desactivar', [RrhProfesionController::class,'desactivar']);
    Route::put('/profesion/activar', [RrhProfesionController::class,'activar']);
    Route::get('/profesion/selectprofesion',[RrhProfesionController::class,'selectProfesion']);

    Route::get('/cargo',[RrhCargoController::class,'index']);
    Route::post('/cargo/registrar', [RrhCargoController::class,'store']);
    Route::put('/cargo/actualizar', [RrhCargoController::class,'update']);
    Route::put('/cargo/desactivar', [RrhCargoController::class,'desactivar']);
    Route::put('/cargo/activar', [RrhCargoController::class,'activar']);
    Route::get('/cargo/selectcargo',[RrhCargoController::class,'selectCargo']);

    Route::get('/unidadorg',[RrhUnidadOrganizacionalController::class,'index']);
    Route::post('/unidadorg/registrar', [RrhUnidadOrganizacionalController::class,'store']);
    Route::put('/unidadorg/actualizar', [RrhUnidadOrganizacionalController::class,'update']);
    Route::put('/unidadorg/desactivar', [RrhUnidadOrganizacionalController::class,'desactivar']);
    Route::put('/unidadorg/activar', [RrhUnidadOrganizacionalController::class,'activar']);
    Route::get('/unidadorg/selectuo',[RrhUnidadOrganizacionalController::class,'selectUnidadOrg']);

});
    



