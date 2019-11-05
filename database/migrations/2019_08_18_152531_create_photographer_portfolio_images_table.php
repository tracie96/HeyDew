<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotographerPortfolioImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photographer_portfolio_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('photographer_id');
            $table->text('photographer_portfolio_category_key');
            $table->mediumText('image_url');
            $table->boolean('is_active');
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
        Schema::dropIfExists('photographer_portfolio_images');
    }
}
