<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tda_IngresoProducto;
use Illuminate\Support\Facades\DB;

class TdaIngresoProductoController extends Controller
{
    private $columnasIngresoProductos = '
    tda__ingreso_productos.id,
	tda__ingreso_productos.idtienda, 
	tda__ingreso_productos.id_prod_producto,
	tda__ingreso_productos.envase as envaseregistrado,
	tda__ingreso_productos.id_tipoentrada,
	tda__ingreso_productos.cantidad,
	tda__ingreso_productos.stock_ingreso,
	tda__ingreso_productos.fecha_vencimiento,
	tda__ingreso_productos.lote,
	tda__ingreso_productos.registro_sanitario,
	tda__ingreso_productos.activo as activo_tda_ingreso_producto,
	tda__ingreso_productos.id_usuario_registra,
	prod__productos.id as id_producto,
	prod__productos.codigo as codigo_producto,
	prod__productos.idlinea,
	prod__productos.nombre as nombre_producto,
	prod__productos.idrubro as id_rubro_producto,
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
	tda__tiendas.id as id_tienda,
	tda__tiendas.codigo as codigo_tienda,
	tda__tiendas.activo as activo_tienda';


    public function index(Request $request)
    {
        $productosTienda = DB::table('tda__ingreso_productos')
                              ->leftJoin('tda__tiendas','tda__tiendas.id','=','tda__ingreso_productos.id_prod_producto')
                              ->leftJoin('prod__productos','prod__productos.id','=','prod__productos.id')
                              //->leftJoin('ges_pre__ventas','ges_pre__ventas.idalmingresoproducto','=','alm__ingreso_producto.id')
                              ->select(DB::raw($this->columnasIngresoProductos))    
                              ->where('tda__ingreso_productos.idtienda','=',$request->idtienda)
                              ->paginate(10);
            return 
            [
                    'pagination'=>
                        [
                            'total'         =>    $productosTienda->total(),
                            'current_page'  =>    $productosTienda->currentPage(),
                            'per_page'      =>    $productosTienda->perPage(),
                            'last_page'     =>    $productosTienda->lastPage(),
                            'from'          =>    $productosTienda->firstItem(),
                            'to'            =>    $productosTienda->lastItem(),
                        ] ,
                    'productosTienda'=>$productosTienda,
            ];
    }


    public function store(Request $request)
    {
        $nuevoProducto = new Tda_IngresoProducto();
        $nuevoProducto->id_prod_producto = $request->id_prod_producto;
        $nuevoProducto->envase = $request->envase;
        $nuevoProducto->idtienda = $request->idtienda;
        $nuevoProducto->cantidad = $request->cantidad;
        $nuevoProducto->stock_ingreso = $request->cantidad;
        $nuevoProducto->id_tipoentrada = $request->id_tipo_entrada;
        $nuevoProducto->fecha_vencimiento = $request->fecha_vencimiento;
        $nuevoProducto->lote = $request->lote;
        $nuevoProducto->registro_sanitario = $request->registro_sanitario;
        $nuevoProducto->id_usuario_registra=auth()->user()->id;
        $nuevoProducto->save();
    }

}
