<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('fullName');
            $table->string('phoneNumber');
            $table->string('pincode');
            $table->string('state');
            $table->string('city');
            $table->string('address1');
            $table->string('address2');
            $table->string('landmark')->nullable();
            $table->decimal('subtotal', 8, 2);
            $table->decimal('discount', 8, 2)->nullable();
            $table->decimal('vat', 8, 2)->nullable();
            $table->decimal('total', 8, 2);
            $table->string('paymentMethod');
            $table->string('order_status')->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
