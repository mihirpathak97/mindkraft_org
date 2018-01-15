<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnduserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enduser_details', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('api_token')->unique();
            $table->integer('visit_count')->default(0);
            $table->boolean('allow_sponsor_promo')->default(false);
            $table->timestamp('date_modified');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enduser_details');
    }
}
