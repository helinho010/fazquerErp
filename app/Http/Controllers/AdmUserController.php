<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdmUserController extends Controller
{
    public static function getUser() {    
        //dd(Auth::user());
        return Auth::user();    
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $raw=DB::raw('concat(nombre," ",apaterno," ",amaterno) as nombre');
        $buscararray=array();
        if(!empty($request->buscar)){
            $buscararray = explode(" ",$request->buscar);
            //dd($buscararray);
            $valor=sizeof($buscararray);
            if($valor > 0){
                $sqls='';
                foreach($buscararray as $valor){
                    if(empty($sqls)){
                        $sqls="(rrh__nombre like '%".$valor."%' or apaterno like '%".$valor."%' or amaaterno like '%".$valor."%' or email like '%".$valor."%')" ;
                    }
                    else
                    {
                        $sqls.=" and (rrh__nombre like '%".$valor."%' or apaterno like '%".$valor."%' or amaaterno like '%".$valor."%' or email like '%".$valor."%')" ;
                    }
    
                }
                $users= User::join('rrh__empleados','rrh__empleados.id','users.idempleado')
                                ->select($raw,
                                        'users.id as id',
                                        'email',
                                        'users.activo')
                                ->orderby('rrh__empleados.apaterno','asc')
                                ->orderby('rrh__empleados.amaterno','asc')
                                ->orderby('nombre','asc')
                                ->whereraw($sqls)->paginate(50);
            }
        }
        
        else
        {
            $users= User::join('rrh__empleados','rrh__empleados.id','users.idempleado')
                            ->select($raw,
                                    'users.id as id',
                                    'email',
                                    'users.activo')
                            ->orderby('rrh__empleados.apaterno','asc')
                            ->orderby('rrh__empleados.amaterno','asc')
                            ->orderby('nombre','asc')
                            ->paginate(20);
        }
        
        //$users = User::all();
        
        
        return ['pagination'=>[
            'total'         =>    $users->total(),
            'current_page'  =>    $users->currentPage(),
            'per_page'      =>    $users->perPage(),
            'last_page'     =>    $users->lastPage(),
            'from'          =>    $users->firstItem(),
            'to'            =>    $users->lastItem(),

            ] ,
                'users'=>$users
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
        $user = new User();
       
        $user->nombre=$request->nombre;
        $user->email=$request->descripcion;
        $user->password=$request->areamedica;
        $user->id_usuario_registra=auth()->user()->id;
        $user->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $adm_Rubro
     * @return \Illuminate\Http\Response
     */
    public function show(User $adm_Rubro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $adm_Rubro
     * @return \Illuminate\Http\Response
     */
    public function edit(User $adm_Rubro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $adm_Rubro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $adm_Rubro)
    {
        $user = User::findOrFail($request->id);

        $user->nombre=$request->nombre;
        $user->descripcion=$request->descripcion;
        $user->areamedica=$request->areamedica;
        $user->id_usuario_modifica=auth()->user()->id;
        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $adm_Rubro
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $adm_Rubro)
    {
        //
    }
    public function desactivar(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->activo=0;
        $user->id_usuario_modifica=auth()->user()->id;
        $user->save();
    }

    public function activar(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->activo=1;
        $user->id_usuario_modifica=auth()->user()->id;
        $user->save();
    }
    public function selectRubro(Request $request)
    {
        $users=User::select('id','nombre','areamedica')
                                ->where('activo',1)
                                ->orderBy('nombre', 'asc')
                                ->get();
        return $users;
        
        /* $buscararray = array(); 
        if(!empty($request->buscar)) $buscararray = explode(" ",$request->buscar); 
        $raw=DB::raw(DB::raw('concat(codigo," ",nombre) as cod'));
        if (sizeof($buscararray)>0) { 
            $sqls=''; 
            foreach($buscararray as $valor){
                if(empty($sqls))
                    $sqls="(nombre like '%".$valor."%' )";
                else
                    $sqls.=" and (nombre like '%".$valor."%' )";
            }   
            $users = User::select($raw,'id','nombre','codigo')
                                ->where('activo',1)
                                ->whereraw($sqls)
                                ->orderby('codigo','asc')
                                ->get();
        }
        else {
            if ($request->id){
                    $users = User::select($raw,'id','nombre','codigo')
                                                 ->where('activo',1)
                                                ->where('id',$request->id)
                                                ->orderby('codigo','asc')
                                                ->get();
            }

            else
            {
                $users = User::select($raw,'id','nombre','codigo')
                                    ->where('activo',1)
                                    ->orderby('codigo','asc')
                                    ->get();
            }
              
        }
        return ['users' => $users]; */
        

    }
}
