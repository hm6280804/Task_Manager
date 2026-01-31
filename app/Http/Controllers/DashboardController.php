<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $today = Carbon::today();
        $allTasks = Task::where('user_id', auth()->id())->count();
        $pendingTasks = Task::where('user_id', auth()->id())->where('status', 'pending')->count();
        $completedTasks = Task::where('user_id', auth()->id())->where('status', 'completed')->count();
        $overdueTasks = Task::where('user_id', auth()->id())->where('status', '!=', 'completed')
                        ->whereDate('due_date', '<', $today)->count();
        $upcomingTasks = Task::where('user_id', auth()->id())
                        ->where('status', 'pending')
                        ->whereDate('due_date', '>=', $today)
                        ->orderBy('due_date', 'asc')
                        ->orderBy('due_time', 'asc')
                        ->limit(3)
                        ->get();
        $todayTasks = Task::where('user_id', auth()->id())
                        ->where('due_date', $today)
                        ->orderBy('due_time', 'asc')
                        ->get();
        return view('dashboard', compact('allTasks', 'pendingTasks', 'completedTasks','overdueTasks', 'upcomingTasks', 'todayTasks'));
    }
}
