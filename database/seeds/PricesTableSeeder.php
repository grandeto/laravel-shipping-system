<?php

use Illuminate\Database\Seeder;

class PricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prices')->delete();

        $prices = array(
            array('method_id' => 1, 'origin_country_id' => 1, 'destination_country_id' => 58, 'min_weight' => 10, 'max_weight' => 20, 'price' => 103.54),
            array('method_id' => 2, 'origin_country_id' => 1, 'destination_country_id' => 58, 'min_weight' => 10, 'max_weight' => 20, 'price' => 515),
            array('method_id' => 3, 'origin_country_id' => 1, 'destination_country_id' => 58, 'min_weight' => 10, 'max_weight' => 20, 'price' => 100),
            array('method_id' => 4, 'origin_country_id' => 1, 'destination_country_id' => 58, 'min_weight' => 10, 'max_weight' => 20, 'price' => 511.03),
            array('method_id' => 5, 'origin_country_id' => 1, 'destination_country_id' => 58, 'min_weight' => 10, 'max_weight' => 20, 'price' => 117),
            array('method_id' => 6, 'origin_country_id' => 1, 'destination_country_id' => 58, 'min_weight' => 10, 'max_weight' => 20, 'price' => 557.99),
            array('method_id' => 7, 'origin_country_id' => 1, 'destination_country_id' => 58, 'min_weight' => 10, 'max_weight' => 20, 'price' => 108.67),
            array('method_id' => 8, 'origin_country_id' => 1, 'destination_country_id' => 58, 'min_weight' => 10, 'max_weight' => 20, 'price' => 530),

            array('method_id' => 3, 'origin_country_id' => 58, 'destination_country_id' => 35, 'min_weight' => 5, 'max_weight' => 10, 'price' => 50),
            array('method_id' => 4, 'origin_country_id' => 58, 'destination_country_id' => 35, 'min_weight' => 5, 'max_weight' => 10, 'price' => 117.07),
        );

        DB::table('prices')->insert($prices);
    }
}
