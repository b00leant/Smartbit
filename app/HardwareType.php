<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HardwareType extends Model
{
    //
    public function parts(){
        return $this->hasMany('App\Part');
    }
}
