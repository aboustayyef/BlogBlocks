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

            // This info is redundant, and exists in table 
            // scores. The reason we're doing this is because we want to  
            // query posts and sort them by score. Much less complex way

            $table->decimal('latest_score')->nullable();
            $table->decimal('best_score')->nullable();

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
