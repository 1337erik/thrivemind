<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Task;
use App\Routine;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory( User::class, 35 )->create()->each( function( $user ){

            // $user->tasks()->save( factory( Task::class, 45   )->make() );
            // $user->tasks()->save( factory( Routine::class, 3 )->make() );
        });
    }
}
