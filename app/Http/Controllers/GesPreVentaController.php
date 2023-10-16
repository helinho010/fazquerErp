<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GesPre_Venta;

class GesPreVentaController extends Controller
{
    //
    public function store(Request $request)
    {
        $nuevoPrecioVenta = new GesPre_Venta();
        $nuevoPrecioVenta->idalmingresoproducto = $request->idalmingresoproducto;
        $nuevoPrecioVenta->precio_compra_gespreventa = $request->precio_compra_gespreventa;
        $nuevoPrecioVenta->margen_30p_gespreventa = $request->margen_30p_gespreventa;
        $nuevoPrecioVenta->margen_40p_gespreventa = $request->margen_40p_gespreventa;
        $nuevoPrecioVenta->utilidad_neto_gespreventa = $request->utilidad_neto_gespreventa;
        $nuevoPrecioVenta->idusuario = auth()->user()->id;
        $nuevoPrecioVenta->save();

        return $nuevoPrecioVenta;
    }
}
