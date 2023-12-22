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
        Schema::create('transport_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transport_id');
            $table->unsignedBigInteger('transport_warehouse_id');
            $table->decimal('monthly_price')->nullable();
            $table->decimal('daily_price')->nullable();


            $table->foreign('transport_id')->references('id')->on('transports')->onDelete('cascade');
            $table->foreign('transport_warehouse_id')->references('id')->on('transport_warehouses')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transport_prices');
    }
};
