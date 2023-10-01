<?php

use App\CustomMigrations\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends BaseMigration
{
    public function up(): void
    {
        Schema::create('promocodes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('discount')->max(10);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $this->tryDropTable('promocodes');
    }
};
