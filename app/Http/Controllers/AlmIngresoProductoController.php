<?php

namespace App\Http\Controllers;

use App\Models\Alm_IngresoProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlmIngresoProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        /**
         * select
         * alm__ingreso_producto.id, alm__ingreso_producto.id_prod_producto, alm__ingreso_producto.idalmacen, alm__ingreso_producto.cantidad, alm__ingreso_producto.tipo_entrada, alm__ingreso_producto.fecha_vencimiento, alm__ingreso_producto.lote, alm__ingreso_producto.registro_sanitario, alm__ingreso_producto.codigo_internacional,
         * alm__almacens.id as idalmacen, alm__almacens.idsucursal, alm__almacens.codigo, alm__almacens.nombre_almacen, alm__almacens.direccion,
         * prod__productos.id as idprodproducto, prod__productos.idlinea, prod__productos.codigo, prod__productos.nombre
         * from
         * 	alm__ingreso_producto
         * left join alm__almacens on alm__ingreso_producto.idalmacen  = alm__almacens.id 
         * left join prod__productos on alm__ingreso_producto.id_prod_producto = prod__productos.id  
         */

        $productosAlmacen = DB::table('alm__ingreso_producto')
                              ->leftJoin('alm__almacens','alm__ingreso_producto.idalmacen','=','alm__almacens.id')
                              ->leftJoin('prod__productos','alm__ingreso_producto.id_prod_producto','=','prod__productos.id')
                              ->select(DB::raw('
                                       alm__ingreso_producto.id, 
                                       alm__ingreso_producto.id_prod_producto, 
                                       alm__ingreso_producto.idalmacen, 
                                       alm__ingreso_producto.cantidad, 
                                       alm__ingreso_producto.tipo_entrada, 
                                       alm__ingreso_producto.fecha_vencimiento, 
                                       alm__ingreso_producto.lote, 
                                       alm__ingreso_producto.registro_sanitario, 
                                       alm__ingreso_producto.activo,
                                       alm__almacens.id as idalmacen, 
                                       alm__almacens.idsucursal, 
                                       alm__almacens.codigo as codalmacen, 
                                       alm__almacens.nombre_almacen, 
                                       alm__almacens.direccion,
                                       prod__productos.id as idprodproducto, 
                                       prod__productos.idlinea, 
                                       prod__productos.codigo as codproducto, 
                                       prod__productos.nombre as nomproducto'
                                       ))    
                              ->where('alm__ingreso_producto.idalmacen','=',$request->idalmacen)
                              ->paginate(10);

        //return $productosAlmacen;
        return 
            [
                    'pagination'=>
                        [
                            'total'         =>    $productosAlmacen->total(),
                            'current_page'  =>    $productosAlmacen->currentPage(),
                            'per_page'      =>    $productosAlmacen->perPage(),
                            'last_page'     =>    $productosAlmacen->lastPage(),
                            'from'          =>    $productosAlmacen->firstItem(),
                            'to'            =>    $productosAlmacen->lastItem(),
                        ] ,
                    'productosAlmacen'=>$productosAlmacen,
            ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return $request;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nuevoProducto = new Alm_IngresoProducto();
        $nuevoProducto->id_prod_producto = $request->id_prod_producto;
        $nuevoProducto->envase = $request->envase;
        $nuevoProducto->idalmacen = $request->idalmacen;
        $nuevoProducto->cantidad = $request->cantidad;
        $nuevoProducto->tipo_entrada = $request->tipo_entrada;
        $nuevoProducto->fecha_vencimiento = $request->fecha_vencimiento;
        $nuevoProducto->lote = $request->lote;
        $nuevoProducto->registro_sanitario = $request->registro_sanitario;
        //$nuevoProducto->codigo_internacional = $request->codigo_internacional;
        $nuevoProducto->id_usuario_registra=auth()->user()->id;
        $nuevoProducto->save();
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
        $actualizarProducto = Alm_IngresoProducto::findOrFail($request->id);
        $actualizarProducto->id_prod_producto = $request->id_prod_producto;
        $actualizarProducto->envase = $request->envase;
        $actualizarProducto->idalmacen = $request->idalmacen;
        $actualizarProducto->cantidad = $request->cantidad;
        $actualizarProducto->tipo_entrada = $request->tipo_entrada;
        $actualizarProducto->fecha_vencimiento = $request->fecha_vencimiento;
        $actualizarProducto->lote = $request->lote;
        $actualizarProducto->registro_sanitario = $request->registro_sanitario;
        //$actualizarProducto->codigo_internacional = $request->codigo_internacional;
        $actualizarProducto->id_usuario_registra=auth()->user()->id;
        $actualizarProducto->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alm_IngresoProducto $alm_IngresoProducto)
    {
        //
    }

    public function desactivar(Request $request)
    {
        $actualizarProducto = Alm_IngresoProducto::findOrFail($request->id);
        $actualizarProducto->activo = 0;
        $actualizarProducto->id_usuario_modifica=auth()->user()->id;
        $actualizarProducto->save();
    }

    public function activar(Request $request)
    {
        $actualizarProducto = Alm_IngresoProducto::findOrFail($request->id);
        $actualizarProducto->activo = 1;
        $actualizarProducto->id_usuario_modifica=auth()->user()->id;
        $actualizarProducto->save();
    }
}
