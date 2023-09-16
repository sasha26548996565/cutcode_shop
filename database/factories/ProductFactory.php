<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->company(),
            'price' => $this->faker->numberBetween(10000, 10000000),
            'count' => $this->faker->numberBetween(1, 20),
            'text' => $this->faker->realText(),
            'brand_id' => Brand::get()->random()->id,
            'group_id' => Group::get()->random()->id,
            'thumbnail' => $this->faker->image('storage/app/public', 100, 100, null, false),
        ];
    }
}
