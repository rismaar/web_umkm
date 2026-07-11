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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id('id_cartItem');
            $table->unsignedBigInteger('id_cart');
            $table->foreign('id_cart')->references('id_cart')->on('carts')->cascadeOnDelete();
            $table->string('id_product');
            $table->foreign('id_product')->references('id_product')->on('products')->cascadeOnDelete();
            $table->integer('qty');
            $table->string('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
