<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmRegistroController;
use App\Http\Controllers\AdmSessionController;
use App\Http\Controllers\AdmSucursalController;
use App\Http\Controllers\AdmRubroController;

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
    return view('contenido/contenido');
})->middleware('auth');

Route::get('/login',[AdmSessionController::class,'create'])
    ->middleware('guest')
    ->name('login.index');
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

});
    



