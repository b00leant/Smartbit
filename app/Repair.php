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
        'stato'
        ];
    
    public function delivery(){
        return $this->belongsTo('App\Delivery');
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
