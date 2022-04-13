<?php

namespace App\Http\Controllers;

use App\Models\Adm_Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdmSucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buscararray=array();
        if(!empty($request->buscar)){
            $buscararray = explode(" ",$request->buscar);
            //dd($buscararray);
            $valor=sizeof($buscararray);
            if($valor > 0){
                $sqls='';
                foreach($buscararray as $valor){
                    if(empty($sqls)){
                        $sqls="(razon_social like '%".$valor."%' or nit like '%".$valor."%' or direccion like '%".$valor."%' or adm__rubros.nombre like '%".$valor."%')" ;
                    }
                    else
                    {
                        $sqls.=" and (razon_social like '%".$valor."%' or nit like '%".$valor."%' or direccion like '%".$valor."%' or adm__rubros.nombre like '%".$valor."%')" ;
                    }
    
                }
                $sucursales= Adm_Sucursal::join('adm__rubros','adm__rubros.id','adm__sucursals.idrubro')
                                            ->select('adm__sucursals.id',
                                                    'adm__rubros.id as idrubro',
                                                    'adm__rubros.nombre as nomrubro',
                                                    'adm__sucursals.tipo',
                                                    'adm__sucursals.cod',
                                                    'correlativo',
                                                    'razon_social',
                                                    'telefonos',
                                                    'nit',
                                                    'direccion',
                                                    'ciudad',
                                                    'adm__sucursals.activo')
                                            ->orderby('razon_social','asc')
                                            ->whereraw($sqls)
                                            
                                            ->paginate(50);
            }
        }
        
        else
        {
            $sucursales= Adm_Sucursal::join('adm__rubros','adm__rubros.id','adm__sucursals.idrubro')
                                    ->select('adm__sucursals.id',
                                            'adm__rubros.id as idrubro',
                                            'adm__rubros.nombre as nomrubro',
                                            'adm__sucursals.tipo',
                                            'adm__sucursals.cod',
                                            'correlativo',
                                            'razon_social',
                                            'telefonos',
                                            'nit',
                                            'direccion',
                                            'ciudad',
                                            'adm__sucursals.activo')
                                    
                                    ->orderby('razon_social','asc')
                                    ->paginate(50);
        }
        
        //$sucursales = Adm_Sucursal::all();
        
        return ['pagination'=>[
                'total'         =>    $sucursales->total(),
                'current_page'  =>    $sucursales->currentPage(),
                'per_page'      =>    $sucursales->perPage(),
                'last_page'     =>    $sucursales->lastPage(),
                'from'          =>    $sucursales->firstItem(),
                'to'            =>    $sucursales->lastItem(),

            ] ,
                'sucursales'=>$sucursales,
        ];
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
        $letracodigo='SU';
        $maxcorrelativo = Adm_Sucursal::select(DB::raw('max(correlativo) as maximo'))
                                ->get()->toArray();
        //dd($maxcorrelativo);
        $correlativo=$maxcorrelativo[0]['maximo'];
        //dd($correlativo);
        if(is_null($correlativo))
            $correlativo=1;
        else
            $correlativo=$correlativo+1;

        if($correlativo<10)
            $codigo='00'.$correlativo;
        else
            if($correlativo<100)
                $codigo='0'.$correlativo;

                
        
        $codigo=$letracodigo.$codigo;        
        
        
        $sucursal = new Adm_Sucursal();
        $sucursal->idrubro=$request->idrubro;
        $sucursal->tipo=$request->tipo;
        $sucursal->cod=$codigo;
        $sucursal->correlativo=$correlativo;
        $sucursal->razon_social=$request->razon_social;
        $sucursal->telefonos=$request->telefonos;
        $sucursal->nit=$request->nit;
        $sucursal->direccion=$request->direccion;
        $sucursal->ciudad=$request->ciudad;
        $sucursal->id_usuario_registra=auth()->user()->id;
        $sucursal->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adm_Sucursal  $adm_Sucursal
     * @return \Illuminate\Http\Response
     */
    public function show(Adm_Sucursal $adm_Sucursal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Adm_Sucursal  $adm_Sucursal
     * @return \Illuminate\Http\Response
     */
    public function edit(Adm_Sucursal $adm_Sucursal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Adm_Sucursal  $adm_Sucursal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $sucursal = Adm_Sucursal::findOrFail($request->id);

        $sucursal->idrubro=$request->idrubro;
        $sucursal->tipo=$request->tipo;
        $sucursal->razon_social=$request->razon_social;
        $sucursal->telefonos=$request->telefonos;
        $sucursal->nit=$request->nit;
        $sucursal->direccion=$request->direccion;
        $sucursal->ciudad=$request->ciudad;
        $sucursal->id_usuario_modifica=auth()->user()->id;
        $sucursal->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adm_Sucursal  $adm_Sucursal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adm_Sucursal $adm_Sucursal)
    {
        //
    }
    public function desactivar(Request $request)
    {
        $sucursal = Adm_Sucursal::findOrFail($request->id);
        $sucursal->activo=0;
        $sucursal->id_usuario_modifica=auth()->user()->id;
        $sucursal->save();
    }

    public function activar(Request $request)
    {
        $sucursal = Adm_Sucursal::findOrFail($request->id);
        $sucursal->activo=1;
        $sucursal->id_usuario_modifica=auth()->user()->id;
        $sucursal->save();
    }
    public function selectSucursal()
    {
        $sucursales=Adm_Sucursal::select('id','cod','tipo','razon_social as nombre')
                                ->where('activo',1)
                                ->orderBy('cod', 'asc')
                                ->get();
        return $sucursales;
    }
}
