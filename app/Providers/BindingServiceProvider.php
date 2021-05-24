<?php


namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class BindingServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Interfaces\AuthProcessImplementationInterface::class, \App\Implementations\AuthProcessImplementation::class);
        $this->app->bind(\App\Interfaces\LoanImplementationInterface::class, \App\Implementations\LoanImplementation::class);
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
