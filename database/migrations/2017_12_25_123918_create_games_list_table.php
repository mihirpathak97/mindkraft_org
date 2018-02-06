<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games_list', function (Blueprint $table) {
          $table->string('id')->unique();
          $table->string('name');
          $table->string('contact');
          $table->string('fee');
          $table->string('prize');
          $table->longText('rules');
          $table->longText('about');
          $table->integer('seats');
          $table->boolean('open')->default(1);
          $table->timestamp('date_created');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games_list');
    }
}
