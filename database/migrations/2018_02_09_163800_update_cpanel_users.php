<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCpanelUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('cpanel_users', function (Blueprint $table) {
          $table->integer('access_level')->default('3');
      });
      DB::statement('update mindkraft18_cpanel_users set access_level=0 where username=\'mihir\'');
      // Create account for co-ordinator with access_level 1
      DB::statement('insert into mindkraft18_cpanel_users (username, password, access_level) values (\'jegathesan\', password(\'9092551032\'), 1)');
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
