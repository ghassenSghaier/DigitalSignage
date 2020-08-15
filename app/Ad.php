<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
     public function buses()
    {
        return $this->belongsToMany('App\Bus');
    }

     public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
