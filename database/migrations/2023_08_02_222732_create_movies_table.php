<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            // $table->unsignedBigInteger('id')->autoIncrement()->comment('ID');
            $table->id();
            $table->text('title')->comment('映画タイトル');
            $table->text('image_url')->comment('画像URL');
            $table->timestamps();
            // $table->timestamps('created_at')->comment('登録日時');
            // $table->timestamps('updated_at')->comment('更新日時');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
