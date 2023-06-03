<?php

namespace App\Providers;

use App\Service\SearchEngine\Engines\Elastic;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

class CustomServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind("SearchEngin", function (Application $app){
            switch (config('search_engine.default')){
                case "elastic";
                    return new Elastic();
            }
            return false;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
