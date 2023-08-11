<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $filename = uniqid('thumbnail_', true) . '.jpg';

        $image = $this->faker->image(null, 50, 50);
        Storage::disk('public')->put($filename, file_get_contents($image));
        return [
            'title' => $this->faker->company(),
            'price' => $this->faker->numberBetween(10000, 10000000),
            'brand_id' => Brand::get()->random()->id,
            'thumbnail' => $filename,
        ];
    }
}
