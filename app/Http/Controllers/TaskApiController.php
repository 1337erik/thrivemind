<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\ManageTaskRequest;

class TaskApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return auth()->user()->tasks;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( ManageTaskRequest $request )
    {

        return auth()->user()->tasks()->create( $request->validated() );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show( Task $task )
    {

        $this->authorize( 'manage_task', $task );
        return $task;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update( ManageTaskRequest $request, Task $task )
    {
        $this->authorize( 'manage_task', $task );

        $task->update( $request->validated() );

        return response()->json([

            'message' => 'Success! Task updated.',
            'task'    => $task
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy( Task $task )
    {
        $this->authorize( 'manage_task', $task );

        $task->delete();
        return response()->json([

            'message' => 'Successfully deleted task!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function deleted()
    {

        return auth()->user()->tasks()->onlyTrashed()->get();
    }
}
