<?php

namespace Database\Factories;
use App\Models\Paralelo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paralelo>
 */
class ParaleloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Paralelo::class;
    public function definition(): array
    {
        [
            'nombre' => 'Paralelo' . $this->unique()->numberBetween(1, 99),
        ];
    }
}
