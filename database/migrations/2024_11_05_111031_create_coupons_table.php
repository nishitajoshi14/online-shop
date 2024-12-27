<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_code')->unique();
            $table->enum('coupon_type', ['percentage', 'fixed']);
            $table->decimal('value', 8, 2);
            $table->decimal('cart_value', 8, 2);
            $table->date('expiry_date');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
