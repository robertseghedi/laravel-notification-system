<?php

namespace RobertSeghedi\LNS;

use Illuminate\Support\ServiceProvider;

class LNSProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('RobertSeghedi\LNS\Models\Notification');
        $this->app->make('RobertSeghedi\LNS\Models\LNS');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }
}
