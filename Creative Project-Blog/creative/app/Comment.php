<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends BaseModel
{
    public function post()
    {
    	//return $this->belongsTo('App\Post','post_id','id');
    	return $this->belongsTo('App\Post');
    }
}
