<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{


    protected $fillable = [
        'patient_name', 'patient_age', 'blood_type_id','bags_number','hospital_name','hospital_address','latitude','longitude',
        'city_id','phone','notes','client_id'
    ];
    protected $table = 'orders';
    public $timestamps = true;

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function bloodtype()
    {
        return $this->belongsTo('App\BloodType','blood_type_id');
    }

    public function notifications()   //for create orders
    {
        return $this->hasMany('App\Notification');
    }

    public function notification()  //for update is_read 0->1
    {
        return $this->hasOne('App\Notification');
    }

}