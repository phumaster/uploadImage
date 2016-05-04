<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_albums', function (Blueprint $table) {
            $table->increments('id');
            $table->text('comment_content');
            $table->integer('likes')->nullable()->default(0);
            $table->string('comment_status');
            $table->integer('user_id');
            $table->integer('album_id');
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
        Schema::drop('comment_albums');
    }
}
