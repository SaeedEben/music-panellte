<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->json('name');
            $table->timestamp('release_at');
            $table->integer('number_of_track');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('album_file', function (Blueprint $table) {

            $table->bigInteger('album_id')->unsigned();
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');

            $table->bigInteger('file_id')->unsigned();
            $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('albums');
        Schema::dropIfExists('album_file');
    }
}
