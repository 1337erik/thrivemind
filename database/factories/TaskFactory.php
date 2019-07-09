<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Task;
use Faker\Generator as Faker;

use Facades\App\ModelUtility;
use Carbon\Carbon;

$factory->define( Task::class, function ( Faker $faker ) {

    return [

        'title'       => $faker->sentence( 2 ),
        'description' => $faker->paragraph( 2 ),
        'notes'       => $faker->paragraph( 4 ),

        'user_id'     => factory( \App\User::class ),

        'repetition'  => implode( '', ModelUtility::acceptedRepetitions( 1 ) ),
        'duration'    => $faker->randomNumber( 5 ),

        'due_date'    => Carbon::parse( $faker->dateTimeBetween( '-15 days', '+15 days', 'EST' ) )
    ];
});
