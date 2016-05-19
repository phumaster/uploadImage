<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image_name');
            $table->string('image_url');
            $table->string('image_size');
            $table->text('image_caption');
            $table->text('likes')->nullable();
            $table->integer('views')->nullable()->default(0);
            $table->integer('user_id');
            $table->integer('album_id');
            $table->integer('make_as_profile_picture')->default(0);
            $table->integer('make_as_cover_photo')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('images');
    }
}
