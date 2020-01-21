<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('method_id');
            $table->unsignedInteger('origin_country_id');
            $table->unsignedInteger('destination_country_id');
            $table->unsignedInteger('min_weight')->nullable();
            $table->unsignedInteger('max_weight')->nullable();
            $table->unsignedDecimal('price', 8, 2)->default('0.00');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('method_id')->references('id')->on('methods')->onDelete('cascade');
            $table->foreign('origin_country_id')->references('id')->on('countries');
            $table->foreign('destination_country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prices');
    }
}
