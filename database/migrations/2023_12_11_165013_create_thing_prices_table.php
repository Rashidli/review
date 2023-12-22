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
        Schema::create('thing_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('thing_id');
            $table->unsignedBigInteger('thing_service_id');
            $table->decimal('min_price')->nullable();
            $table->decimal('max_price')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('thing_id')->references('id')->on('things')->onDelete('cascade');
            $table->foreign('thing_service_id')->references('id')->on('thing_services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thing_prices');
    }
};
