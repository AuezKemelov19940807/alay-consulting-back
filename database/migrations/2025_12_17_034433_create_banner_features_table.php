<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('banner_features', function (Blueprint $table) {
            $table->id();

            $table->foreignId('banner_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('icon');   // check, document, phone
            $table->string('text');   // Сдаём отчётность вовремя

            $table->integer('sort_order')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banner_features');
    }
};
