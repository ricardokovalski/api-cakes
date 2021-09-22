<?php

namespace App\Providers;

use App\Services\CakeService\CakeService;
use App\Services\CakeService\CakeServiceContract;
use App\Services\CakeService\LowStockService;
use App\Services\CakeService\LowStockServiceContract;
use App\Services\CustomerService\CustomerService;
use App\Services\CustomerService\CustomerServiceContract;
use App\Services\SubscribeService\SubscriberService;
use App\Services\SubscribeService\SubscribeServiceContract;
use Illuminate\Support\ServiceProvider;

class ServiceLayerProvider extends ServiceProvider
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
        $this->app->bind(
            CakeServiceContract::class,
            CakeService::class
        );

        $this->app->bind(
            CustomerServiceContract::class,
            CustomerService::class
        );

        $this->app->bind(
            SubscribeServiceContract::class,
            SubscriberService::class
        );

        $this->app->bind(
            LowStockServiceContract::class,
            LowStockService::class
        );
    }
}