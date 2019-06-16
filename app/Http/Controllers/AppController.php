<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view( 'app.pages.dashboard' );
    }

    /**
     * Show the timeboxer subapp
     * 
     * should probably offload onto a vbue component and not make this a MPA
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function timeboxer()
    {

        return view( 'app.pages.timeboxer' );
    }
}