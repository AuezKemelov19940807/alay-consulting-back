<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('footers', function (Blueprint $table) {
            $table->id();

            // Копирайт / текст
            $table->text('text')->nullable();
            $table->text('text_kk')->nullable();
            $table->text('text_en')->nullable();

            // Меню (массив ссылок)
            $table->json('menu')->nullable();

            // Соцсети (массив с иконкой и ссылкой)
            $table->json('socials')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('footers');
    }
};
