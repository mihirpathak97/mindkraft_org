<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnduserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enduser', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('name');
            $table->string('mobile')->unique();
            $table->string('email')->unique();
            $table->string('college');
            $table->string('register_number')->default('N/A');
            $table->binary('password');
            $table->string('api_token')->unique();
            $table->boolean('is_verified')->default(false);
            $table->boolean('allow_sponsor_promo')->default(false);
            $table->integer('visit_count')->default(0);
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
        Schema::dropIfExists('enduser');
    }
}
