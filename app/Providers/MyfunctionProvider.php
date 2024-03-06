<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Myfunction;

class MyfunctionProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('Myfunction', Myfunction::class);
        // 実行するには app()->make('Myfunction');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
