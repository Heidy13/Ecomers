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
        Schema::create('exchange', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user_applicant');
            $table->foreign('id_user_applicant')->references('id')->on('users');
            $table->unsignedBigInteger('id_user_receiver');
            $table->foreign('id_user_receiver')->references('id')->on('users');
            $table->unsignedBigInteger('id_ability_requested');
            $table->foreign('id_ability_requested')->references('id')->on('ability');
            $table->unsignedBigInteger('id_ability_offered');
            $table->foreign('id_ability_offered')->references('id')->on('ability');
            $table->enum('state',['earring','accepted','refused','filled']);
            $table->timestamp('date_filled')->nullable(); //toca arreglarlo porque no debe ir nulo
            $table->timestamp('date_answer')->nullable(); //toca arreglarlo porque no debe ir nulo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchange');
    }
};
