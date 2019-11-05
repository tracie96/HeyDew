<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotographersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photographers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unique();
            $table->boolean('verified')->default(false);
            $table->boolean('archived')->default(false);
            $table->mediumText('about_us')->nullable();

//            $table->text('category')->unique();
//            $table->text('photography_type')->unique();

            $table->text('region')->nullable();
            $table->text('business_name')->nullable();
            $table->text('bvn')->nullable();
            $table->text('bvn_meta')->nullable();
            $table->boolean('bvn_verified')->default(false);
            $table->text('id_card')->nullable();
            $table->boolean('id_card_verified')->default(false);

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
        Schema::dropIfExists('photographers');
    }
}
