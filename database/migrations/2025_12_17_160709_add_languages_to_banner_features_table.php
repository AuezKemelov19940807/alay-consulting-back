<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('banner_features', function (Blueprint $table) {
            $table->string('text_kk')->nullable()->after('text');
            $table->string('text_en')->nullable()->after('text_kk');
        });
    }

    public function down(): void
    {
        Schema::table('banner_features', function (Blueprint $table) {
            $table->dropColumn(['text_kk', 'text_en']);
        });
    }
};
