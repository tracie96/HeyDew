<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotographerBankAccountDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photographer_bank_account_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('photographer_id');
            $table->text('first_name');
            $table->text('last_name');
            $table->text('bank_name');
            $table->text('account_number');
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
        Schema::dropIfExists('photographer_bank_account_details');
    }
}
