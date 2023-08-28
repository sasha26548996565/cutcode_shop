<?php

use App\CustomMigrations\BaseMigration;
use App\Models\Category;
use App\Models\Option;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends BaseMigration
{
    public function up(): void
    {
        Schema::create('option_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Option::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignIdFor(Category::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        $this->tryDropTable('option_categories');
    }
};
