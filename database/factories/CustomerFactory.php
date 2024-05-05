<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'name' => $this->faker->name,
            'money' => $this->faker->randomNumber(2),
            'present' => $this->faker->numberBetween(0, 100) ,  // Divide by 100 to convert to decimal percentage
            'notes' => $this->faker->sentence(10),

        ];
    }
}
