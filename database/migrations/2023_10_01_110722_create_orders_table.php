<?php

use App\CustomMigrations\BaseMigration;
use App\Models\Promocode;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends BaseMigration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastName');
            $table->string('phone');
            $table->string('email');
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->boolean('pickup')->default(false);
            $table->integer('totalPrice');
            $table->string('paymentMethod');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
