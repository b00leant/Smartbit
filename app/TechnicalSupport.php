<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TechnicalSupport extends Model
{
    //
    protected $fillable = [
        'nome',
        'brand',
        'indirizzo',
        'telefono'
        ];
    protected $table = 'technical_supports';
    
    public function deliveries(){
        return $this->hasMany('App\Delivery');
    }
}
