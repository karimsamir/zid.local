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
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('email', 100)->unique();
            $table->string('password', 150);
            $table->string('store_name', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('merchants');
    }
};
