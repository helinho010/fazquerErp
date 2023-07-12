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
        DB::table('adm__modulos')->insert(['nombre'=>'administración','nombre_icono'=>'fa fa-cog']);
        DB::table('adm__modulos')->insert(['nombre'=>'recursos humanos','nombre_icono'=>'fa fa-handshake-o']);
        DB::table('adm__modulos')->insert(['nombre'=>'almacenes','nombre_icono'=>'fa fa-archive']);
        DB::table('adm__modulos')->insert(['nombre'=>'servicios','nombre_icono'=>'fa fa-list-alt']);
        DB::table('adm__modulos')->insert(['nombre'=>'parametros','nombre_icono'=>'fa fa-sliders']);
        DB::table('adm__modulos')->insert(['nombre'=>'productos','nombre_icono'=>'fa fa-product-hunt']);
    }
}
