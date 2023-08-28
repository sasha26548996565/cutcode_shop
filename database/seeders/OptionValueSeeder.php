<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\OptionValue;
use Illuminate\Database\Seeder;

class OptionValueSeeder extends Seeder
{
    public function run(): void
    {
        OptionValue::factory(10)->create();
    }
}
