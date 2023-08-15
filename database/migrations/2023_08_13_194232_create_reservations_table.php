<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('schedule_id')->constrained();
            $table->foreignId('sheet_id')->constrained();
            $table->string('email',255);
            $table->string('name',255);
            $table->boolean('is_canceled')->default(false);
            $table->timestamps();
            $table->index(['schedule_id','sheet_id']);
            $table->unique(['schedule_id','sheet_id']);
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
