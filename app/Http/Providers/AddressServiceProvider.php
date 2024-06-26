<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Services\AddressService;

class AddressServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AddressService::class, function () {
            return new AddressService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}