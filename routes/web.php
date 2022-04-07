<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmRegistroController;
use App\Http\Controllers\AdmSessionController;
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
    ->middleware('guest')
    ->name('registro.index');
Route::post('/registro',[AdmRegistroController::class,'store'])
    ->middleware('guest')
    ->name('registro.store');



/* Route::get('/', function () {
    return view('contenido/contenido');
}); */


    Route::get('/sucursal',[AdmSucursalController::class,'index'])->middleware('auth');
    Route::post('/sucursal/registrar', [AdmSucursalController::class,'store'])->middleware('auth');
    Route::put('/sucursal/actualizar', [AdmSucursalController::class,'update'])->middleware('auth');
    Route::put('/sucursal/desactivar', [AdmSucursalController::class,'desactivar'])->middleware('auth');
    Route::put('/sucursal/activar', [AdmSucursalController::class,'activar'])->middleware('auth');
    Route::get('/sucursal/selectsucursal',[AdmSucursalController::class,'selectSucursal'])->middleware('auth');



