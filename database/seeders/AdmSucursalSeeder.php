<?php

namespace Database\Seeders;

use App\Models\Adm_Rubro;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdmSucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $rubro = Adm_Rubro::where('nombre', 'Venta de Productos Farmaceuticos')->first();        
        DB::table('adm__sucursals')->insert(['cod'=>'SU001','idrubro'=>$rubro->id,'correlativo'=>0,'tipo'=>'Casa_Matriz','razon_social'=>'ALVARO COCARICO','telefonos'=>'123456','nit'=>'123456','direccion'=>'Santiago II','ciudad'=>'El Alto']);
        DB::table('adm__sucursals')->insert(['cod'=>'SU002','idrubro'=>$rubro->id,'correlativo'=>1,'tipo'=>'Sucursal','razon_social'=>'Sucursal 1','telefonos'=>'123456','nit'=>'123456','direccion'=>'Santiago II','ciudad'=>'El Alto']);
        DB::table('adm__sucursals')->insert(['cod'=>'SU003','idrubro'=>$rubro->id,'correlativo'=>2,'tipo'=>'Sucursal','razon_social'=>'Sucursal 1','telefonos'=>'123456','nit'=>'123456','direccion'=>'Santiago II','ciudad'=>'El Alto']);
    }
}
