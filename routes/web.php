<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get( '/', 'HomeController@index' )->name( 'home' );

Auth::routes();

Route::get( '/timeboxer', function(){

    return view( 'timeboxer' );
})->name( 'timeboxer' );

Route::middleware([ 'auth' ])->group( function(){

    Route::get( '/dashboard', 'AppController@index' )->name( 'app.dashboard' );
    Route::get( '/home', 'AppController@index' )->name( 'app.home' );

    Route::resource( 'routines', 'RoutineController' );
    Route::resource( 'tasks', 'TaskController' );
});
