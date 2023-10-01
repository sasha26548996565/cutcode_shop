<?php

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Schema;
use App\CustomMigrations\BaseMigration;
use Illuminate\Database\Schema\Blueprint;

return new class extends BaseMigration
{
    public function up(): void
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->integer('count');
            $table->json('optionValueIds');
            $table->foreignIdFor(Product::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignIdFor(Order::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_products');
    }
};
