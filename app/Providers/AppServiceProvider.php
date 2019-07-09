<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Log;
use Laravel\Telescope\TelescopeServiceProvider;
use App\Task;
use App\Observers\TaskObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Force SSL in production
        if ( $this->app->environment() == 'production' ) {

            URL::forceScheme( 'https' );
        }

        if( $this->app->isLocal() ){
            // could probably be a simple 'else' statement to the above if

            $this->app->register( TelescopeServiceProvider::class );
        }

        Task::observe( TaskObserver::class );
    }
}
