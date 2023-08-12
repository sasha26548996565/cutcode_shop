<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $filename = uniqid('thumbnail_', true) . '.jpg';

        $image = $this->faker->image(null, 50, 50);
        Storage::disk('public')->put($filename, file_get_contents($image));
        return [
            'title' => $this->faker->company(),
            'thumbnail' => $filename,
            'on_index_page' => $this->faker->boolean(),
            'sorting' => $this->faker->numberBetween(1, 999),
        ];
    }
}
