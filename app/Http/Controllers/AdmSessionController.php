<?php

namespace App\Http\Controllers;

use App\Models\Adm_Modulo;
use App\Models\Adm_Role;
use App\Models\Adm_Session;
use App\Models\Adm_UserRoleSucursal;
use App\Models\Adm_VentanaModulo;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class AdmSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->attempt(request(['email','password']))==false)
        {
            return back()->withErrors([
                'message'=>'Email o contraseña incorrectos, intentelo de nuevo'
            ]);

        }
        return redirect()->to('/selectsuc');

    }
    public function sucursal(Request $request)
    {
        //$rawroles=DB::raw('concat(adm__roles.nombre," - ",adm__sucursals.razon_social) as rolsucursal');
        $sucursales=Adm_UserRoleSucursal::join('adm__roles','adm__roles.id','adm__user_role_sucursals.idrole')
                                            ->join('adm__sucursals','adm__sucursals.id','adm__user_role_sucursals.idsucursal')
                                            ->select('adm__user_role_sucursals.id as id',
                                            'adm__roles.nombre as nomrole',
                                            'adm__sucursals.razon_social as nomsuc',
                                            'idsucursal',
                                            'idrole'
                                            
                                        )
                                        ->where('iduser',auth()->user()->id)
                                        ->where('adm__user_role_sucursals.activo',1)
                                        ->get();
        $lleno=count($sucursales);
        if($lleno==0)                                
            return redirect()->to('/');
        else
            return view('auth.sucursal')->with('sucursales',$sucursales);
    }
    public function entrar(Request $request)
    {
        //dd($request->sucur);

        $sucurs=Adm_UserRoleSucursal::join('adm__roles','adm__roles.id','adm__user_role_sucursals.idrole')
                                        ->join('adm__sucursals','adm__sucursals.id','adm__user_role_sucursals.idsucursal')
                                        ->select('adm__user_role_sucursals.id as id',
                                        'adm__roles.nombre as nomrole',
                                        'adm__sucursals.razon_social as nomsuc',
                                        'idsucursal',
                                        'idrole'
                                        )
                                        ->where('adm__user_role_sucursals.id',$request->sucur)
                                        ->get();

        
        
        //dd($sucurs[0]->nomrole);

        session(['idsuc'=>$sucurs[0]->idsucursal,
                'nomsucursal'=>$sucurs[0]->nomsuc,
                'nomrol'=>$sucurs[0]->nomrole,
                'idrole'=>$sucurs[0]->idrole,
                'iduserrolesuc'=>$request->sucur,
            ]);
            //dd(session('nomrol'));
        return redirect()->to('/');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adm_Session  $adm_Session
     * @return \Illuminate\Http\Response
     */
    public function show(Adm_Session $adm_Session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Adm_Session  $adm_Session
     * @return \Illuminate\Http\Response
     */
    public function edit(Adm_Session $adm_Session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Adm_Session  $adm_Session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Adm_Session $adm_Session)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adm_Session  $adm_Session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adm_Session $adm_Session)
    {
        session()->forget('idsucursal');
        session()->forget('nomsucursal');
        session()->forget('nomrol');
        auth()->logout();
        return redirect()->to('/');
    }
    public static function listarPermisos(){
        //echo "hola";
        
        //dd($idventanas);

        if(auth()->user()->name=='admin'){
            $modulos=Adm_Modulo::all();
            //dd($modulos);
            foreach ($modulos as $value) {
                $ventanas=Adm_VentanaModulo::where('idmodulo',$value->id)    
                                            ->where('activo',1)
                                            ->get();

                $value->ventanas=$ventanas;
            }
        }
        else
        {
            $idrole=session('idrole');
            //dd($idrole);
            $roles=Adm_Role::where('id',$idrole)
                            ->get();
            //dd($roles)       ;
            $idmodulos=explode(",",$roles[0]->idmodulos);
            $idventanas=explode(",",$roles[0]->idventanas);
 
            $modulos=Adm_Modulo::wherein('id',$idmodulos)->get();
            foreach ($modulos as $value) {
                $ventanas=Adm_VentanaModulo::wherein('id',$idventanas)->get();    
                $value->ventanas=$ventanas;
            }
        }

        


        return ['modulos'=>$modulos];



        //dd($role);

    }
    public static function listarVentanas()
    {
        $ventanas =Adm_VentanaModulo::where('activo',1)->get();

        return $ventanas;
    }

}
