<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{

    use SoftDeletes;
    protected $guarded = [];

    protected $casts = [

        'completed' => 'boolean', // necessary because the DB saves bools as 0 or 1, not true/false
        'due_date'  => 'datetime'
    ];

    public function path()
    {

        return '/api/v1/tasks/' . $this->id;
    }

    public function markComplete()
    {

        $this->update([ 'completed' => true ]);
    }

    public function markIncomplete()
    {

        $this->update([ 'completed' => false ]);
    }

    public function user()
    {

        return $this->belongsTo( User::class );
    }


    public function routines()
    {

        return $this->belongsToMany( Routine::class )->withTimestamps();
    }

    public function activity()
    {

        return $this->hasMany( Activity::class );
    }
}
