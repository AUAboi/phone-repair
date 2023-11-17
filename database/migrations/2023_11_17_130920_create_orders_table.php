<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('order_no')->nullable()->unique();
            $table->string('email');
            $table->string('phone');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('zip_code');
            $table->string('city');
            $table->string('address');
            $table->bigInteger('total');
            $table->enum('order_status', ['preparing', 'in-transit', 'delivered', 'cancelled'])->default('preparing');
            $table->enum('payment_status', ['pending', 'paid', 'cancelled'])->default('pending');
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
        Schema::dropIfExists('orders');
    }
};
