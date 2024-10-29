<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('slug', 100)->unique();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->string('short_description', 100)->nullable();
            $table->text('description')->nullable();
            $table->string('image'); // Main product image
            $table->decimal('regular_price', 8, 2);
            $table->decimal('sale_price', 8, 2);
            $table->string('sku', 100);
            $table->integer('quantity');
            $table->boolean('in_stock')->default(1);
            $table->boolean('featured')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
