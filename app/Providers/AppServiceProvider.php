<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();

        Blade::directive('role', function ($role) {
            return "<?php if (Auth::check() && Auth::user()->roles()->where('name', {$role})->exists()) { ?>"; //checks if user is authenticated and checks if the role matches the users role
        });
        
        Blade::directive('endrole', function () {
            return "<?php } ?>";
        });
        
    }
}
