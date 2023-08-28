<?php

namespace App\Providers;

use App\Domains\Events\Http\Observers\RecurrenceObserver;
use App\Domains\Events\Models\Event;
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
        Event::observe(RecurrenceObserver::class);
    }
}
