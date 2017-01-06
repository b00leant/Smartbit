<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $fillable = [
        'stato',
        'technical_support_id',
        'task_consegna',
        'task_ritiro'
        ];
    public function technicalSupport(){
        return $this->belongsTo('App\TechnicalSupport');
    }
    public function repairs(){
        return $this->hasMany('App\Repair');
    }
    //
}
