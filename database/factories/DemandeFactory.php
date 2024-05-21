<?php

namespace Database\Factories;

use App\Models\praticien;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Demande>
 */
class DemandeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            'deadline' => $this->faker->date(),
            'delay' => $this->faker->boolean(),
            'type_id' => Type::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'praticien_id' => praticien::factory()->create()->id,
        ];
    }
}
