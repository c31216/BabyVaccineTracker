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
            $table->integer('vaccine_id')->nullable();
            $table->string('immunization_description')->nullable();
            $table->string('midwife_name')->nullable();
            $table->integer('patient_id')->nullable();
            $table->date('vaccination_received')->nullable();
            $table->integer('patient_weight')->nullable();
            $table->integer('patient_height')->nullable();
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
