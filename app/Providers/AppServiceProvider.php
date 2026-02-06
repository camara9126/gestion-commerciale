<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use App\Services\PayTech;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
         $this->app->bind(PayTech::class, function ($app) {
            // Retrieve the API key from your configuration file (e.g., config/services.php or config/app.php)
            $apiKey = config('services.paytech.api_key');
            $apiSecret = config('services.paytech.api_secret');

            return new PayTech($apiKey, $apiSecret);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    public const HOME = '/dashboard';


    // Enregistrement de la policy authUser
    protected $policies = [
        User::class => UserPolicy::class,
    ];
}
