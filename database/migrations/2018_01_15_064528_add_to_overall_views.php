<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToOverallViews extends Migration
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
      DB::statement("create view $view_prefix"."enduser_details as select * from $table_prefix"."enduser_details");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      $view_prefix = env('DB_VIEW_PREFIX', '');
      DB::statement("drop view $view_prefix"."enduser_details");
    }
}
