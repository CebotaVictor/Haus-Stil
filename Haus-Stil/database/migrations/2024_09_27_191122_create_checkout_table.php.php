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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('country');
            $table->string('address');
            $table->integer('postal_number');
            $table->string('city');
            $table->string('phone');
            $table->string('email');
            $table->string('card_number');
            $table->string('card_name');
            $table->string('expire_date');
            $table->integer('ccv');
            $table->string('total_price');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkout');
    }
};

