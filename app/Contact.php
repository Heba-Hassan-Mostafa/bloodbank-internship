<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model 
{




    protected $table = 'contacts';
    public $timestamps = true;

    protected $fillable = [
        'title', 'message',
    ];

    public function clients()
    {
        return $this->belongsTo('App\Client','client_id');
    }

}