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
        DB::table('adm__modulos')->insert(['nombre'=>'administración']);
        DB::table('adm__modulos')->insert(['nombre'=>'recursos humanos']);
        DB::table('adm__modulos')->insert(['nombre'=>'almacenes']);
        DB::table('adm__modulos')->insert(['nombre'=>'servicios']);
        DB::table('adm__modulos')->insert(['nombre'=>'parametros']);
        DB::table('adm__modulos')->insert(['nombre'=>'productos']);
    }
}
