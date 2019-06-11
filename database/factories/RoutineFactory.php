<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Routine;
use Faker\Generator as Faker;

use Facades\App\ModelUtility;

$factory->define( Routine::class, function ( Faker $faker ) {

    return [

        'title'       => $faker->sentence( 2 ),
        'description' => $faker->paragraph( 2 ),
        'notes'       => $faker->paragraph( 4 ),

        'user_id'     => factory( \App\User::class ),

        'repetition'  => implode( '', ModelUtility::acceptedRepetitions( 1 ) ),
        'duration'    => $faker->randomNumber( 5 )
    ];
});
