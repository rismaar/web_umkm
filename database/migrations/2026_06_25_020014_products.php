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
        Schema::create('products', function (Blueprint $table) {
            $table->string('id_product')->primary();
            $table->string('name_product');
            $table->string('id_category');
            $table->foreign('id_category')->references('id_category')->on('product_categories');
            $table->integer('price_product');
            $table->integer('stock_product');
            $table->string('image_product');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
