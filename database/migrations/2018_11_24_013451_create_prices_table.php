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
            $table->unsignedInteger('method_id')->index();
            $table->unsignedInteger('origin_country_id')->index();
            $table->unsignedInteger('destination_country_id')->index();
            $table->unsignedInteger('min_weight')->index();
            $table->unsignedInteger('max_weight')->index();
            $table->unsignedDecimal('price', 8, 2)->index();
            $table->timestamps();
            $table->softDeletes();
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
