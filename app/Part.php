<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;

class Part extends Model
{
    //
    public function hardwareType(){
        return $this->belongsTo('App\HardwareType');
    }
    
    public function image(){
        return $this->hasOne('App\HardwareType');
    }
    
    protected $fillable = [
        'nome', 
        'prezzo',
        'quantita',
        'image_id'
        ];
}
