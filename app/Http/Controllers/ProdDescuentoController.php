<?php

namespace App\Http\Controllers;

use App\Models\Prod_Descuento;
use Illuminate\Http\Request;

class ProdDescuentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nuevoDescuentoProducto=new Prod_Descuento();
        $nuevoDescuentoProducto->nombre=$request->nombre;
        $nuevoDescuentoProducto->monto_descuento=$request->monto_descuento;
        $nuevoDescuentoProducto->idtipodescuento=$request->idtipodescuento;
        $nuevoDescuentoProducto->regla=$request->regla;
        $nuevoDescuentoProducto->aplica_a=$request->aplica_a;
        $nuevoDescuentoProducto->activo=$request->activo;
        $nuevoDescuentoProducto->estado=$request->estado;
        $nuevoDescuentoProducto->id_usuario_registra=1;
        $nuevoDescuentoProducto->save();
        //return Prod_Descuento::create(request()->input());
        //return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prod_Descuento  $prod_Descuento
     * @return \Illuminate\Http\Response
     */
    public function show(Prod_Descuento $prod_Descuento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prod_Descuento  $prod_Descuento
     * @return \Illuminate\Http\Response
     */
    public function edit(Prod_Descuento $prod_Descuento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prod_Descuento  $prod_Descuento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prod_Descuento $prod_Descuento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prod_Descuento  $prod_Descuento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prod_Descuento $prod_Descuento)
    {
        //
    }
}
