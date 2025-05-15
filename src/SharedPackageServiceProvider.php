<?php

namespace Custospark\Traits;

use Illuminate\Support\ServiceProvider;

class SharedPackageServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load views from the package
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'custospark');

        // Optionally allow publishing views
        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/vendor/custospark'),
        ], 'views');
    }

    public function register()
    {
        //To do
    }
}
