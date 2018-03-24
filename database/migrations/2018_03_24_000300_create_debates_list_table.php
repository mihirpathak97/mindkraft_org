<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDebatesListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debates_list', function (Blueprint $table) {
          $table->string('id')->unique();
          $table->string('name');
          $table->string('department');
          $table->mediumText('incharge_faculty');
          $table->mediumText('incharge_student');
          $table->longText('rules');
          $table->longText('about');
          $table->integer('seats');
          $table->boolean('open')->default(1);
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
        Schema::dropIfExists('debates_list');
    }
}
