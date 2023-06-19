<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
//use App\Models\Adm_Rubro;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Adm_Rubro>
 */
class Adm_RubroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre'=> fake()->name(),
            'areamedica'=>1,
            'activo'=>1,
        ];
    }
}
