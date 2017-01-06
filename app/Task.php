<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable  = [
        'done',
        'type',
        'deadline',
        'list_id'
        ];
    public function task_list(){
        return $this->belongsTo('App\List');
    }
}
