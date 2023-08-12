<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')->constrained();
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
            $table->index('movie_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign(['movie_id']);
        $table->dropIndex(['movie_id']);
        Schema::dropIfExists('schedules');
    }
}
