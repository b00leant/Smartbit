<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyList extends Model
{
    protected $table = 'lists';
    protected $fillable = [
        'nome',
        'editable',
        ];
    public function tasks(){
        return $this->hasMany('App\Task');
    }
    //
}
