<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->json('name');
            $table->text('biography');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('artist_file', function (Blueprint $table) {

            $table->bigInteger('artist_id')->unsigned();
            $table->foreign('artist_id')->references('id')->on('artists')->onDelete('cascade');

            $table->bigInteger('file_id')->unsigned();
            $table->foreign('file_id')->references('id')->on('image_files')->onDelete('cascade');

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artists');
        Schema::dropIfExists('artist_file');

    }
}
