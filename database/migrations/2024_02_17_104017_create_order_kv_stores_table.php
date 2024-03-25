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
        Schema::create('order_kv_stores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('kv_quantity')->nullable();
            $table->string('kv_store')->nullable();
            $table->string('kv_month_day')->nullable();
            $table->decimal('kv_store_price')->nullable();
            $table->integer('kv_day_quantity')->nullable();
            $table->decimal('kv_store_total')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_kv_stores');
    }
};
