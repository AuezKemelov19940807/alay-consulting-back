<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('operating_algorithms', function (Blueprint $table) {
            $table->id();

            // Картинка
            $table->string('image')->nullable();

            // Заголовок
            $table->string('title');
            $table->string('title_kk')->nullable();
            $table->string('title_en')->nullable();

            // Описание
            $table->text('description')->nullable();
            $table->text('description_kk')->nullable();
            $table->text('description_en')->nullable();

            /**
             * steps — JSON
             * [
             *   { order: 1, title, title_kk, title_en },
             *   ...
             * ]
             */
            $table->json('steps');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('operating_algorithms');
    }
};
