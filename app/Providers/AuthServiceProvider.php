<?php

namespace App\Providers;

use App\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     */
    public function boot(): void
    {
        // Skip permission loading during console commands that don't need database
        if ($this->app->runningInConsole() && !$this->app->runningUnitTests()) {
            return;
        }

        try {
            if (Schema::hasTable('permissions')) {
                // Dynamically register permissions with Laravel's Gate.
                foreach ($this->getPermissions() as $permission) {
                    Gate::define($permission->name, function ($user) use ($permission) {
                        return $user->hasPermission($permission);
                    });
                }
            }
        } catch (\Exception) {
            // Silently fail if database is not available
            return;
        }
    }

    /**
     * Fetch the collection of site permissions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getPermissions()
    {
        return Permission::with('roles')->get();
    }
}
