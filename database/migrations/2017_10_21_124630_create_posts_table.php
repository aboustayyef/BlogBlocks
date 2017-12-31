<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('url');
            $table->text('excerpt')->nullable();
            $table->dateTime('posted_at'); 
            $table->integer('source_id')->unsigned();
            $table->text('original_image')->nullabe();
            $table->string('uid')->unique();
            $table->timestamps();
            $table->foreign('source_id')->references('id')->on('sources')->onDelete('cascade');
        });
     
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
