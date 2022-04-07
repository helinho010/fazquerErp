<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdmUserController extends Controller
{
    public static function getUser() {    
        //dd(Auth::user());
        return Auth::user();    
    }
}
