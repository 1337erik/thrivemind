<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Task;
use Laravel\Passport\Passport;

class TaskTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    /**
     * @test
     * 
     * testing the path of the task entity for brevity
     */
    public function a_task_has_a_path()
    {

        $task = factory( Task::class )->create();

        $this->assertEquals( '/api/v1/tasks/' . $task->id, $task->path() );
    }

    /**
     * @test
     * 
     *  a test to make sure the CREATE functionality works for tasks
     */
    public function task_creation_tests()
    {

        // sign in our first user
        Passport::actingAs( $this->erik );

        // have him create a task ( 'raw' doesn't save to the database, whereas 'create' will.. )
        $task = factory( Task::class )->raw([

            'user_id' => auth()->id()
        ]);

        // assert that the route is actually working..
        $this->post( route( 'tasks.store' ), $task )
            ->assertSuccessful()
            ->assertJson([

                'title'       => $task[ 'title' ],
                'description' => $task[ 'description' ]
            ]);

        // and that the database has this new entity within it
        $this->assertDatabaseHas( 'tasks', [

            'title'       => $task[ 'title' ],
            'description' => $task[ 'description' ]
        ]);
    }


    /**
     * @test
     * 
     * this test bundles together all of the UPDATE functionality for tasks
     * 
     *      a user can edit their own task,
     *      however a user cannot edit another user's tasks
     */
    public function task_updating_tests()
    {

        // sign in our first user
        Passport::actingAs( $this->erik );

        // have one create a task
        $task = factory( Task::class )->create([

            'user_id' => auth()->id()
        ]);

        // set some attributes for changin'
        $newattr = [

            'title'       => 'changed title',
            'description' => 'thinking about a different description',
            'notes'       => 'as well as some really different notes'
        ];

        // make the change
        $this->patch( $task->path(), $newattr );

        // assert that it worked and that the old stuff is gone
        $this->assertDatabaseHas( 'tasks', $newattr );
        $this->assertDatabaseMissing( 'tasks', $task->toArray() );

        // sign in as the other user
        Passport::actingAs( $this->emily );

        // get some new-new attributes to change
        $newnewattr = [

            'title'       => 'changed title AGAIN',
            'description' => 'thinking about a different description AGAIN',
            'notes'       => 'as well as some really different notes AGAIN'
        ];

        // try to change the same task, assert it didnt work
        $this->patch( $task->path(), $newnewattr )
            ->assertForbidden();

        // ..and that the old stuff is still there
        $this->assertDatabaseHas( 'tasks', $newattr );
    }

    /**
     * @test
     * 
     *  to make sure the dedicated 'complete' function works
     */
    public function a_task_can_be_completed()
    {

        // create the task
        $task = factory( Task::class )->create();

        // call the complete function
        $task->markComplete();

        // assert that it worked
        $this->assertEquals( $task->fresh()->completed, true );

        // call the incomplete function
        $task->markIncomplete();

        // assert that it worked
        $this->assertEquals( $task->fresh()->completed, false );
    }

    /**
     * @test
     * 
     * this test bundles together the READ functionality of tasks
     * 
     *      A user can see their own tasks, as well as a specific task..
     *      however they cannot see other user's tasks ( or any specific task of theirs )..
     */
    public function task_reading_tests()
    {
        $this->withExceptionHandling();

        // sign in our first user
        Passport::actingAs( $this->erik );

        // create some tasks by one of them
        $tasks = factory( Task::class, 10 )->create([

            'user_id' => auth()->id()
        ]);

        // verify that the user can see their tasks at the 'get-all' index-route
        $this->get( route( 'tasks.index' ) )
            ->assertSuccessful()
            ->assertJson( $tasks->toArray() );

        // verify that the user can see one of their task at a 'specific' show-route
        $task = $tasks[ 0 ];
        $this->get( $task->path() )
            ->assertSuccessful()
            ->assertJson( $task->toArray() );


        // verify if the other user goes to the 'get-all' index route, they cant see any of the tasks
        Passport::actingAs( $this->emily );
        $this->get( route( 'tasks.index' ) )
            ->assertJsonMissing( $tasks->toArray() ); // testing that the response is an empty array

        // verify that if that user goes to the 'specific' show-route for the first user's task, it doesnt work
        $this->get( $task->path() )
            ->assertForbidden();
    }

    /**
     * @test
     * 
     *  testing the DELETE functionality for tasks,
     *  meaning that a user can delete the task, cannot view deleted tasks with the normal index route, and can only view deleted tasks with a special route
     *  also, making sure users cant delete eachother's posts
     */
    public function task_deletion_functionality()
    {

        // sign in our first user
        Passport::actingAs( $this->erik );

        // have him create 2 tasks
        $tasks = factory( Task::class, 2 )->create([

            'user_id' => auth()->user()->id
        ]);

        // have him soft delete one
        $this->delete( $tasks[ 0 ]->path() )
            ->assertJsonStructure([ 'message' ]);

        $task = $tasks[ 0 ]->fresh();
        $this->assertEquals( true, $task->trashed() );

        // assert that it doesnt appear when searched for ( normally )
        $this->get( route( 'tasks.index' ) )
            ->assertJsonMissing( $tasks->toArray() )
            ->assertJsonCount( 1 );

        // assert that it does appear when searched for explicitly
        $this->get( route( 'tasks.deleted' ) )
            ->assertJsonFragment( $task->toArray() )
            ->assertJsonCount( 1 );

        // assert that the other user cannot delete their other task
        Passport::actingAs( $this->emily );

        // attempt to delete..
        $this->delete( $tasks[ 1 ]->path() )
            ->assertForbidden();

        // ..and assert that the first user still see's it
        Passport::actingAs( $this->erik );

        $this->get( route( 'tasks.index' ) )
            ->assertJson( [ $tasks[ 1 ]->toArray() ] )
            ->assertJsonCount( 1 );
    }

    /**
     * @test
     * 
     *  run through every CRUD operation and determine that unauthenticated users cannot complete them
     */
    public function unauthenticated_users_cannot_interact_with_tasks_at_all()
    {

        // test CREATE
        $attrs = [

            'title'       => 'changed title',
            'description' => 'thinking about a different description',
            'notes'       => 'as well as some really different notes'
        ];

        $this->post( route( 'tasks.store' ), $attrs )
            ->assertRedirect( '/login' );

        $this->assertDatabaseMissing( 'tasks', $attrs );

        // test READ
        $this->get( route( 'tasks.index' ) )
            ->assertRedirect( '/login' );

        // test UPDATE
        $task = factory( Task::class )->create();

        $this->patch( $task->path(), $attrs )
            ->assertRedirect( '/login' ); // assert we got redirected

        // ..then assert that the database still has the original values, as well as not possessing the new values
        $this->assertDatabaseHas( 'tasks', $task->toArray() );
        $this->assertDatabaseMissing( 'tasks', $attrs );

        // test DELETE
        $this->delete( $task->path() )
            ->assertRedirect( '/login' );

        // make sure that the task is in fact NOT DELETED
        $task->refresh();
        $this->assertEquals( false, $task->trashed() );
    }
}
