<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkshopsListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshops_list', function (Blueprint $table) {
          $table->string('id')->unique();
          $table->string('name');
          $table->string('department');
          $table->string('contact');
          $table->string('fee');
          $table->longText('about');
          $table->integet('seats');
          $table->boolean('open');
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
        Schema::dropIfExists('workshops_list');
    }
}
