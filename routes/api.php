<?php

use Illuminate\Http\Request;
use App\Activity;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware( 'auth:api' )->get( '/user', function ( Request $request ) {

    return $request->user();
});

Route::group([ 'prefix' => 'v1', 'middleware' => 'auth:api' ], function()
{

    Route::put( '/user', 'LoggedUserController@update' );

    Route::get( '/activity', function(){

        $activity = Activity::where( 'user_id', auth()->id() )->get();
        return response()->json( $activity );
    })->name( 'activity.index' );

    Route::resource( 'routines', 'RoutineApiController' );

    Route::get( 'tasks/deleted', 'TaskApiController@deleted' )->name( 'tasks.deleted' );
    Route::resource( 'tasks', 'TaskApiController' );
});


Route::get( 'testing', function(){

    return [

        'onething' => 1337
    ];
});