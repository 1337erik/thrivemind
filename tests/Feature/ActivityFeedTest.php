<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Task;

class ActivityFeedTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * 
     *  A test to make sure that activity is created properly with the right meta data when a TASK IS CREATED
     */
    public function creating_a_task_generates_activity()
    {
        // $this->withExceptionHandling();

        // create the task
        $task = factory( Task::class )->create();

        // assert that ANY activity exists for that task
        $this->assertCount( 1, $task->activity );

        // double check that it is the right kind of activity
        $this->assertEquals( 'created', $task->activity[ 0 ]->description );

        // check that the user who created the task is recorded in the activity
        $this->assertEquals( $task->user_id, $task->activity[ 0 ]->user_id );
    }

    /**
     * @test
     */
    public function updating_a_task_generates_activity()
    {
        // $this->withExceptionHandling();

        // create the task
        $task = factory( Task::class )->create();

        // update it
        $task->update([ 'title' => 'is now different' ]);

        // assert that two pieces of activity now exist for that task
        $this->assertCount( 2, $task->activity );

        // double check that both are the right kind of activity
        $this->assertEquals( 'created', $task->activity[ 0 ]->description );
        $this->assertEquals( 'updated', $task->activity[ 1 ]->description );

        // check that the user who created the task is recorded in both activity
        $this->assertEquals( $task->user_id, $task->activity[ 0 ]->user_id );
        $this->assertEquals( $task->user_id, $task->activity[ 1 ]->user_id );
    }

    /**
     * @test
     * 
     *  Testing TASK COMPLETION with creating activity
     */
    public function completing_a_task_generates_activity()
    {

        // create the task
        $task = factory( Task::class )->create();

        // completed the task
        $task->markComplete();

        // check for activity
        $this->assertCount( 2, $task->activity );
        $this->assertEquals( 'updated', $task->activity[ 1 ]->description ); // I need to be more specific with this, cant just be 'updated'
    }

    /**
     * @test
     * 
     *  Testing the DELETE TASK activity recording, as well as RESTORING fro mafter being deleted
     */
    public function deleting_a_task_generates_activity()
    {

        // given we have a task
        $task = factory( Task::class )->create();

        // delete it
        $task->delete();
        $task->refresh();

        // assert that the right activity was recorded
        $this->assertTrue( $task->trashed() );
        $this->assertCount( 2, $task->activity );
        $this->assertEquals( 'deleted', $task->activity[ 1 ]->description );

        // restore the task
        $task->restore();
        $task->refresh();

        // assert that the proper activity was logged
        $this->assertFalse( $task->trashed() );
        $this->assertCount( 3, $task->activity );
        $this->assertEquals( 'restored', $task->activity[ 2 ]->description );
    }

    /**
     * 
     * Events to test for:
     * - Create task
     * - Complete task
     * - Delete Task
     * - Update Task
     * 
     * Things to test for within an event:
     * - the user that caused the event
     * - the description of the event ( update, create, delete, complete, etc. )
     * - the actual details of the event ( title changed to.. erik completed.. etc )
     * - the type of event ( this will be polymorphic because it will eventually go to routines and goals )
     */
}
