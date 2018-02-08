<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeContactsType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('events_list', function (Blueprint $table) {
          $table->longText('contact')->change();
      });
      Schema::table('games_list', function (Blueprint $table) {
          $table->longText('contact')->change();
      });
      Schema::table('workshops_list', function (Blueprint $table) {
          $table->longText('contact')->change();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
