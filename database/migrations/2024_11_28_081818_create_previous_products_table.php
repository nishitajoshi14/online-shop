<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreviousProductsTable extends Migration
{
    public function up()
    {
        Schema::create('previous_products', function (Blueprint $table) {
            $table->id();
            $table->string('username'); // Assuming username is unique for each user
            $table->string('product_name');
            $table->decimal('price', 10, 2);
            $table->integer('quantity');
            $table->string('image_url')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('previous_products');
    }
}
