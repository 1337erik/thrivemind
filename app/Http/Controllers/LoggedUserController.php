<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoggedUserController extends Controller
{

    /**
     * 
     * Update User
     */
    public function update( Request $request )
    {
        Auth::user()->update( $request->only([ 'name', 'email' ] ));
        return Auth::user();
    }
}
