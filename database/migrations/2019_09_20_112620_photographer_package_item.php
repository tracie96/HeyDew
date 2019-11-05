<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PhotographerPackageItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create("photographer_package_items",function (Blueprint $table){
           $table->bigIncrements('id');
            $table->bigInteger("photographer_package_id");
            $table->text("title");
            $table->integer("quantity");
            $table->double("price");
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
