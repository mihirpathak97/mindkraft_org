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
          $table->string('name');
          $table->string('id')->unique();
          $table->string('type');
          $table->string('deptartment');
          $table->string('contact');
          $table->string('fee');
          $table->string('prize');
          $table->longText('about');
          $table->longText('faq');
          $table->timestamp('timestamp');
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