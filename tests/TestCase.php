<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use App\User;
use App\Task;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $erik;
    protected $emily;

    protected $eriksTask;
    protected $emilysTask;

    public function setUp(): void
    {
        parent::setUp();

        // I am not thinking about this right,
        // first off, I am creating users, and then creating tasks..
        // I should be creating tasks and then having the user be created as a result of that
        // mainly because the user is not the primary focus of this application..
        // the task is.. I should refactor this to use the TaskFactory that Jeffrey teaches

        Artisan::call( 'migrate' );
        // Artisan::call( 'db:seed' );

        $this->erik  = factory( User::class )->create();
        $this->emily = factory( User::class )->create();

        // $this->eriksTask = factory( Task::class )->make([

        //     'user_id' => $this->erik->id
        // ]);

        // $this->emilysTask = factory( Task::class )->make([

        //     'user_id' => $this->emily->id
        // ]);
    }
}
