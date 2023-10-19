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
        // $buscararray=array();
        // if(!empty($request->buscar))
        // {
        //     $buscararray = explode(" ",$request->buscar);
        //     if( sizeof($buscararray) > 0 )
        //     {
        //         $sqls='';
        //         foreach($buscararray as $palabra)
        //         {
        //             if(empty($sqls)){
        //                 $sqls="(alm__almacens.codigo like '%".$palabra."%' 
        //                         or alm__almacens.nombre_almacen like '%".$palabra."%' 
        //                         or alm__almacens.telefono like '%".$palabra."%' 
        //                         or alm__almacens.direccion like '%".$palabra."%' 
        //                         or alm__almacens.departamento like '%".$palabra."%')" ;
        //             }
        //             else
        //             {
        //                 $sqls.="and (alm__almacens.codigo like '%".$palabra."%'  
        //                         or alm__almacens.nombre_almacen like '%".$palabra."%' 
        //                         or alm__almacens.telefono like '%".$palabra."%' 
        //                         or alm__almacens.direccion like '%".$palabra."%' 
        //                         or alm__almacens.departamento like '%".$palabra."%')" ;
        //             }
    
        //         }

        //         $almacenes= DB::table('alm__almacens')
        //                 ->leftJoin('adm__sucursals','alm__almacens.idsucursal','=','adm__sucursals.id')
        //                 ->selectRaw('alm__almacens.id, adm__sucursals.id as idsucursal, 
        //                              adm__sucursals.cod as codsuc, adm__sucursals.razon_social,
        //                              adm__sucursals.tipo, adm__sucursals.correlativo,
        //                              alm__almacens.codigo, alm__almacens.nombre_almacen, 
        //                              alm__almacens.telefono, alm__almacens.direccion, 
        //                              alm__almacens.departamento, alm__almacens.ciudad, 
        //                              alm__almacens.activo')
        //                 ->whereraw($sqls)
        //                 ->paginate(15);
        //     }
            
        //     return 
        //     [
        //             'pagination'=>
        //                 [
        //                     'total'         =>    $almacenes->total(),
        //                     'current_page'  =>    $almacenes->currentPage(),
        //                     'per_page'      =>    $almacenes->perPage(),
        //                     'last_page'     =>    $almacenes->lastPage(),
        //                     'from'          =>    $almacenes->firstItem(),
        //                     'to'            =>    $almacenes->lastItem(),
        //                 ] ,
        //             'almacenes'=>$almacenes,
        //     ];
        // }
        // else
        // {
            $productosAlmacen = DB::table('alm__ingreso_producto')
                              ->leftJoin('alm__almacens','alm__ingreso_producto.idalmacen','=','alm__almacens.id')
                              ->leftJoin('prod__productos','alm__ingreso_producto.id_prod_producto','=','prod__productos.id')
                              ->leftJoin('ges_pre__ventas','ges_pre__ventas.idalmingresoproducto','=','alm__ingreso_producto.id')
                              ->select(DB::raw('
                                       alm__ingreso_producto.id, 
                                       alm__ingreso_producto.id_prod_producto,
                                       alm__ingreso_producto.envase as envaseregistrado, 
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
                                       prod__productos.nombre as nomproducto,
                                       prod__productos.iddispenserprimario,
                                       prod__productos.iddispensersecundario,
                                       prod__productos.iddispenserterciario,
                                       prod__productos.idformafarmaceuticaprimario,
                                       prod__productos.idformafarmaceuticasecundario,
                                       prod__productos.idformafarmaceuticaterciario,
                                       prod__productos.cantidadprimario,
                                       prod__productos.cantidadsecundario,
                                       prod__productos.cantidadterciario,
                                       prod__productos.preciolistaprimario,
                                       prod__productos.precioventaprimario,
                                       prod__productos.preciolistasecundario,
                                       prod__productos.precioventasecundario,
                                       prod__productos.preciolistaterciario,
                                       prod__productos.precioventaterciario,
                                       ges_pre__ventas.id as idgespreventas,
                                       ges_pre__ventas.precio_compra_gespreventa,
                                       ges_pre__ventas.margen_40p_gespreventa,
                                       ges_pre__ventas.utilidad_neto_gespreventa,
                                       ges_pre__ventas.idusuario as idgespreventasusuario,
                                       ges_pre__ventas.listo_venta'
                                       ))    
                              ->where('alm__ingreso_producto.idalmacen','=',$request->idalmacen)
                              ->paginate(10);
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
        // }

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
