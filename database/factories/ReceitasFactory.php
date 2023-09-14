<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Receitas>
 */
class ReceitasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'descricao' => fake()->paragraph,
            'valor' => fake()->numberBetween(1.000, 2.000),
            'data' => fake()->date()
        ];
    }
}