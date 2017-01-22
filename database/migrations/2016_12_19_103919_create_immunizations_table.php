<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImmunizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('immunizations', function (Blueprint $table) {
            $table->increments('ImmunizationID');
            $table->integer('vaccine_id');
            $table->string('immunization_description');
            $table->string('midwife_name');
            $table->integer('patient_id');
            $table->date('vaccination_received');
            $table->integer('patient_weight');
            $table->integer('patient_height');
            $table->string('hospital_type')->default('public');
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
        Schema::dropIfExists('immunizations');
    }
}
