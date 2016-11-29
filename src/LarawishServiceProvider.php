<?php

namespace SetKyar\Larawish;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

class LarawishServiceProvider extends ServiceProvider
{
    protected $commands = [
        'SetKyar\Larawish\Commands\SendBirthdayEmail'
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'larawish');

        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/setkyar/larawish'),
        ]);

        // $this->app->booted(function () {
        //     $schedule = $this->app->make(Schedule::class);
        //     $schedule->command('larawish:email-birthday')->dailyAt('00:01');
        // });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
    }
}
