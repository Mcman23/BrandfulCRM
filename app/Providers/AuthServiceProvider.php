<?php
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Enums\Role;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // Policy mappings registered automatically
    ];

    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            return $user->isSuperAdmin() ? true : null;
        });

        Gate::define('manage-users', fn($user) => $user->isAdmin());
        Gate::define('manage-companies', fn($user) => $user->isAdmin());
        Gate::define('view-dashboard', fn($user) => true);
    }
}

