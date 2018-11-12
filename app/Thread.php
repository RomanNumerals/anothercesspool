<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    # Fetch path to current thread @return string

    public function path() 
    {
    	return '/threads/' . $this->id;
    }

    public function replies()
    {
    	return $this->hasMany(Reply::class);
    }
}
