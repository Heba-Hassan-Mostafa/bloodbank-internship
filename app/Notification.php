<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model 
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = ['title','content','order_id'];

    public function clients()
    {
        return $this->belongsToMany('App\Client')->withPivot('is_read');
    }

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

}