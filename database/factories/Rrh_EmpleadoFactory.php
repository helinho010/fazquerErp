<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rrh_Empleado>
 */
class Rrh_EmpleadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sexo=array('M','F');
        $estadoCivil=array('Soltero(a)','Casado(a)','Divorciado(a)');
        $codigoEmpleado=array('A','B','C','D','E','F','G','H','I','J','K');
        return [
            'codempleado'=>rand(333333,888888).'-'.$codigoEmpleado[rand(0,10)].$codigoEmpleado[rand(0,10)].$codigoEmpleado[rand(0,10)],
            'nombre'=>fake()->name('male'),
            'papellido'=>fake()->lastName,
            'sapellido'=>fake()->lastName,
            'sexo'=>$sexo[rand(0,1)],
            'ci'=>rand(444444,999999),
            'complementoci'=>null,
            'iddepartamento'=>rand(1,9),
            'fechanacimiento'=>date("Y-m-d"),
            'foto'=>'empleados/Xx0NbVIGBdyK1GA3hMyDJwK6KqVJMJNHu6U1p91i.jpg',
            'estadocivil'=>$estadoCivil[rand(0,2)],
            'idnacionalidad'=>rand(1,5),
            
            'domicilio'=>'Villa Dolores, calle 12 de octubre # 2023',
            'idciudad'=>rand(1,9),
            'telefonos'=>fake()->phoneNumber,
            'celular'=>fake()->tollFreePhoneNumber,

            'idformacion'=>rand(1,11),
            'idprofesion'=>rand(1,9),
            'idcargo'=>rand(1,17),
            'nit'=>rand(5555555,999999),
            'fechaingreso'=>'2023-05-22',
            'fecharetiro'=>null,
            
            'idbanco'=>rand(1,3),
            'nrcuenta'=>fake()->phoneNumber,
            
            'obs'=>fake()->address
        ];
    }
}
