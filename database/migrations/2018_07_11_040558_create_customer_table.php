<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer',function(Blueprint $table){
            $table->increments('id');
            $table->string('username',191)->unique();
            $table->string('fullname');
            $table->string('email');
            $table->string('password',60);
            $table->string('sex',20);
            $table->string('mobile',60);
            $table->string('address');
            $table->integer('province_id')->unsigned();
            $table->foreign('province_id')->references('id')->on('province')->onDelete('cascade');
            $table->string('avatar');
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
        Schema::drop('customer');
    }
}
