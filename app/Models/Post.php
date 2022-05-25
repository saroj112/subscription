<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function website(){
        
        return $this->belongsTo('App\Models\Website', 'website_id', 'id');
    }
}