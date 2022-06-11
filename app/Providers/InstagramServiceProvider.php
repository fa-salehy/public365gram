<?php

namespace App\Providers;
use App\Classes\InstagramAPI;
use Illuminate\Support\ServiceProvider;

class InstagramServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('InstagramAPI', function(){
            return new InstagramAPI();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
