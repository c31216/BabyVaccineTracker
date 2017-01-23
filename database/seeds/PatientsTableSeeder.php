<?php

use Illuminate\Database\Seeder;

class PatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patients')->delete();

        $patients = [
        				[
        				 'patient_uname' => 'cmeniano',
        				 'patient_pass' =>  Hash::make('123123'),
        				 'patient_fname' => 'Christian',
        				 'patient_lname' => 'Meniano',
        				 'patient_weight' => '2.7',
        				 'patient_height' => '46.3',
        				 'patient_age' => '0',
        				 'patient_sex' => 'M',
        				 'patient_mother_name' => 'Isabel Meniano',
                         'patient_father_name' => 'Random',
                         'patient_guardian_name' => 'Random',
                         'patient_headcircumference' => '32.1',
        				 'patient_address' => 'San Francisco',
                         'patient_phonenumber' => '639973401805',
        				 'patient_bdate' => '2016-12-06',
        				 'patient_registration_date' => '2017-01-27'
        				],
        				[
        				 'patient_uname' => 'pcalma',
        				 'patient_pass' =>  Hash::make('123123'),
        				 'patient_fname' => 'Paul Augustine',
        				 'patient_lname' => 'Calma',
        				 'patient_weight' => '2.5',
        				 'patient_height' => '46.3',
        				 'patient_age' => '0',
        				 'patient_sex' => 'M',
        				 'patient_mother_name' => 'Calma',
                         'patient_father_name' => 'Random',
                         'patient_guardian_name' => 'Random',
                         'patient_headcircumference' => '32.1',
                         'patient_phonenumber' => '639398689992',
        				 'patient_address' => 'Tarlac',
        				 'patient_bdate' => '2016-11-08',
        				 'patient_registration_date' => '2017-01-27'
        				],
        				[
        				 'patient_uname' => 'vpamintuan',
        				 'patient_pass' =>  Hash::make('123123'),
        				 'patient_fname' => 'Veronica',
        				 'patient_lname' => 'Pamintuan',
        				 'patient_weight' => '2.7',
        				 'patient_height' => '46.3',
        				 'patient_age' => '0',
        				 'patient_sex' => 'F',
        				 'patient_mother_name' => 'Pamintuan',
                         'patient_father_name' => 'Random',
                         'patient_guardian_name' => 'Random',
                         'patient_headcircumference' => '32.1',
        				 'patient_address' => 'San Fernando',
                         'patient_phonenumber' => '639158601772',
        				 'patient_bdate' => '2016-10-12',
        				 'patient_registration_date' => '2017-01-27'
        				],
        				[
        				 'patient_uname' => 'mpamintuan',
        				 'patient_pass' =>  Hash::make('123123'),
        				 'patient_fname' => 'Marlon',
        				 'patient_lname' => 'Pamintuan',
        				 'patient_weight' => '2.5',
        				 'patient_height' => '46.3',
        				 'patient_age' => '0',
        				 'patient_sex' => 'M',
        				 'patient_mother_name' => 'Pamintuan',
                         'patient_father_name' => 'Random',
                         'patient_guardian_name' => 'Random',
                         'patient_headcircumference' => '32.1',
        				 'patient_address' => 'Manibuag Paralaya',
                         'patient_phonenumber' => ' ',
        				 'patient_bdate' => '2016-10-13',
        				 'patient_registration_date' => '2017-01-27'
        				],
        				[
        				 'patient_uname' => 'jrivera',
        				 'patient_pass' =>  Hash::make('123123'),
        				 'patient_fname' => 'Justin',
        				 'patient_lname' => 'Rivera',
        				 'patient_weight' => '2.7',
        				 'patient_height' => '46.3',
        				 'patient_age' => '0',
        				 'patient_sex' => 'M',
        				 'patient_mother_name' => 'Rivera',
                         'patient_father_name' => 'Random',
                         'patient_guardian_name' => 'Random',
                         'patient_headcircumference' => '32.1',
        				 'patient_address' => 'San Fernando',
                         'patient_phonenumber' => ' ',
        				 'patient_bdate' => '2016-06-15',
        				 'patient_registration_date' => '2017-01-27'
        				],
        				[
        				 'patient_uname' => 'rtorres',
        				 'patient_pass' =>  Hash::make('123123'),
        				 'patient_fname' => 'Ronald',
        				 'patient_lname' => 'Torres',
        				 'patient_weight' => '2.7',
        				 'patient_height' => '46.3',
        				 'patient_age' => '0',
        				 'patient_sex' => 'M',
        				 'patient_mother_name' => 'Torress',
                         'patient_father_name' => 'Random',
                         'patient_guardian_name' => 'Random',
                         'patient_headcircumference' => '32.1',
        				 'patient_address' => 'San Fernando',
                         'patient_phonenumber' => '639063916550',
        				 'patient_bdate' => '2016-06-22',
        				 'patient_registration_date' => '2017-01-27'
        				],
        				[
        				 'patient_uname' => 'jvelasco',
        				 'patient_pass' =>  Hash::make('123123'),
        				 'patient_fname' => 'Junella',
        				 'patient_lname' => 'Velasco',
        				 'patient_weight' => '2.5',
        				 'patient_height' => '46.3',
        				 'patient_age' => '0',
        				 'patient_sex' => 'F',
        				 'patient_mother_name' => 'Velasco',
                         'patient_father_name' => 'Random',
                         'patient_guardian_name' => 'Random',
                         'patient_headcircumference' => '32.1',
        				 'patient_address' => 'Mexico',
                         'patient_phonenumber' => '639058922655',
        				 'patient_bdate' => '2016-06-27',
        				 'patient_registration_date' => '2017-01-27'
        				],
        				[
        				 'patient_uname' => 'ashrestha',
        				 'patient_pass' =>  Hash::make('123123'),
        				 'patient_fname' => 'Avash',
        				 'patient_lname' => 'Shrestha',
        				 'patient_weight' => '17',
        				 'patient_height' => '46.3',
        				 'patient_age' => '0',
        				 'patient_sex' => 'F',
        				 'patient_mother_name' => 'Shrestha',
                         'patient_father_name' => 'Random',
                         'patient_guardian_name' => 'Random',
                         'patient_headcircumference' => '32.1',
        				 'patient_address' => 'San Fernando',
                         'patient_phonenumber' => ' ',
        				 'patient_bdate' => '2016-04-13',
        				 'patient_registration_date' => '2017-01-27'
        				],
        				[
        				 'patient_uname' => 'aeustaquio',
        				 'patient_pass' =>  Hash::make('123123'),
        				 'patient_fname' => 'Angelica',
        				 'patient_lname' => 'Eustaquio',
        				 'patient_weight' => '2.7',
        				 'patient_height' => '46.3',
        				 'patient_age' => '0',
        				 'patient_sex' => 'F',
        				 'patient_mother_name' => 'Eustaquio',
                         'patient_father_name' => 'Random',
                         'patient_guardian_name' => 'Random',
                         'patient_headcircumference' => '32.1',
        				 'patient_address' => 'Das Marinas',
                         'patient_phonenumber' => ' ',
        				 'patient_bdate' => '2016-04-13',
        				 'patient_registration_date' => '2017-01-27'
        				],
        				

        			];

        DB::table('patients')->insert($patients);
    }

 }
