<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = ['imei', 'brand', 'model'];
    //
    public function repair()
    {
        return $this->hasOne('App\Repair');
    }
}
