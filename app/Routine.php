<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{

    public function tasks()
    {

        $this->belongsToMany( Task::class );
    }
}
