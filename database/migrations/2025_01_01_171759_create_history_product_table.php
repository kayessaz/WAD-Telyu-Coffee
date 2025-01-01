<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('history_id')->constrained()->onDelete('cascade'); // foreign key to history table
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // foreign key to product table
            $table->integer('quantity')->default(1); // optional, if you want to track quantity
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_product');
    }
}
