<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_list', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('name');
            $table->string('type');
            $table->string('department');
            $table->string('contact');
            $table->string('fee');
            $table->string('prize');
            $table->longText('about');
            $table->integer('seats');
            $table->boolean('open')->default(1);
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
        Schema::dropIfExists('events_list');
    }
}
