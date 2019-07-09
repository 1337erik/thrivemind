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
     * Show the main front homepage
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function homepage( $action = null )
    {

        $infocards = [

            [
                'icon' => 'school',
                'title' => 'Education',
                'body' => 'Thrivemind is a resource rich with the best information the internet can offer in the spaces of health, diet, fitness, biohacking, self-optimization, philosophy and more. I strive to populate this ecosystem with the top minds of today to create a vibrant space for growth.'
            ],
            [
                'icon' => 'fitness_center',
                'title' => 'Fitness',
                'body' => 'As someone who personally suffers from physical ailments caused by \'normal\' behaviors in modern society, I have come to learn that the modern world requires us to live in an abnormal way. Rather than get nihilistic aobut it, you will learn here how to counteract those forces.'
            ],
            [
                'icon' => 'spa',
                'title' => 'Mindfullness',
                'body' => 'Arguably the most important thing you can spend time understanding for the sake of your own happiness and sense of purpose is your own consciousness. There are many techniques to bring awareness to your own self, and tons of research to indicate that it is incredibly healthy to do so!'
            ]
        ];

        return view( 'homepage', compact( 'action', 'infocards' ) );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {

        return view( 'app.dashboard' );
    }
}