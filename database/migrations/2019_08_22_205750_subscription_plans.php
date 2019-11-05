<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SubscriptionPlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('SubscriptionPlans',function (Blueprint $table){
            $table->bigIncrements('id');
            $table->text('title');
            $table->text('details');
            $table->double('fee');
            $table->integer('duration');//days
            $table->boolean('is_recurring');
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
        //
    }
}
