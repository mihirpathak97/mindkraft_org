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
            $table->string('college')->default('Karunya Institute of Technology and Sciences, Coimbatore');
            $table->string('state')->default('Tamil Nadu');
            $table->string('city')->default('Coimbatore');
            $table->integer('year_of_study')->default(0);
            $table->string('field_of_study')->default('other');
            $table->integer('visit_count')->default(0);
            $table->string('mode_of_signup')->default('other');
            $table->boolean('allow_sponsor_promo')->default(false);
            $table->boolean('require_accomodaiton')->default(false);
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
        Schema::dropIfExists('enduser');
    }
}
