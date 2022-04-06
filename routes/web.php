<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmSucursalController;

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

/* Route::get('/', function () {
    return view('welcome');
}); */
Route::get('/', function () {
    return view('contenido/contenido');
});


Route::get('/sucursal',[AdmSucursalController::class,'index']);
Route::post('/sucursal/registrar', [AdmSucursalController::class,'store']);
Route::put('/sucursal/actualizar', [AdmSucursalController::class,'update']);
Route::put('/sucursal/desactivar', [AdmSucursalController::class,'desactivar']);
Route::put('/sucursal/activar', [AdmSucursalController::class,'activar']);
Route::get('/sucursal/selectsucursal',[AdmSucursalController::class,'selectSucursal']);
