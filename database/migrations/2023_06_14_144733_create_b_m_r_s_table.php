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
        Schema::create('b_m_r_s', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_kelamin', 2);
            $table->string('berat_badan');
            $table->string('tinggi_badan');
            $table->string('usia');
            $table->string('bmr');
            $table->string('status');

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
        Schema::dropIfExists('b_m_r_s');
    }
};
