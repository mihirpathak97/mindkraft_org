<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsFeedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_feed', function (Blueprint $table) {
            $table->string('message');
        });

        DB::statement('insert into mindkraft18_news_feed (message) values (\'Registrations Open!!\')');
        DB::statement('insert into mindkraft18_news_feed (message) values (\'Click <a href="/accomodation">here</a> for accomodation details!\')');


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_feed');
    }
}
