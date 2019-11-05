<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PhotographerCardDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('photographer_card_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('photographer_id');
            $table->text('first_name');
            $table->text('last_name');
            $table->text('card_number');
            $table->text('mmyy');
            $table->text('cvv');
            $table->boolean('auto_charge');
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
