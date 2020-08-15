<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function ads()
    {
        return $this->hasMany('App\Ad');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
