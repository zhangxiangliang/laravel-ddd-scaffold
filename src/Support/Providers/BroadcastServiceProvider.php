<?php

namespace Support\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

        $files = glob(base_path('src/App/Broadcast/Routes/*.php'));
        collect($files)->map(fn ($route) => require $route);
    }
}
