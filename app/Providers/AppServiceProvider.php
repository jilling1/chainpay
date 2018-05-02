<?php

namespace App\Providers;

use App\Helpers\BlockCypher;
use App\Helpers\CurrencyRate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('BlockCypher', function()
        {
            $token = env('BLOCKCYPTER_TOKEN');
            return new BlockCypher($token);
        });

        $this->app->singleton('CurrencyRate', function()
        {
            return new CurrencyRate();
        });
    }
}
