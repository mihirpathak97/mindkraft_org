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
        DB::statement("create view $view_prefix"."enduser_details as select * from $table_prefix"."enduser_details");
        DB::statement("create view $view_prefix"."enduser_id as select * from $table_prefix"."enduser_id");
        DB::statement("create view $view_prefix"."events_list as select * from $table_prefix"."events_list");
        DB::statement("create view $view_prefix"."debates_list as select * from $table_prefix"."debates_list");
        DB::statement("create view $view_prefix"."games_list as select * from $table_prefix"."games_list");
        DB::statement("create view $view_prefix"."workshops_list as select * from $table_prefix"."workshops_list");
        DB::statement("create view $view_prefix"."event_registration as select * from $table_prefix"."event_registration");
        DB::statement("create view $view_prefix"."accomodation_registration as select * from $table_prefix"."accomodation_registration");
        DB::statement("create view $view_prefix"."payment_information as select * from $table_prefix"."payment_information");
        DB::statement("create view $view_prefix"."receipt_details as select * from $table_prefix"."receipt_details");
        DB::statement("create view $view_prefix"."cpanel_users as select * from $table_prefix"."cpanel_users");
        DB::statement("create view $view_prefix"."cpanel_mapping as select * from $table_prefix"."cpanel_mapping");
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
      DB::statement("drop view $view_prefix"."enduser_details");
      DB::statement("drop view $view_prefix"."enduser_id");
      DB::statement("drop view $view_prefix"."events_list");
      DB::statement("drop view $view_prefix"."debates_list");
      DB::statement("drop view $view_prefix"."games_list");
      DB::statement("drop view $view_prefix"."workshops_list");
      DB::statement("drop view $view_prefix"."event_registration");
      DB::statement("drop view $view_prefix"."accomodation_registration");
      DB::statement("drop view $view_prefix"."payment_information");
      DB::statement("drop view $view_prefix"."receipt_details");
      DB::statement("drop view $view_prefix"."cpanel_users");
      DB::statement("drop view $view_prefix"."cpanel_mapping");
    }
}
