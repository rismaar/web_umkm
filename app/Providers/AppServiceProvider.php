<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\cart;
use App\Models\cartItem;
use App\Models\Sale;

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
        View::composer('*', function ($view) {
            $cartCount = 0;
            if (Auth::check() && Auth::user()->role == 'user') {
                $cart = cart::where('id_user', Auth::id())->first();
                if ($cart) {
                    $cartCount = cartItem::where('id_cart', $cart->id_cart)->sum('qty');
                }
            }
            $view->with('cartCount', $cartCount);

            $newOrderCount = 0;
            if (Auth::check() && Auth::user()->role == 'admin') {
                $newOrderCount = Sale::where('status', 'pending')->count();
            }
            $view->with([
                'cartCount' => $cartCount,
                'newOrderCount' => $newOrderCount,
            ]);

            
        });
    }
}
