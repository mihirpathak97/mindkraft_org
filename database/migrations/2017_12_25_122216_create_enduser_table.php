<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnduserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enduser', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('name');
            $table->string('mobile')->unique();
            $table->string('email')->unique();
            $table->string('college');
            $table->binary('password');
            $table->boolean('is_verified');
            $table->boolean('allow_sponsor_promo');
            $table->integer('visit_count');
            $table->timestamp('date_created');
            $table->timestamp('last_visited');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enduser');
    }
}
