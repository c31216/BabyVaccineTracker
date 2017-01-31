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
            $table->string('patient_pass')->nullable();
            $table->string('patient_fname')->nullable();
            $table->string('patient_lname')->nullable();
            $table->decimal('patient_weight')->nullable();
            $table->decimal('patient_height')->nullable();
            $table->integer('patient_age')->nullable();
            $table->char('patient_sex')->nullable();
            $table->string('patient_mother_name')->nullable();
            $table->string('patient_father_name')->nullable();
            $table->string('patient_guardian_name')->nullable();
            $table->decimal('patient_headcircumference')->nullable();
            $table->string('patient_address')->nullable();
            $table->string('patient_phonenumber')->nullable();
            $table->date('patient_bdate')->nullable();
            $table->date('patient_registration_date')->nullable();
            $table->date('p1_completion_date')->nullable();
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
