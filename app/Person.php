<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [
        'nome', 
        'cognome',
        'data_nascita',
        'luogo_nascita',
        'email',
        'telefono',
        'residenza'
        ];
    //
    public function repairs()
    {
        return $this->hasMany('App\Repair');
    }
    protected $table = 'people';
}
