<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVotesToAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id');

            $table->text('titre');
            $table->text('video');

            $table->text('begin')->nullable();
            $table->text('end')->nullable();

            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies');


            $table->timestamps();
        });

        Schema::create('ad_bus', function (Blueprint $table) {
        
            $table->integer('ad_id')->unsigned();
            $table->foreign('ad_id')->references('id')->on('ads');

            $table->integer('bus_id')->unsigned();
            $table->foreign('bus_id')->references('id')->on('buses');

        });

         Schema::table('users', function (Blueprint $table) {
        
           $table->integer('company_id')->unsigned()->nullable();
           $table->foreign('company_id')->references('id')->on('companies');

        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
        Schema::dropIfExists('ad_bus');
    }
}
