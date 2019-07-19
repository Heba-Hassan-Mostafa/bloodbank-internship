<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloodType extends Model 
{
    protected $fillable = ['name'];
    protected $table = 'blood_types';
    public $timestamps = true;

    public function clients()
    {
        return $this->belongsToMany('App\Client');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function client()
    {
        return $this->hasMany('App\Client');
    }


}