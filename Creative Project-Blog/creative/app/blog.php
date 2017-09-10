<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class blog extends BaseModel
{
    protected $table='blogs'; 
    protected $primaryKey = 'id';
    protected $fillable = ['heading', 'content', 'user_id'];
	
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
