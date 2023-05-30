<?php
namespace App\Providers;

use App\Contracts\LogAnalyticModuleInterface;
use App\Modules\LogAnalyticModule;
use Illuminate\Support\ServiceProvider;

class LogcraftlyticsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LogAnalyticModuleInterface::class, LogAnalyticModule::class);
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
