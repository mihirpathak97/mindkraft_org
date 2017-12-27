<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOverallViews extends Migration
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
        DB::statement("create view $view_prefix"."enduser as select * from $table_prefix"."enduser");
        DB::statement("create view $view_prefix"."cpanel_users as select * from $table_prefix"."enduser");
        DB::statement("create view $view_prefix"."events_list as select * from $table_prefix"."events_list");
        DB::statement("create view $view_prefix"."games_list as select * from $table_prefix"."games_list");
        DB::statement("create view $view_prefix"."workshops_list as select * from $table_prefix"."workshops_list");
        DB::statement("create view $view_prefix"."event_registration as select * from $table_prefix"."event_registration");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      $view_prefix = env('DB_VIEW_PREFIX', '');
      DB::statement("drop view $view_prefix"."enduser");
      DB::statement("drop view $view_prefix"."cpanel_users");
      DB::statement("drop view $view_prefix"."events_list");
      DB::statement("drop view $view_prefix"."games_list");
      DB::statement("drop view $view_prefix"."workshops_list");
      DB::statement("drop view $view_prefix"."event_registration");
    }
}
