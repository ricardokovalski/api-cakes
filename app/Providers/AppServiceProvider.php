<?php

namespace App\Providers;

use App\Events\CakeUpdated;
use App\Models\Cake;
use App\Observers\CakeObserver;
use Illuminate\Support\Facades\Log;
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
        $this->app['events']->listen('App\Events\Attached', function ($event) {
            Log::info('event.attached', [
                'event.related' => $event->getRelated(),
                'event.parent' => $event->getParent()
            ]);
            event(new CakeUpdated($event->getRelated()));
        });
    }
}
