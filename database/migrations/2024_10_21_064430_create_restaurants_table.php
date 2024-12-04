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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->integer('owner_id');
            $table->string('name');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('address');
            $table->string('status')->nullable();
            $table->string('delivery_fee')->nullable();
            $table->string('delivery_time')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('bg_image')->nullable();
            $table->timestamps();

            //Indexes
            $table->index(['name']);
            $table->index([ 'address']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
