<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTargetNumbersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('target_numbers', function (Blueprint $table) {
            $table->tinyInteger('send_type')->default(0);
            $table->string('message')->nullable();
            $table->unsignedInteger('schedule_id')->nullable();
            $table->foreign('schedule_id')->references('id')->on('schedule_lkp')->onDelete('cascade');
            $table->datetime('send_start_date')->nullable();
            $table->datetime('last_send_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('articles', function($table) {
             $table->dropColumn('send_type');
             $table->dropColumn('message');
             $table->dropColumn('send_start_date');
             $table->dropColumn('last_send_date');
             $table->dropForeign(['schedule_id']);
             $table->dropColumn('schedule_id');
          });
    }

}
