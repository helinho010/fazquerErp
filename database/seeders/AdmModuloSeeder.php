<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdmModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('name', 'Admin')->first();        
        DB::table('par__modulos')->insert(['nombre'=>'administración','id_usuario_registra'=>$user->id]);
        DB::table('par__modulos')->insert(['nombre'=>'recursos humanos','id_usuario_registra'=>$user->id]);
        DB::table('par__modulos')->insert(['nombre'=>'almacenes','id_usuario_registra'=>$user->id]);
        DB::table('par__modulos')->insert(['nombre'=>'servicios','contabilizable'=>$user->id,'id_usuario_registra'=>$user->id]);
        DB::table('par__modulos')->insert(['nombre'=>'configuraciones','id_usuario_registra'=>$user->id]);
        DB::table('par__modulos')->insert(['nombre'=>'productos','id_usuario_registra'=>$user->id]);
    }
}
