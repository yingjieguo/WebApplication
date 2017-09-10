<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends BaseModel
{
   protected $primaryKey = 'id';
    protected $table = 'categories';
    protected $fillable = array('name', 'created_at_ip', 'updated_at_ip');

     public function posts()
    {
    	return $this->hasMany('App\Post','id','category_id');
    }
}
