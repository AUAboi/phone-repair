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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('device_id')->nullable()->onUpdate('set null')->nullOnDelete();
            $table->string('device_name')->nullable();
            $table->foreignId('device_repair_id');
            $table->string('device_repair_title')->nullable();
            $table->bigInteger('device_repair_price')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('message')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->string('zip_code');
            $table->string('city');
            $table->string('address');
            $table->date('appointment_date');
            $table->time('appointment_time');
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
        Schema::dropIfExists('appointments');
    }
};
