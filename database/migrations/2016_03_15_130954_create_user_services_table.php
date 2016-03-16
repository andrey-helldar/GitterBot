<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_services', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->index();
            
            $table->string('name');
            $table->string('user_service_login');
            $table->string('user_service_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_services');
    }
}
