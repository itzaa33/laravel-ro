<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryBanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_bans', function (Blueprint $table) {

          $table->increments('id');

          $table->integer('id_user')->unsigned();
          $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

          $table->integer('id_admin')->unsigned();
          $table->foreign('id_admin')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
          // $table->string('name_admin')->nullable();
          // $table->string('rank_admin')->nullable();
          $table->integer('description')->nullable();
          $table->boolean('command');

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
        Schema::dropIfExists('history_bans');
    }
}
