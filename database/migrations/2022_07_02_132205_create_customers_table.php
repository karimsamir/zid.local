<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            // $table->integer('cart_id');

            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->string('password', 150);

            $table->timestamps();

            // $table->foreign('cart_id')->references('id')->on('carts');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('customers');
    }
};
