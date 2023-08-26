<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Option;
use App\Models\OptionValue;
use App\Models\Property;
use Database\Migrations\BaseMigration;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Brand::factory(20)->create();
        $properties = Property::factory(50)->create();
        Option::factory(2)->create();
        $optionValues = OptionValue::factory(10)->create();
        Category::factory(20)
            ->has(
                Product::factory(random_int(1, 3))->hasAttached($properties, function () {
                    return ['value' => ucfirst(fake()->word())];
                })
                ->hasAttached($optionValues)
            )
            ->create();
    }
}
