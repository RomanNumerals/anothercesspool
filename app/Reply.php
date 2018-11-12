<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    public function owner()
    {
    	# shows which user created a response to a thread
    	return $this->belongsTo(User::class, 'user_id');
    }
}
