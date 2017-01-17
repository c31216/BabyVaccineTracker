<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('PatientID');
            $table->string('patient_uname')->unique();
            $table->string('patient_pass');
            $table->string('patient_fname');
            $table->string('patient_lname');
            $table->decimal('patient_weight');
            $table->decimal('patient_height');
            $table->integer('patient_age');
            $table->char('patient_sex');
            $table->string('patient_mother_name');
            $table->string('patient_address');
            $table->date('patient_bdate');
            $table->date('patient_registration_date');
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
        Schema::dropIfExists('patients');
    }
}
