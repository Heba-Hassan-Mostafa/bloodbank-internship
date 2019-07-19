<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Client extends Model
{



    protected $table = 'clients';
    public $timestamps = true;

    protected $fillable = [
        'name', 'email', 'password', 'birth_date',  'city_id', 'phone', 'donation_last_date','blood_type_id','is_active','api_token','pin_code'
    ];

    protected $hidden = [
        'password', 'api_token',
    ];

    public function governorates()
    {
        return $this->belongsToMany('App\Governorate');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Notification');
    }

    public function bloodtypes()
    {
        return $this->belongsToMany('App\BloodType');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }

    public function bloodtype()
    {
        return $this->belongsTo('App\BloodType','blood_type_id');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }
    public function tokens()
    {
        return $this->hasMany('App\Token');
    }

}