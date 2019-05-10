<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('title');
            $table->unsignedInteger('score');
            $table->unsignedInteger('viewCount');
            $table->longText('body');
            $table->json('tags')->default("[]");
            $table->boolean('accepted')->default(false);
            $table->unsignedInteger('parent_post_id');

            $table->foreign('parent_post_id')->references('id')->on('posts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
