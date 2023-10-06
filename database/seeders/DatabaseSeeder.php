<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(BrandSeeder::class);
        $this->call(PropertySeeder::class);
        $this->call(OptionSeeder::class);
        $this->call(OptionValueSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(PromocodeSeeder::class);
    }
}
