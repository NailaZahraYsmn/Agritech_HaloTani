<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('keluhan', function (Blueprint $table) {
            $table->string('jenis_tanaman', 100)->nullable()->after('id_petani');
            $table->string('tingkat_urgensi', 50)->default('Sedang')->after('jenis_tanaman');
        });
    }

    public function down(): void
    {
        Schema::table('keluhan', function (Blueprint $table) {
            $table->dropColumn(['jenis_tanaman', 'tingkat_urgensi']);
        });
    }
};