<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{

	
	protected $primaryKey = 'VaccineID';
	
	public function immunization()
	{
		return $this->hasMany('App\Immunization','vaccine_id');
	}

	public function users()
	{
		return $this->belongsToMany('App\Patient', 'immunizations', 'vaccine_id', 'patient_id');
	}

}
