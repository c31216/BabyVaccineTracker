<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Checkups extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkups', function (Blueprint $table) {
            $table->increments('CheckupID');
            $table->string('checkup_symptoms');
            $table->string('checkup_prescription');
            $table->string('checkup_description');
            $table->string('doctor_name');
            $table->integer('patient_id');
            $table->date('checkup_date');
            $table->integer('patient_weight');
            $table->integer('patient_height');
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
        Schema::drop('checkups');
    }
}
