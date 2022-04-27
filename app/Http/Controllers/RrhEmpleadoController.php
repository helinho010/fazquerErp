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
        $raw=DB::raw('concat(ifnull(papellido," ")," ",ifnull(sapellido," ")," ",rrh__empleados.nombre) as nomempleado');
        $raw2=DB::raw('concat(domicilio,"-",adm__ciudads.nombre) as direccion');
        $buscararray=array();
        if(!empty($request->buscar)){
            $buscararray = explode(" ",$request->buscar);
            //dd($buscararray);
            $valor=sizeof($buscararray);
            if($valor > 0){
                $sqls='';
                foreach($buscararray as $valor){
                    if(empty($sqls)){
                        $sqls="(rrh__empleados.nombre like '%".$valor."%' or papellido like '%".$valor."%' or  sapellido like '%".$valor."%' or ci like '%".$valor."%'
                        or rrh__formacions.nombre like '%".$valor."%'
                        or rrh__profesions.nombre like '%".$valor."%'
                        or rrh__cargos.nombre like '%".$valor."%' 
                        or nrcuenta like '%".$valor."%')" ;
                    }
                    else
                    {
                        $sqls.=" and (rrh__empleados.nombre like '%".$valor."%' or papellido like '%".$valor."%' or  sapellido like '%".$valor."%' or ci like '%".$valor."%'
                        or rrh__formacions.nombre like '%".$valor."%'
                        or rrh__profesions.nombre like '%".$valor."%'
                        or rrh__cargos.nombre like '%".$valor."%' 
                        or nrcuenta like '%".$valor."%')" ;
                    }
    
                }
                $empleados= Rrh_Empleado::join('rrh__formacions','rrh__formacions.id','rrh__empleados.idformacion')
                                        ->join('rrh__profesions','rrh__profesions.id','rrh__empleados.idprofesion')
                                        ->join('rrh__cargos','rrh__cargos.id','rrh__empleados.idcargo')
                                        ->leftjoin('adm__departamentos','adm__departamentos.id','rrh__empleados.iddepartamento')
                                        ->leftjoin('adm__nacionalidads','adm__nacionalidads.id', 'rrh__empleados.idnacionalidad')
                                        ->leftjoin('adm__ciudads','adm__ciudads.id', 'rrh__empleados.idciudad')
                                        ->leftjoin('adm__bancos','adm__bancos.id', 'rrh__empleados.idbanco')
                                        ->select('rrh__empleados.id',
                                                'rrh__empleados.nombre',
                                                'papellido',
                                                'sapellido',
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
                                                
                                                'domicilio',
                                                $raw2,
                                                'fechaingreso',
                                                'fecharetiro',
                                                'nrcuenta',
                                                'obs',
                                                'rrh__empleados.activo',
                                                'rrh__empleados.iddepartamento',
                                                'idnacionalidad',
                                                'idciudad',
                                                'idbanco',
                                                'adm__bancos.nombre',
                                                'complementoci',
                                                'celular',
                                                'nit')
                                        ->orderby('rrh__empleados.papellido','asc')
                                        ->orderby('rrh__empleados.sapellido','asc')
                                        ->orderby('rrh__empleados.nombre','asc')
                                        ->whereraw($sqls)->paginate(50);
            }
        }
        
        else
        {
            $empleados= Rrh_Empleado::join('rrh__formacions','rrh__formacions.id','rrh__empleados.idformacion')
                                    ->join('rrh__profesions','rrh__profesions.id','rrh__empleados.idprofesion')
                                    ->join('rrh__cargos','rrh__cargos.id','rrh__empleados.idcargo')
                                    ->leftjoin('adm__departamentos','adm__departamentos.id','rrh__empleados.iddepartamento')
                                    ->leftjoin('adm__nacionalidads','adm__nacionalidads.id', 'rrh__empleados.idnacionalidad')
                                    ->leftjoin('adm__ciudads','adm__ciudads.id', 'rrh__empleados.idciudad')
                                    ->leftjoin('adm__bancos','adm__bancos.id', 'rrh__empleados.idbanco')
                                    ->select('rrh__empleados.id',
                                            'rrh__empleados.nombre',
                                            'papellido',
                                            'sapellido',
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
                                            
                                            'domicilio',
                                            $raw2,
                                            'fechaingreso',
                                            'fecharetiro',
                                            'nrcuenta',
                                            'obs',
                                            'rrh__empleados.activo',
                                            'rrh__empleados.iddepartamento',
                                            'idnacionalidad',
                                            'idciudad',
                                            'idbanco',
                                            'adm__bancos.nombre as nombanco',
                                            'complementoci',
                                            'celular',
                                            'nit')
                                    ->orderby('rrh__empleados.papellido','asc')
                                    ->orderby('rrh__empleados.sapellido','asc')
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
       // dd($request);
        $empleado = new Rrh_Empleado();
        

        $empleado->nombre=$request->nombre;
        $empleado->papellido=$request->papellido;
        $empleado->sapellido=$request->sapellido;
       
        $empleado->ci=$request->ci;
        $empleado->sexo=$request->sexo;
        $empleado->complementoci=$request->complementoci;
        $empleado->iddepartamento=$request->iddepartamento;
        $empleado->fechanacimiento=$request->fechanacimiento;
        $empleado->foto=$request->foto;
        $empleado->estadocivil=$request->estadocivil;
        $empleado->idnacionalidad=$request->idnacionalidad;
        
        $empleado->domicilio=$request->domicilio;
        $empleado->idciudad=$request->idciudad;
        $empleado->telefonos=$request->telefonos;
        $empleado->celular=$request->celular;
        
        $empleado->idformacion=$request->idformacion;
        $empleado->idprofesion=$request->idprofesion;
        $empleado->idcargo=$request->idcargo;
        $empleado->nit=$request->nit;
        $empleado->fechaingreso=$request->fechaingreso;
        $empleado->fecharetiro=$request->fecharetiro;
        
        $empleado->idbanco=$request->idbanco;
        $empleado->nrcuenta=$request->nrcuenta;
        
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
        $empleado->papellido=$request->papellido;
        $empleado->sapellido=$request->sapellido;
       
        $empleado->ci=$request->ci;
        $empleado->sexo=$request->sexo;
        $empleado->complementoci=$request->complementoci;
        $empleado->iddepartamento=$request->iddepartamento;
        $empleado->fechanacimiento=$request->fechanacimiento;
        $empleado->foto=$request->foto;
        $empleado->estadocivil=$request->estadocivil;
        $empleado->idnacionalidad=$request->idnacionalidad;
        
        $empleado->domicilio=$request->domicilio;
        $empleado->idciudad=$request->idciudad;
        $empleado->telefonos=$request->telefonos;
        $empleado->celular=$request->celular;
        
        $empleado->idformacion=$request->idformacion;
        $empleado->idprofesion=$request->idprofesion;
        $empleado->idcargo=$request->idcargo;
        $empleado->nit=$request->nit;
        $empleado->fechaingreso=$request->fechaingreso;
        $empleado->fecharetiro=$request->fecharetiro;
        
        $empleado->idbanco=$request->idbanco;
        $empleado->nrcuenta=$request->nrcuenta;
        
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
        $raw=DB::raw('concat(ifnull(papellido," ")," ",ifnull(sapellido," ")," ",rrh__empleados.nombre) as nomempleado');
        $empleados=Rrh_Empleado::select('id',$raw)
                                ->where('activo',1)
                                ->orderby('rrh__empleados.papellido','asc')
                                ->orderby('rrh__empleados.sapellido','asc')
                                ->orderby('rrh__empleados.nombre','asc')
                                ->get();
        return $empleados;
    }
    public function selectNoUser(Request $request)
    {
        
        $raw2=DB::raw('concat(ifnull(papellido," ")," ",ifnull(sapellido," ")," ",rrh__empleados.nombre) as nomempleado');               
        $raw3=DB::raw('concat(left(nombre,1),ifnull(papellido,sapellido)) as name');
        //dd($raw2);
        $user=DB::table('users')->select('idempleado')->where('activo',1)->get()->toArray();
        //dd($user);
        $users=array();

        foreach ($user as $value) {
            array_push($users,$value->idempleado);
        }
        //dd($users);
        $empleados=DB::table('rrh__empleados')->select('id',$raw2,$raw3)
        ->whereNotIn('id',$users )
        ->get();

        //dd($empleados);
        return $empleados;
    }

    
}
