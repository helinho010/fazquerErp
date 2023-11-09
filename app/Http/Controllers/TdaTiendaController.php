<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tda_Tienda;
use App\Models\Adm_Sucursal;

class TdaTiendaController extends Controller
{
    
    public function index(Request $request)
    {

        $tiendas = Adm_Sucursal::selectRaw(
                                            'adm__sucursals.cod as codigo_sucursal,
                                            adm__sucursals.razon_social,
                                            adm__sucursals.nombre_comercial,
                                            adm__sucursals.telefonos,
                                            adm__sucursals.nit,
                                            adm__sucursals.direccion,
                                            adm__sucursals.departamento,
                                            adm__sucursals.ciudad,
                                            adm__sucursals.activo as activo_sucursal,
                                            tda__tiendas.codigo as codigo_tienda,
                                            tda__tiendas.activo as activo_tienda,
                                            adm__rubros.nombre as nombre_rubro,
                                            adm__rubros.areamedica,
                                            adm__rubros.activo as activo_rubro')
                             ->leftJoin('tda__tiendas', 'tda__tiendas.idsucursal', '=', 'adm__sucursals.id')
                             ->leftJoin('adm__rubros', 'adm__rubros.id', '=', 'adm__sucursals.idrubro')
                             ->paginate(15);
        return 
        [
            'pagination'=>
            [
                'total'         =>    $tiendas->total(),
                'current_page'  =>    $tiendas->currentPage(),
                'per_page'      =>    $tiendas->perPage(),
                'last_page'     =>    $tiendas->lastPage(),
                'from'          =>    $tiendas->firstItem(),
                'to'            =>    $tiendas->lastItem(),
            ] ,
           'tiendas'=>$tiendas,
        ];
    }
}
