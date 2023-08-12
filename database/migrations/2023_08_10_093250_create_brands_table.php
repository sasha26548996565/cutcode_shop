<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('thumbnail');
            $table->boolean('on_index_page')->default(false);
            $table->integer('sorting')->default(999);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        if (app()->isLocal())
        {
            Schema::dropIfExists('brands');
        }
    }
};
