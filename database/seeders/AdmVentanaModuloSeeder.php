<?php

namespace Database\Seeders;

use App\Models\Adm_Modulo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdmVentanaModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Adm_Modulo::where('nombre', 'administración')->first();        
        $rh = Adm_Modulo::where('nombre', 'recursos humanos')->first();        
        $alm = Adm_Modulo::where('nombre', 'almacenes')->first();        
        $serv = Adm_Modulo::where('nombre', 'servicios')->first();        
        $config = Adm_Modulo::where('nombre', 'configuraciones')->first();        
        $prod = Adm_Modulo::where('nombre', 'productos')->first();        

        
        
        //administracion 100

        DB::table('adm__ventana_modulos')->insert(['codventana'=>'101','idmodulo'=>$admin->id,'nombre'=>'Mod. Vent. Acc.','template'=>'modulo-component']);
        DB::table('adm__ventana_modulos')->insert(['codventana'=>'102','idmodulo'=>$admin->id,'nombre'=>'Roles-Permisos','template'=>'rolpermiso-component']);
        DB::table('adm__ventana_modulos')->insert(['codventana'=>'103','idmodulo'=>$admin->id,'nombre'=>'Usuarios','template'=>'usuario-component']);
        DB::table('adm__ventana_modulos')->insert(['codventana'=>'104','idmodulo'=>$admin->id,'nombre'=>'Sucursales','template'=>'sucursal-component']);
        //DB::table('adm__ventana_modulos')->insert(['codventana'=>'102','idmodulo'=>$admin->id,'nombre'=>'Cargos','template'=>'cargos-component']);
        //recursos humanos 200
        DB::table('adm__ventana_modulos')->insert(['codventana'=>'201','idmodulo'=>$rh->id,'nombre'=>'Nivel de Formacion','template'=>'rrhnivel-component']);
        DB::table('adm__ventana_modulos')->insert(['codventana'=>'202','idmodulo'=>$rh->id,'nombre'=>'Profesiones','template'=>'rrhprofesion-component']);
        DB::table('adm__ventana_modulos')->insert(['codventana'=>'203','idmodulo'=>$rh->id,'nombre'=>'Unidad Organizacional','template'=>'rrhuorg-component']);
        DB::table('adm__ventana_modulos')->insert(['codventana'=>'204','idmodulo'=>$rh->id,'nombre'=>'Cargos','template'=>'rrhconf-component']);
        DB::table('adm__ventana_modulos')->insert(['codventana'=>'205','idmodulo'=>$rh->id,'nombre'=>'Empleados','template'=>'rrhempleados-component']);

        //almacenes 300

        DB::table('adm__ventana_modulos')->insert(['codventana'=>'301','idmodulo'=>$alm->id,'nombre'=>'Codificacion','template'=>'codificacion-component']);
        DB::table('adm__ventana_modulos')->insert(['codventana'=>'302','idmodulo'=>$alm->id,'nombre'=>'Ingreso Productos','template'=>'almacen-component']);
        

        //servicios 400
        DB::table('adm__ventana_modulos')->insert(['codventana'=>'401','idmodulo'=>$serv->id,'nombre'=>'Areas','template'=>'area-component']);
        DB::table('adm__ventana_modulos')->insert(['codventana'=>'402','idmodulo'=>$serv->id,'nombre'=>'Prestaciones','template'=>'prestaciones-component']);
        DB::table('adm__ventana_modulos')->insert(['codventana'=>'403','idmodulo'=>$serv->id,'nombre'=>'Venta Servicios','template'=>'ventas-component']);
        DB::table('adm__ventana_modulos')->insert(['codventana'=>'404','idmodulo'=>$serv->id,'nombre'=>'Historial Ventas','template'=>'histventas-component']);


        //configuraciones 500
        DB::table('adm__ventana_modulos')->insert(['codventana'=>'501','idmodulo'=>$config->id,'nombre'=>'Desc. Servicios','template'=>'descuentos-component']);
        DB::table('adm__ventana_modulos')->insert(['codventana'=>'502','idmodulo'=>$config->id,'nombre'=>'Desc. Productos','template'=>'descproductos-component']);


        //productos 600
        DB::table('adm__ventana_modulos')->insert(['codventana'=>'601','idmodulo'=>$prod->id,'nombre'=>'Lineas','template'=>'linea-component']);
        DB::table('adm__ventana_modulos')->insert(['codventana'=>'602','idmodulo'=>$prod->id,'nombre'=>'Registro Producto','template'=>'producto-component']);
        DB::table('adm__ventana_modulos')->insert(['codventana'=>'603','idmodulo'=>$prod->id,'nombre'=>'Dispenser','template'=>'dispenser-component']);
        DB::table('adm__ventana_modulos')->insert(['codventana'=>'604','idmodulo'=>$prod->id,'nombre'=>'Forma Farmaceutica','template'=>'formafarm-component']);
        DB::table('adm__ventana_modulos')->insert(['codventana'=>'605','idmodulo'=>$prod->id,'nombre'=>'Categorias','template'=>'categoria-component']);
    }
}
