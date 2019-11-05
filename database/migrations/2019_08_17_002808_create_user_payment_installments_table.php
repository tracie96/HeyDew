<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPaymentInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_payment_installments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('userpayment_id');
            $table->double('amount');
            $table->longText('payment_object');
            $table->longText('payment_response')->nullable();
            $table->text('gateway');
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
        Schema::dropIfExists('user_payment_installments');
    }
}
