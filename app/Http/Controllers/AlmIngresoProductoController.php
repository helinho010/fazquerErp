<?php

namespace App\Http\Controllers;

use App\Models\Alm_IngresoProducto;
use Illuminate\Http\Request;

class AlmIngresoProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $nuevoProducto = new Alm_IngresoProducto();
        $nuevoProducto->id_prod_producto=$request->id_prod_producto;
        $nuevoProducto->idalmacen=1;
        $nuevoProducto->cantidad=10;
        $nuevoProducto->tipo_entrada="Compra";
        $nuevoProducto->fecha_vencimiento=date("Y-m-d");
        $nuevoProducto->lote='151515';
        $nuevoProducto->registro_sanitario='1236123';
        $nuevoProducto->codigo_internacional='3216582312';
        $nuevoProducto->id_usuario_registra=auth()->user()->id;
        $nuevoProducto->save();
        return $request;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Alm_IngresoProducto $alm_IngresoProducto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alm_IngresoProducto $alm_IngresoProducto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alm_IngresoProducto $alm_IngresoProducto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alm_IngresoProducto $alm_IngresoProducto)
    {
        //
    }
}
