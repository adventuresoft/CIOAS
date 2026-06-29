<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        // Force HTTPS in production to prevent mixed content blocking (CSS/JS not loading)
        if (config('app.env') === 'production' || strpos(config('app.url'), 'https://') !== false) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

         Paginator::useBootstrap();
        Schema::defaultStringLength(191);
        $mainPath = database_path('migrations');
        $directories = glob($mainPath . '/*', GLOB_ONLYDIR);
        $paths = array_merge([$mainPath], $directories);
        $this->loadMigrationsFrom($paths);
        $testGlobalVariable = "Hello";
    }
}
