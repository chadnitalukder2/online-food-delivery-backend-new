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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->unsignedBigInteger('delivery_personnel_id');
            $table->foreign('delivery_personnel_id')->references('id')->on('delivery_personnels')->onDelete('cascade');
            $table->string('estimated_time')->index();
            $table->string('status')->index();
            $table->timestamps();

             //Indexes
             $table->index(['order_id', 'estimated_time']);
             $table->index(['order_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
