<?php

namespace App\Providers;

use App\Models\Application;
use App\Policies\ApplicationPolicy;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

    }

    protected array $policies = [
        Application::class => ApplicationPolicy::class,
    ];

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
