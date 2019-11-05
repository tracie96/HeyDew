<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Booking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Due to the flexible architecture of this table and unreliability of required columns, We'll be using the 3rd nominal form.
        // Most of the information is fetched from other tables, but we'll use only replicate the values, not the id's
        Schema::create('bookings',function (Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->bigInteger('photographer_id');
            $table->bigInteger('booking_category_id');
            $table->text('title')->nullable();
            $table->mediumText('extra_message')->nullable();
            $table->text('country');
            $table->text('state');
            $table->text('address1');
            $table->text('address2');
            $table->text('type');
            $table->dateTime('shoot_start_date')->useCurrent();
            $table->dateTime('shoot_end_date');
            $table->dateTime('delivery_date'); //if not included, use shoot_end_date
            $table->enum('status',['ONGOING', 'PENDING', 'CANCELLED', 'COMPLETED']);
            $table->longText('review')->nullable();
            $table->dateTime('review_date')->nullable();
            $table->integer('rating')->nullable();
            $table->text('package_name');
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
