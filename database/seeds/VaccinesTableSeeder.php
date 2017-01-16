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
        				['name' => 'BCG','part' => '1'],
        				['name' => 'Hepa B1 w/in 24 hours ','part' => '1'],
        				['name' => 'Hepa B1 More than 24 hours','part' => '1'],
        				['name' => 'Pentavalent 1','part' => '1'],
        				['name' => 'Pentavalent 2','part' => '1'],
        				['name' => 'Pentavalent 3','part' => '1'],
        				['name' => 'Pentavalent 4','part' => '1'],
        				['name' => 'OPV 1','part' => '1'],
        				['name' => 'OPV 2','part' => '1'],
        				['name' => 'OPV 3','part' => '1'],
        				['name' => 'MVC 1','part' => '1'],
        				['name' => 'MVC 2','part' => '1'],

        			];

        DB::table('vaccines')->insert($vaccines);
    }
}
