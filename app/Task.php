<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{


    public function routines()
    {

        $this->belongsToMany( Routine::class );
    }
}
