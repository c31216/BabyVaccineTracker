<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	public function users()
	{
		return $this->belongsToMany('App\Vaccine', 'immunizations', 'p_id', 'vaccine_id');
	}
}
