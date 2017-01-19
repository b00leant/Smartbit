<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    protected $fillable = [
        'garanzia',
        'assistenza',
        'note',
        'person_id',
        'device_id',
        'seriale',
        'creazione',
        'stato',
        'technical_support_id',
        'delivery_id'
        ];
    
    public function delivery(){
        return $this->belongsTo('App\Delivery');
    }
    public function technicalSupport(){
        return $this->belongsTo('App\TechnicalSupport');
    }
    public function person_name(){
        $person = $this->person;
        return $person->nome.' '.$person->cognome;
    }
    public function person(){
        return $this->belongsTo('App\Person');
    }
    public function device()
    {
        return $this->hasOne('App\Device');
    }
    protected $table = 'repairs';
}
