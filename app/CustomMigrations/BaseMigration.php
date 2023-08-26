<?php

declare(strict_types=1);

namespace App\CustomMigrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class BaseMigration extends Migration
{
    public function tryDropTable(string $tableName): void
    {
        if (app()->isProduction())
        {
            throw new \Exception('Invalid operation');
        }

        Schema::dropIfExists($tableName);
    }
}
