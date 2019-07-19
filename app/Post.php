<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model 
{
    protected $fillable=['title','content','image','category_id'];

    protected $table = 'posts';
    public $timestamps = true;

    public function clients()
    {
        return $this->belongsToMany('Client');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}