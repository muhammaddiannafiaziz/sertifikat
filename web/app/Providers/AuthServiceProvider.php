<?php

namespace App\Providers;

use App\Models\User; 
use Illuminate\Support\Facades\Gate; 
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // ===================================
        // ==     DEFINISI GATES BARU       ==
        // ===================================

        // Gate untuk Superadmin
        Gate::define('is-superadmin', function (User $user) {
            return $user->role == 'superadmin';
        });

        // Gate untuk SKL Ma'had (Ma'had & Superadmin)
        Gate::define('manage-mahad', function (User $user) {
            return $user->role == 'superadmin' || $user->role == 'adminmahad';
        });

        // Gate untuk SKL Bahasa (Bahasa & Superadmin)
        Gate::define('manage-bahasa', function (User $user) {
            return $user->role == 'superadmin' || $user->role == 'adminbahasa';
        });

        // Gate untuk SKL TIPD (TIPD & Superadmin)
        Gate::define('manage-tipd', function (User $user) {
            return $user->role == 'superadmin' || $user->role == 'admintipd';
        });
        
        // ===================================
        // ==      AKHIR GATES BARU         ==
        // ===================================
    }
}