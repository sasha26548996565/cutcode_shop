<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\Option;
use App\Models\OptionValue;
use App\Models\Property;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $properties = Property::all();
        $options = Option::all();
        $optionValues = OptionValue::all();

        Category::factory(20)
            ->has(
                Product::factory(random_int(1, 3))->hasAttached($properties, function () {
                    return [
                        'value' => ucfirst(fake()->word())
                    ];
                })
                ->hasAttached($optionValues)
            )->hasAttached($options)
        ->create();
    }
}
