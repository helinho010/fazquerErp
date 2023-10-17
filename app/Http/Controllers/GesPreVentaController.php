<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GesPre_Venta;

class GesPreVentaController extends Controller
{
    //
    
    
    public function update_store(Request $request)
    {
        $precioVentaProducto = GesPre_Venta :: where('idalmingresoproducto',$request->id_alm__ingreso_producto)
                                            ->first();
        // if ($precioVentaProducto ) {
        //     # code...
        // }
        // $precioVentaProducto->idalmingresoproducto = $request->idalmingresoproducto;
        // $precioVentaProducto->precio_compra_gespreventa = $request->precio_compra_gespreventa;
        // $precioVentaProducto->margen_30p_gespreventa = $request->margen_30p_gespreventa;
        // $precioVentaProducto->margen_40p_gespreventa = $request->margen_40p_gespreventa;
        // $precioVentaProducto->utilidad_neto_gespreventa = $request->utilidad_neto_gespreventa;
        // $precioVentaProducto->idusuario = auth()->user()->id;
        // $precioVentaProducto->save();
        
        return count($precioVentaProducto);
    }

    public function verificarProductoPrecio(Request $request)
    {
        $registroGestionPrecioVenta = GesPre_Venta::where('idalmingresoproducto',$request->id_alm__ingreso_producto)
                                                    ->get();
        return $registroGestionPrecioVenta;
    }
}
