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
        Schema::create('user_record_data', function (Blueprint $table) {
            $table->id();
            $table->string('bmi')->nullable();
            $table->string('bmr')->nullable();
            $table->text('disease_history')->nullable();
            $table->text('alergic')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->string('blood_sugar_level')->nullable();
            $table->string('cholesterol')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_record_data');
    }
};
