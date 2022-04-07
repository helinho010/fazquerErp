<?php

namespace App\Http\Controllers;

use App\Models\Adm_Session;
use Illuminate\Http\Request;
use App\Models\User;

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
        auth()->logout();
        return redirect()->to('/');
    }
}
