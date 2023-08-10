<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Brand::factory(20)->create();

        Category::factory(20)
            ->has(Product::factory(random_int(1, 3)))
            ->create();
    }
}
