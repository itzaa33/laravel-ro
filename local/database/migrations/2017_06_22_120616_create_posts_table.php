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
          $table->integer('upgrade');
          $table->string('image')->nullable();
          $table->integer('currency');
          $table->integer('status_post');
          $table->integer('price');
          $table->string('description')->nullable();

          $table->integer('id_user')->unsigned();
          $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

          $table->integer('id_product')->unsigned();
          $table->foreign('id_product')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');

          $table->timestamps();
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
