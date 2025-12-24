<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->string('title_kk')->nullable()->after('title');
            $table->string('title_en')->nullable()->after('title_kk');

            $table->text('description_kk')->nullable()->after('description');
            $table->text('description_en')->nullable()->after('description_kk');

            $table->string('button_text_kk')->nullable()->after('button_text');
            $table->string('button_text_en')->nullable()->after('button_text_kk');
        });
    }

    public function down(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn([
                'title_kk', 'title_en',
                'description_kk', 'description_en',
                'button_text_kk', 'button_text_en',
            ]);
        });
    }
};
