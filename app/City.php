<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model 
{
    protected $fillable = [
        'name', 'governorate_id'
    ];
    protected $table = 'cities';
    public $timestamps = true;

    public function clients()
    {
        return $this->hasMany('App\Client');
    }

//    public function governorate()
//    {
//        return $this->belongsTo('App\Governorate','governorate_id');
//    }
    public function governorate()
    {
        return $this->belongsTo('App\City');
    }

}