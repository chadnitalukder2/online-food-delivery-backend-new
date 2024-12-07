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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('restaurant_id');
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('total_amount');
            $table->string('status')->default('pending');
            $table->string('payment_status')->default('unpaid');
            $table->string('delivery_address');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->timestamps();

            //Indexes
            $table->index(['user_id', 'total_amount']);
            $table->index(['user_id', 'status']);
            $table->index(['user_id', 'payment_status']);
            $table->index(['user_id', 'delivery_address']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
