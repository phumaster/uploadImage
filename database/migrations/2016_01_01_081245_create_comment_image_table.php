<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_images', function (Blueprint $table) {
            $table->increments('id');
            $table->text('comment_content');
            $table->text('likes')->nullable();
            $table->string('comment_status');
            $table->integer('user_id');
            $table->integer('image_id');
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
        Schema::drop('comment_images');
    }
}
