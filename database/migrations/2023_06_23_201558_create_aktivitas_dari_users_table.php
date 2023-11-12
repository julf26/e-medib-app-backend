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
        Schema::create('aktivitas_dari_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_nama_aktivitas');
            $table->text('nama_aktivitas');
            $table->string('met');
            $table->string('durasi')->nullable();
            $table->string('kalori')->nullable();
            $table->string('tingkat_aktivitas');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktivitas_dari_users');
    }
};
