<?php

use App\Models\Category;
use Illuminate\Support\Facades\Auth;

if(!function_exists('getCategoryCounts')){
    function getCategoryCounts(){
        $workCount = 0;
        $personalCount = 0;
        $shoppingCount = 0;

        if (Auth::check()) {
            $categoryCounts = Category::where('user_id', auth()->id())
                ->select('name')
                ->selectRaw('COUNT(*) as total')
                ->groupBy('name')
                ->pluck('total', 'name');

            $workCount = $categoryCounts['Work'] ?? 0;
            $personalCount = $categoryCounts['Personal'] ?? 0;
            $shoppingCount = $categoryCounts['Shopping'] ?? 0;
        }

        return compact('workCount', 'personalCount', 'shoppingCount');
    }
}