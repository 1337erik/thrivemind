<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if( ! App::runningInConsole() ){

            $allowedOrigins = [ 'http://thrivemind.test' ];

            $origin = $_SERVER[ 'HTTP_HOST' ];

            if( in_array( $origin, $allowedOrigins ) ){

                return $next( $request )
                    ->header( 'Access-Control-Allow-Origin', $origin )
                    ->header( 'Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS' )
                    ->header( 'Access-Control-Allow-Headers', 'Content-Type, X-REQUESTED-WITH' );
            }
        }

        return $next( $request );
    }
}
