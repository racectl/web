<?php

namespace App\Providers;

use App\Actions\CreateAccEvent\AccEventSelectedPresets;
use App\MenuBuilder\MenuBuilder;
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
        $this->app->singleton('MenuBuilder', function () {
            return new MenuBuilder(
                app('Illuminate\Http\Request')
            );
        });

        $this->app->singleton(AccEventSelectedPresets::class, function () {
            return new AccEventSelectedPresets;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
