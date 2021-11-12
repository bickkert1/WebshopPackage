<?php

namespace Schoutentech\webshop;

use Illuminate\Support\ServiceProvider;
use Schoutentech\Webshop\Console\AddBrand;


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
        // adding artisan commands:
        $this->commands([
           AddBrand::class,
        ]);
        // adding blade directives:
        Blade::directive('datetime', function ($expression) {
            $contents = File::get(__DIR__ . '\directives\loadproducts.php');    $replaced = str_replace('$expression', $expression, $contents);    return Str::finish($replaced, '?>');
        });
        //require the webshop routes
        require __dir__ . "/routes/routes.php";
    }

}
