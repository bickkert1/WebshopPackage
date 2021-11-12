<?php

namespace Schoutentech\webshop;

use Illuminate\Support\ServiceProvider;


class WebshopServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //require the webshop routes
        require __dir__ . "/routes/routes.php";
    }

}
