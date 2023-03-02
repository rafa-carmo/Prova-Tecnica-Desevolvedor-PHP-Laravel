<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'cpf'=> $this->faker->regexify('[0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[\-]?[0-9]{2}'),
            'email'=> $this->faker->unique()->safeEmail(),
            'birth_date' => $this->faker->dateTimeInInterval('-20 years'),
            'nationality' => $this->faker->country()
        ];
    }
}
