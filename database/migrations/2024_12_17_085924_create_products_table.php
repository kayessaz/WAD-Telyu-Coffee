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
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('category');  // Non-Coffee, Espresso Based, Manual Brew, Bottle 1L, Food
            $table->decimal('price', 8, 2)->nullable();  // Harga umum, bisa digunakan untuk kategori makanan
            $table->decimal('hot_price', 8, 2)->nullable();  // Harga untuk minuman panas
            $table->decimal('ice_price', 8, 2)->nullable();  // Harga untuk minuman dingin
            $table->string('image_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }

};
