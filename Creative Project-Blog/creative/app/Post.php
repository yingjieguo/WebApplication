<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends BaseModel
{
    // protected $primaryKey = 'id';
    // protected $table = 'posts';
    // protected $fillable = array('url', 'title', 'description','content','blog','created_at_ip', 'updated_at_ip');
    // 
    public function category()
    {
    	return $this->belongsTo('App\Category','category_id','id');
    }

    // public function tags()
    // {
    // 	return $this->belongsToMany('App\Tag');
    // }
    public function comments()
    {
    	//return $this->hasMany('App\Comment','id','post_id');
        return $this->hasMany('App\Comment');
    }
}
