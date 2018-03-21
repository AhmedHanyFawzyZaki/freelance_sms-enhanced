<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetNumbersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('target_numbers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('target_number');
            $table->boolean('has_queue')->default(0);
            $table->boolean('is_suspended')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('target_numbers');
    }

}
