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
        Schema::create('keluhan', function (Blueprint $table) {
            $table->uuid('id_keluhan')->primary();
            $table->uuid('id_petani');
            $table->text('teks_keluhan');
            $table->string('tingkat_urgensi')->nullable();
            $table->text('hasil_analisis')->nullable();
            $table->dateTime('tanggal');                  
            $table->string('status')->default('selesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluhan');
    }
};
