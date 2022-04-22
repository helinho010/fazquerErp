<?php

namespace App\Http\Controllers;

use App\Models\Ser_Venta_Maestro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SerVentaMaestroController extends Controller
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ventamaestro = new Ser_Venta_Maestro();

        $ventamaestro->num_documento=1;
        $ventamaestro->tipodocumento=1;
        $ventamaestro->idcliente=$request->idcliente;
        $ventamaestro->total=$request->total;
        $ventamaestro->efectivo=$request->efectivo;
        $ventamaestro->cambio=$request->cambio;
        $ventamaestro->id_usuario_registra=auth()->user()->id;
        $ventamaestro->idsucursal=session('idsuc');
        $ventamaestro->save();
        $id=$ventamaestro->id;
        
        DB::table('ser__ventas')
            ->where('estado', 0)
            ->where('idsucursal',session('idsuc'))
            ->where('id_usuario_registra',auth()->user()->id)
            ->update(['estado' => 1,
                        'idventamaestro'=>$id]);
        return 'correcto';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ser_Venta_Maestro  $ser_Venta_Maestro
     * @return \Illuminate\Http\Response
     */
    public function show(Ser_Venta_Maestro $ser_Venta_Maestro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ser_Venta_Maestro  $ser_Venta_Maestro
     * @return \Illuminate\Http\Response
     */
    public function edit(Ser_Venta_Maestro $ser_Venta_Maestro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ser_Venta_Maestro  $ser_Venta_Maestro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ser_Venta_Maestro $ser_Venta_Maestro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ser_Venta_Maestro  $ser_Venta_Maestro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ser_Venta_Maestro $ser_Venta_Maestro)
    {
        //
    }
}
