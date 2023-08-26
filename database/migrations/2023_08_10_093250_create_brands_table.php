<?php

use App\CustomMigrations\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends BaseMigration
{
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('thumbnail');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $this->tryDropTable('brands');
    }
};
