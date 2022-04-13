<?php

namespace App\Http\Controllers;

use App\Models\Rrh_Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RrhEmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $raw=DB::raw('concat(apaterno," ",amaterno," ",rrh__empleados.nombre) as nomempleado');
        $raw2=DB::raw('concat(domicilio,"-",ciudad) as direccion');
        $buscararray=array();
        if(!empty($request->buscar)){
            $buscararray = explode(" ",$request->buscar);
            //dd($buscararray);
            $valor=sizeof($buscararray);
            if($valor > 0){
                $sqls='';
                foreach($buscararray as $valor){
                    if(empty($sqls)){
                        $sqls="(rrh__empleados.nombre like '%".$valor."%' or apaterno like '%".$valor."%' or  amaterno like '%".$valor."%' or ci like '%".$valor."%'
                        or rrh__formacions.nombre like '%".$valor."%'
                        or rrh__profesions.nombre like '%".$valor."%'
                        or rrh__cargos.nombre like '%".$valor."%' 
                        or ciudad like '%".$valor."%'
                        or nrcuenta like '%".$valor."%')" ;
                    }
                    else
                    {
                        $sqls.=" and (rrh__empleados.nombre like '%".$valor."%' or apaterno like '%".$valor."%' or  amaterno like '%".$valor."%' or ci like '%".$valor."%'
                        or rrh__formacions.nombre like '%".$valor."%'
                        or rrh__profesions.nombre like '%".$valor."%'
                        or rrh__cargos.nombre like '%".$valor."%' 
                        or ciudad like '%".$valor."%'
                        or nrcuenta like '%".$valor."%')" ;
                    }
    
                }
                $empleados= Rrh_Empleado::join('rrh__formacions','rrh__formacions.id','rrh__empleados.idformacion')
                                        ->join('rrh__profesions','rrh__profesions.id','rrh__empleados.idprofesion')
                                        ->join('rrh__cargos','rrh__cargos.id','rrh__empleados.idcargo')
                                        ->select('rrh__empleados.id',
                                                'rrh__empleados.nombre',
                                                'apaterno',
                                                'amaterno',
                                                $raw,
                                                'sexo',
                                                'ci',
                                                'telefonos',
                                                'fechanacimiento',
                                                'estadocivil',
                                                'rrh__formacions.nombre as nomformacion',
                                                'rrh__profesions.nombre as nomprofecion',
                                                'rrh__cargos.nombre as nomcargo',
                                                'rrh__formacions.id as idformacion',
                                                'rrh__profesions.id as idprofesion',
                                                'rrh__cargos.id as idcargo',
                                                'ciudad',
                                                'domicilio',
                                                $raw2,
                                                'fechaingreso',
                                                'fecharetiro',
                                                'nrcuenta',
                                                'obs',
                                                'rrh__empleados.activo')
                                        ->orderby('rrh__empleados.apaterno','asc')
                                        ->orderby('rrh__empleados.amaterno','asc')
                                        ->orderby('rrh__empleados.nombre','asc')
                                        ->whereraw($sqls)->paginate(50);
            }
        }
        
        else
        {
            $empleados= Rrh_Empleado::join('rrh__formacions','rrh__formacions.id','rrh__empleados.idformacion')
                                    ->join('rrh__profesions','rrh__profesions.id','rrh__empleados.idprofesion')
                                    ->join('rrh__cargos','rrh__cargos.id','rrh__empleados.idcargo')
                                    ->select('rrh__empleados.id',
                                            'rrh__empleados.nombre',
                                            'apaterno',
                                            'amaterno',
                                            $raw,
                                            'sexo',
                                            'ci',
                                            'telefonos',
                                            'fechanacimiento',
                                            'estadocivil',
                                            'rrh__formacions.nombre as nomformacion',
                                            'rrh__profesions.nombre as nomprofecion',
                                            'rrh__cargos.nombre as nomcargo',
                                            'rrh__formacions.id as idformacion',
                                            'rrh__profesions.id as idprofesion',
                                            'rrh__cargos.id as idcargo',
                                            'ciudad',
                                            'domicilio',
                                            $raw2,
                                            'fechaingreso',
                                            'fecharetiro',
                                            'nrcuenta',
                                            'obs',
                                            'rrh__empleados.activo')
                                    ->orderby('rrh__empleados.apaterno','asc')
                                    ->orderby('rrh__empleados.amaterno','asc')
                                    ->orderby('rrh__empleados.nombre','asc')
                                    ->paginate(50);
        }
        
        //$empleados = Rrh_Empleado::all();
        
        
        return ['pagination'=>[
            'total'         =>    $empleados->total(),
            'current_page'  =>    $empleados->currentPage(),
            'per_page'      =>    $empleados->perPage(),
            'last_page'     =>    $empleados->lastPage(),
            'from'          =>    $empleados->firstItem(),
            'to'            =>    $empleados->lastItem(),

            ] ,
                'empleados'=>$empleados
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
        $empleado = new Rrh_Empleado();

        $empleado->nombre=$request->nombre;
        $empleado->apaterno=$request->apaterno;
        $empleado->amaterno=$request->amaterno;
        $empleado->ci=$request->ci;
        $empleado->telefonos=$request->telefonos;
        $empleado->idformacion=$request->idformacion;
        $empleado->idprofesion=$request->idprofesion;
        $empleado->idcargo=$request->idcargo;
        $empleado->fechanacimiento=$request->fechanacimiento;
        $empleado->domicilio=$request->domicilio;
        $empleado->ciudad=$request->ciudad;
        $empleado->fechaingreso=$request->fechaingreso;
        $empleado->sexo=$request->sexo;
        $empleado->estadocivil=$request->estadocivil;
        $empleado->nrcuenta=$request->nrcuenta;
        $empleado->fecharetiro=$request->fecharetiro;
        $empleado->obs=$request->obs;
        $empleado->id_usuario_registra=auth()->user()->id;
        $empleado->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rrh_Empleado  $rrh_Empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Rrh_Empleado $rrh_Empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rrh_Empleado  $rrh_Empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(Rrh_Empleado $rrh_Empleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rrh_Empleado  $rrh_Empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rrh_Empleado $rrh_Empleado)
    {
        $empleado = Rrh_Empleado::findOrFail($request->id);

        $empleado->nombre=$request->nombre;
        $empleado->apaterno=$request->apaterno;
        $empleado->amaterno=$request->amaterno;
        $empleado->ci=$request->ci;
        $empleado->telefonos=$request->telefonos;
        $empleado->idformacion=$request->idformacion;
        $empleado->idprofesion=$request->idprofesion;
        $empleado->idcargo=$request->idcargo;
        $empleado->fechanacimiento=$request->fechanacimiento;
        $empleado->domicilio=$request->domicilio;
        $empleado->ciudad=$request->ciudad;
        $empleado->fechaingreso=$request->fechaingreso;
        $empleado->sexo=$request->sexo;
        $empleado->estadocivil=$request->estadocivil;
        $empleado->nrcuenta=$request->nrcuenta;
        $empleado->fecharetiro=$request->fecharetiro;
        $empleado->obs=$request->obs;
        $empleado->id_usuario_modifica=auth()->user()->id;
        $empleado->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rrh_Empleado  $rrh_Empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rrh_Empleado $rrh_Empleado)
    {
        //
    }
    public function desactivar(Request $request)
    {
        $empleado = Rrh_Empleado::findOrFail($request->id);
        $empleado->activo=0;
        $empleado->id_usuario_modifica=auth()->user()->id;
        $empleado->save();
    }

    public function activar(Request $request)
    {
        $empleado = Rrh_Empleado::findOrFail($request->id);
        $empleado->activo=1;
        $empleado->id_usuario_modifica=auth()->user()->id;
        $empleado->save();
    }
    public function selectEmpleado(Request $request)
    {
        $raw=DB::raw('concat(apaterno," ",amaterno," ",rrh__empleados.nombre) as nomempleado');
        $empleados=Rrh_Empleado::select('id',$raw)
                                ->where('activo',1)
                                ->orderby('rrh__empleados.apaterno','asc')
                                ->orderby('rrh__empleados.amaterno','asc')
                                ->orderby('rrh__empleados.nombre','asc')
                                ->get();
        return $empleados;
    }
}
