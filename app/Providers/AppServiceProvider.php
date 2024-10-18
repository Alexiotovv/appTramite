<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;

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
        RateLimiter::for('login', function(Request $request){
            return Limit::perMinute(1)
            ->by($request->user()?->id ?: $request->ip())
            ->response(function(Request $request){
                return response()->json([
                    'message' => 'Ha excedido el limite de intentos'
                ], 429);
            });
        });
    }
}