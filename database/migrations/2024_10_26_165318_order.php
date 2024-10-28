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
        $table->id();
        $table->enum('state',['pendant', 'in_progress', 'complete', 'canceled']);
        $table->float('total');
        $table->string('shipping_address');
        $table->date('order_date');
        $table->date('delivery_date');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExist('order');
    }
};
