<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Task;
use App\Routine;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory( User::class, 5 )->create()->each( function( $user, $index ){

            if( $index == 0 ){

                $user->name = 'Erik White';
                $user->email = 'erik@aol.com';
                $user->role = 'admin';
                $user->password = Hash::make( 'asdf1234' );
                $user->save();
            }

            $user->tasks()->saveMany( factory( Task::class, 25 )->make([

                'user_id' => $user->id // must still explicitly override this
            ]));
            $user->tasks()->saveMany( factory( Routine::class, 4 )->make([

                'user_id' => $user->id
            ]));
        });

        // Attach a random assortment of Tasks and Routines to eachother, for each user
        $users = App\User::all();
        foreach( $users as $user ){
            // take each user..

            // get the id's of all their tasks..
            $tasks = $user->tasks()->get( 'id' )->toArray();

            // get all their routines..
            $routines = $user->routines;
            foreach( $routines as $routine ){
                // and for each routine..

                for( $i = 0; $i < 3; $i++ ){
                    // attach 3 tasks.. making sure that there's no overlap with 'pop'

                    $taskId = array_pop( $tasks )[ 'id' ];
                    $routine->tasks()->attach( $taskId );
                }
            }
        }
    }
}
