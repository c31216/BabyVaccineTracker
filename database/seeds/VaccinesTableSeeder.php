<?php

use Illuminate\Database\Seeder;

class VaccinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vaccines')->delete();

        $vaccines = [
        				['vaccine_name' => 'BCG','vaccine_part' => '1'],
        				['vaccine_name' => 'Hepa B1 w/in 24 hours ','vaccine_part' => '1'],
        				['vaccine_name' => 'Hepa B1 More than 24 hours','vaccine_part' => '1'],
        				['vaccine_name' => 'Pentavalent 1','vaccine_part' => '1'],
        				['vaccine_name' => 'Pentavalent 2','vaccine_part' => '1'],
        				['vaccine_name' => 'Pentavalent 3','vaccine_part' => '1'],
        				['vaccine_name' => 'Pentavalent 4','vaccine_part' => '1'],
        				['vaccine_name' => 'OPV 1','vaccine_part' => '1'],
        				['vaccine_name' => 'OPV 2','vaccine_part' => '1'],
        				['vaccine_name' => 'OPV 3','vaccine_part' => '1'],
        				['vaccine_name' => 'MVC 1','vaccine_part' => '1'],
        				['vaccine_name' => 'MVC 2','vaccine_part' => '1'],

        			];

        DB::table('vaccines')->insert($vaccines);
    }
}
