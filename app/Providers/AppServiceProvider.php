<?php

namespace App\Providers;

use App\Services\WeatherApi;
use App\Services\WeatherApiInterface;
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
        $this->app->bind(WeatherApiInterface::class, WeatherApi::class);
    }
}
