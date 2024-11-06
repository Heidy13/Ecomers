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
        Schema::create('cart_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('amount')->default(1); 
            $table->timestamp('date_added');
            $table->unsignedBigInteger('id_product');
            $table->foreign('id_product')->references('id')->on('product');
            $table->unsignedBigInteger('id_cart');
            $table->foreign('id_cart')->references('id')->on('cart');
            $table->index('id_cart');
            $table->index(['id_cart', 'id_product']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_detail');
    }
};
