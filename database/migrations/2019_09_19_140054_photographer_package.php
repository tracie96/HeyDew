<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PhotographerPackage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create("photographer_packages",function (Blueprint $table){
//            'photographerId','title','bookingTypeId','bookingPrice','is_active'
            $table->bigIncrements('id');
            $table->bigInteger("photographerId");
            $table->text("title");
            $table->bigInteger("bookingTypeId");
            $table->double("bookingPrice");
            $table->boolean("is_active");
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
