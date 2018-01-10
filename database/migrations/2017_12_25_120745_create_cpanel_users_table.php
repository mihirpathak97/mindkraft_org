<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCpanelUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cpanel_users', function (Blueprint $table) {
            $table->string('username');
            $table->binary('password');
            $table->timestamp('timestamp');
        });
        DB::statement('insert into mindkraft18_admin_user (username, password) values (\'mihir\', password(\'ur15cs104\'))');
        DB::statement('insert into mindkraft18_admin_user (username, password) values (\'dalbut\', password(\'ur15mt058\'))');
        DB::statement('insert into mindkraft18_admin_user (username, password) values (\'vedha\', password(\'ur16mt019\'))');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cpanel_users');
    }
}
