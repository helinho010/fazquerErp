<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GesPre_Venta;
use App\Models\Prod_Producto;

class GesPreVentaController extends Controller
{
    //
    
    
    public function update_store(Request $request)
    {
        $precioVentaProducto = GesPre_Venta :: firstWhere('idalmingresoproducto',$request->idalmingresoproducto);

        if ($precioVentaProducto) {

        }else {
            $precioVentaProducto = new GesPre_Venta();
        }
        
        $actualizarProductoPrecioVenta = Prod_Producto::firstWhere('id',$request->idProdProducto);
        $envase='precioventa'.$request->envaseregistrado;
        $actualizarProductoPrecioVenta->$envase = $request->precio_venta_prodproductos;
        $actualizarProductoPrecioVenta->save();

        $precioVentaProducto->idalmingresoproducto = $request->idalmingresoproducto;
        $precioVentaProducto->precio_compra_gespreventa = $request->precio_compra_gespreventa;
        $precioVentaProducto->margen_30p_gespreventa = $request->margen_30p_gespreventa;
        $precioVentaProducto->margen_40p_gespreventa = $request->margen_40p_gespreventa;
        $precioVentaProducto->utilidad_neto_gespreventa = $request->utilidad_neto_gespreventa;
        $precioVentaProducto->idusuario = auth()->user()->id;
        $precioVentaProducto->save();
        
        return $request;
    }

    public function verificarProductoPrecio(Request $request)
    {
        $registroGestionPrecioVenta = GesPre_Venta::where('idalmingresoproducto',$request->id_alm__ingreso_producto)
                                                    ->get();
        return $registroGestionPrecioVenta;
    }
}
