<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        $user = Auth::user();
        
        // Get user statistics
        // $stats = [
        //     'total_tasks' => $user->tasks()->count(),
        //     'completed_tasks' => $user->tasks()->where('is_completed', true)->count(),
        //     'pending_tasks' => $user->tasks()->where('status', 'pending')->count(),
        //     'overdue_tasks' => $user->tasks()->overdue()->count(),
        //     'total_categories' => $user->categories()->count(),
        // ];

        // // Recent activity
        // $recentTasks = $user->tasks()->latest()->take(5)->get();

        return view('profile.index', compact('user'));
    }
}
