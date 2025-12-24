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
        Schema::create('accounting_consultations', function (Blueprint $table) {
            $table->id();

            // Заголовки
            $table->string('title');
            $table->string('title_kk')->nullable();
            $table->string('title_en')->nullable();

            // Описание
            $table->text('description')->nullable();
            $table->text('description_kk')->nullable();
            $table->text('description_en')->nullable();

            // Кнопка
            $table->string('button_text')->nullable();
            $table->string('button_text_kk')->nullable();
            $table->string('button_text_en')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounting_consultations');
    }
};
