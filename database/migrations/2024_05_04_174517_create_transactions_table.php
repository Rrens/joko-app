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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('productID')->nullable();
            $table->foreign('productID')->references('id')->on('products');
            $table->unsignedBigInteger('platformID')->nullable();
            $table->foreign('platformID')->references('id')->on('platforms');
            $table->unsignedBigInteger('userID')->nullable();
            $table->foreign('userID')->references('id')->on('users');
            $table->double('quantity');
            $table->double('total_price');
            $table->string('name_customer')->nullable();
            $table->string('acc_number')->nullable();
            $table->string('area')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
