<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderIdToCartItemsTable extends Migration
{
    public function up()
    {
        // Adding the 'order_id' column to 'cart_items' table
        Schema::table('cart_items', function (Blueprint $table) {
            $table->foreignId('order_id')->nullable()->constrained('orders')->onDelete('cascade');
        });
    }

    public function down()
    {
        // Dropping the 'order_id' column
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropColumn('order_id');
        });
    }
}
