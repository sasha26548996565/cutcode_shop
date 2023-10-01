<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Promocode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromocodeSeeder extends Seeder
{
    public function run(): void
    {
        Promocode::factory(10)->create();
    }
}
