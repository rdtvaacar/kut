<?php

namespace Acr\Kut;

use Illuminate\Support\ServiceProvider;


class AcrKutServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadViewsFrom(__DIR__ . '/Views', 'acr_kut');
        $this->publishes([
            __DIR__ . '/../config/kut_config.php.php' => config_path('kut_config.php'),
        ]);
        require __DIR__ . '/Routes/routes.php';
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('acr-kut', function () {
            return new kutuphane();
        });
        config([
            '/../config/kut_config.php',
        ]);
    }

}
