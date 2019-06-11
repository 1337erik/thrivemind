<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{

    public function user()
    {

        return $this->belongsTo( User::class );
    }

    public function tasks()
    {

        return $this->belongsToMany( Task::class )->withTimestamps();
    }
}
