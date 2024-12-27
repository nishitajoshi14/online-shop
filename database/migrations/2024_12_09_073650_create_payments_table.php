<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
{
    Schema::create('payments', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->string('payment_id')->unique();
        $table->decimal('amount', 10, 2);
        $table->string('status')->default('pending'); // e.g., succeeded, failed
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
