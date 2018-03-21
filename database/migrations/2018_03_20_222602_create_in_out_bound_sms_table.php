<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInOutBoundSmsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('in_out_bound_sms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sent_from');
            $table->string('sent_to');
            $table->string('message');
            $table->boolean('is_outbound')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('in_out_bound_sms');
    }

}
