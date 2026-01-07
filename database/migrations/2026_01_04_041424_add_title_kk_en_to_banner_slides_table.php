<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('banner_slides', function (Blueprint $table) {
            $table->string('title_kk')->nullable()->after('title');
            $table->string('title_en')->nullable()->after('title_kk');
        });
    }

    public function down(): void
    {
        Schema::table('banner_slides', function (Blueprint $table) {
            $table->dropColumn(['title_kk', 'title_en']);
        });
    }
};
