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
        Schema::create('konsumsi_makanans', function (Blueprint $table) {
            $table->id();
            $table->text('makanan');
            $table->string('porsi');
            $table->string('kalori');
            $table->string('jenis_waktu_makan');
            $table->string('kadar_glukosa')->nullable();
            $table->string('kadar_karbohidrat')->nullable();
            $table->string('kadar_protein')->nullable();
            $table->text('kandungan_gizi_lainnya')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konsumsi_makanans');
    }
};
