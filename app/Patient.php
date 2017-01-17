<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{

	 protected $primaryKey = 'PatientID';
    public function users()
	{
		return $this->belongsToMany('App\Vaccine', 'immunizations', 'p_id', 'vaccine_id');
	}
}
