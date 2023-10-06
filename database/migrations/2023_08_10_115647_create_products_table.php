<?php

use App\Models\Brand;
use App\CustomMigrations\BaseMigration;
use App\Models\Group;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends BaseMigration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->fullText();
            $table->string('slug')->unique();
            $table->string('thumbnail');
            $table->unsignedBigInteger('price');
            $table->integer('count');
            $table->text('text')->fullText();

            $table->foreignIdFor(Brand::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        $this->tryDropTable('products');
    }
};
