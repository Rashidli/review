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
        if(!Schema::hasTable('plan_prices')){
            Schema::create('plan_prices', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('plan_warehouse_id');
                $table->unsignedBigInteger('plan_id');
                $table->decimal('monthly_price')->nullable();
                $table->decimal('daily_price')->nullable();
                $table->boolean('monthly_price_per_square_meter')->default(false);
                $table->boolean('daily_price_per_square_meter')->default(false);

                $table->foreign('plan_warehouse_id')->references('id')->on('plan_warehouses')->onDelete('cascade');
                $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_prices');
    }
};
