<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    public function users(){
        
        return $this->belongsToMany('App\Models\User', 'user_website', 'website_id', 'user_id')
        ->withTimestamps()
        ->withPivot(['subscription_date']);

    }  
}
