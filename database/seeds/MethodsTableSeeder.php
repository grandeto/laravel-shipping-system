<?php

use Illuminate\Database\Seeder;

class MethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('methods')->delete();

        $methods = array(
            array('name' => 'UPS Air'),
            array('name' => 'UPS Ground'),
            array('name' => 'DHL Air'),
            array('name' => 'DHL Ground'),
            array('name' => 'FedEx Air'),
            array('name' => 'FedEx Ground'),
            array('name' => 'USPS Air'),
            array('name' => 'USPS Ground'),
        );

        DB::table('methods')->insert($methods);
    }
}
