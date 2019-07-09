<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Activity;
use App\Task;
use Laravel\Passport\Passport;

class ActivityLogTest extends TestCase
{


    /**
     * @test
     * 
     * testing the route to GET
     */
    public function activity_log_can_be_fetched()
    {

        Passport::actingAs( $this->erik );

        // given that we create some activity..
        // factory( Activity::class, 5 )->create(); theres no activity factory, just create some tasks
        auth()->user()->tasks()->create( factory( Task::class )->raw() );

        $activity = auth()->user()->activity->toArray();

        // assert that the route is returning the activity
        $this->get( route( 'activity.index' ) )
            ->assertSuccessful()
            ->assertJson( $activity );

        // dd( $activity );
        // assert that the database has the activity
        $this->assertDatabaseHas( 'activities', [ 'description' => $activity[ 0 ][ 'description' ] ]);
    }
}
