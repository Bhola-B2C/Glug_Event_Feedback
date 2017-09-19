<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function feedback()
    {
    	return $this->hasMany('App\Feedback');
    }
}
