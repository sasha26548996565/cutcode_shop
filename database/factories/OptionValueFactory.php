<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Option;
use Illuminate\Database\Eloquent\Factories\Factory;

class OptionValueFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => ucfirst($this->faker->word),
            'option_id' => Option::get()->random()->id,
        ];
    }
}
