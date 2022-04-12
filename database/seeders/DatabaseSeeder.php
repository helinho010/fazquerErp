<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
            'adm__rubros',
            'adm__sucursals',
            'rrh__unidad_organizacionals',
            'rrh__cargos',
            'rrh__formacions',
            'rrh__profesions',
            'rrh__empleados',
            'adm__modulos',
            'adm__ventana_modulos',
            'adm__accion_ventanas',
            'adm__roles',
            'adm__role_accions',
            'users',
            'adm__user_role_sucursals',
        ]);
        
        $this->call(AdmRubroSeeder::class);
        $this->call(AdmSucursalSeeder::class);
        $this->call(RrhUnidadOrganizacionalSeeder::class);
        $this->call(RrhCargoSeeder::class);
        $this->call(RrhFormacionSeeder::class);
        $this->call(RrhProfesionSeeder::class);
        $this->call(RrhEmpleadoSeeder::class);
        $this->call(AdmModuloSeeder::class);
        $this->call(AdmVentanaModuloSeeder::class);
        $this->call(AdmAccionVentanaSeeder::class);
        $this->call(AdmRoleSeeder::class);
        $this->call(AdmRoleAccionSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(AdmUserRoleSucursalSeeder::class);

        
    }
    protected function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS =0');

        foreach($tables as $table)
        {
            DB::table($table)->truncate(); // para vaciar la tabla
        }
    }
}
