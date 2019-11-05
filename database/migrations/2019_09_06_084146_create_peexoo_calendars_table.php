<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeexooCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *bul
     * @return void
     */
    public function up()
    {
        Schema::create('peexoo_calendars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->dateTime("start_date");
            $table->dateTime("end_date");
            $table->text('description');
            $table->text('parent_object')->nullable();
            $table->bigInteger('parent_object_id')->nullable();
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
        Schema::dropIfExists('peexoo_calendars');
    }
}
