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

// The front splashpage
Route::get( '/home/{action?}', 'AppController@homepage' )->name( 'home' );
Route::get( '/', 'AppController@homepage' );

Auth::routes();

Route::middleware([ 'auth' ])->group( function(){

    // the main app
    Route::get( '/{any}', 'AppController@dashboard' )->where( 'any', '.*' )->name( 'app' );
});