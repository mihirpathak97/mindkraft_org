<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOverallViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      $view_prefix = env('DB_VIEW_PREFIX', '');
      $table_prefix = env('DB_TABLE_PREFIX', '');
      DB::statement("create view $view_prefix"."news_feed as select * from $table_prefix"."news_feed");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      $view_prefix = env('DB_VIEW_PREFIX', '');
      DB::statement("drop view $view_prefix"."news_feed");
    }
}
