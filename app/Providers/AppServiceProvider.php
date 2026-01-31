<?php

namespace App\Providers;;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
        if (Auth::check()) {
            $categoryCounts = Category::where('user_id', auth()->id())
                ->select('name')
                ->selectRaw('COUNT(*) as total')
                ->groupBy('name')
                ->orderByRaw("FIELD(name, 'Work', 'Personal', 'Shopping')")
                ->get();


            $workCount = 0;
            $personalCount = 0;
            $shoppingCount = 0;

            foreach ($categoryCounts as $cat) {
                if ($cat->name === 'Work') {
                    $workCount = $cat->total;
                } elseif ($cat->name === 'Personal') {
                    $personalCount = $cat->total;
                } elseif ($cat->name === 'Shopping') {
                    $shoppingCount = $cat->total;
                }
            }

            // Share correctly with proper variable names
            View::share([
                'workCount' => $workCount,
                'personalCount' => $personalCount,
                'shoppingCount' => $shoppingCount
            ]);
        } else {
            // Default values for guest users
            View::share([
                'workCount' => 0,
                'personalCount' => 0,
                'shoppingCount' => 0
            ]);
        }
    }
}
