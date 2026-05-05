<?php

namespace Database\Factories;

use App\Models\Organo;
use App\Models\Ubicacion;
use App\Models\CategoriaBien;
use App\Models\Fabricante;
use App\Models\Custodio;
use App\Models\Bien;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BienFactory extends Factory
{
    protected $model = Bien::class;

    public function definition(): array
    {
        return [
            'codigo_patrimonial' => 'MPP-' . fake()->unique()->bothify('####-#####-###'),
            'codigo_interno' => fake()->optional()->bothify('INT-####'),
            'nombre' => fake()->words(3, true),
            'descripcion' => fake()->optional()->paragraph(),
            'marca' => fake()->company(),
            'modelo' => fake()->bothify('Model-###'),
            'serial' => fake()->optional()->bothify('SN-########'),
            'color' => fake()->safeColorName(),
            'categoria_id' => CategoriaBien::factory(),
            'fabricante_id' => Fabricante::factory(),
            'organo_id' => Organo::factory(),
            'ubicacion_id' => Ubicacion::factory(),
            'custodio_actual_id' => null,
            'valor_original' => fake()->randomFloat(2, 100, 50000),
            'valor_actual' => fn(array $attrs) => $attrs['valor_original'] * 0.8,
            'valor_residual' => fn(array $attrs) => $attrs['valor_original'] * 0.1,
            'fecha_adquisicion' => fake()->dateTimeBetween('-5 years', '-1 month')->format('Y-m-d'),
            'documento_adquisicion' => fake()->optional()->bothify('OC-N°-####'),
            'fecha_puesta_servicio' => fake()->dateTimeBetween('-4 years', '-1 day')->format('Y-m-d'),
            'estado_fisico' => fake()->randomElement(['nuevo', 'bueno', 'regular', 'bueno', 'bueno']),
            'condicion_uso' => 'operativo',
            'vida_util_anios' => fake()->numberBetween(3, 20),
            'fecha_vencimiento_garantia' => fake()->optional()->dateTimeBetween('now', '+2 years')->format('Y-m-d'),
            'observaciones' => fake()->optional()->sentence(),
        ];
    }

    public function inoperativo(): static
    {
        return $this->state(fn(array $attrs) => [
            'condicion_uso' => 'inoperativo',
            'estado_fisico' => 'malo',
        ]);
    }

    public function dadoBaja(): static
    {
        return $this->state(fn(array $attrs) => [
            'condicion_uso' => 'dado_baja',
            'estado_fisico' => 'desincorporado',
        ]);
    }
}
