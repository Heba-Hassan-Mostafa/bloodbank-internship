<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model 
{
    protected $fillable=['app_url','phone','email','facebook_url','youtube_url','twitter_url','twitter_url','whatsup',
        'instgram_url','about_app'];

    protected $table = 'settings';
    public $timestamps = true;

}