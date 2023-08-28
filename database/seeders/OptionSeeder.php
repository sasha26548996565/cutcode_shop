<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    public function run(): void
    {
        Option::factory(2)->create();
    }
}
