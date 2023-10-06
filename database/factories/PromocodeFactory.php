<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PromocodeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'discount' => $this->faker->numberBetween(1, 50),
        ];
    }
}
