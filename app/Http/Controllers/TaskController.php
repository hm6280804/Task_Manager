<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

use function Symfony\Component\Clock\now;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $query = Task::with('category')->where('user_id', auth()->id());

        $status = $request->input('status', 'all'); // default 'all'
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('priority') && $request->priority != 'all') {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('category') && $request->category != 'all') {
            $query->where('category_id', $request->category);
        }

        switch ($request->sort) {
            case 'due_date':
                $query->orderBy('due_date', 'asc');
                break;
            case 'priority':
                // You can order by priority using FIELD for custom order if needed
                $query->orderByRaw("FIELD(priority, 'high', 'medium', 'low')");
                break;
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            default: // latest first
                $query->latest();
                break;
        }

        $tasks = $query->paginate(10)->withQueryString();

        $counts = [
            'all' => Task::where('user_id', auth()->id())->count(),
            'pending' => Task::where('user_id', auth()->id())->where('status', 'pending')->count(),
            'in_progress' => Task::where('user_id', auth()->id())->where('status', 'in_progress')->count(),
            'completed' => Task::where('user_id', auth()->id())->where('status', 'completed')->count(),
        ];

        return view('tasks.index', ['tasks' => $tasks, 'categories' => $categories, 'counts' => $counts, 'status' => $status]);
    }

    public function createTask()
    {
        $categories = Category::all();
        return view('tasks.create', ['categories' => $categories]);
    }

    public function storeTask(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description'   => 'nullable|string',
            'category_id'   => 'nullable|exists:categories,id',
            'priority'      => 'required|in:low,medium,high',
            'due_date'      => 'nullable|date|after_or_equal:today',
            'due_time'      => 'nullable|date_format:H:i',
            'status'        => 'required|in:pending,in_progress,completed',
            'notes'         => 'nullable|string',
            'is_important'  => 'nullable|boolean',
        ]);

        $isImportant = $request->has('is_important');

        Task::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'priority'     => $request->priority,
            'due_date'     => $request->due_date,
            'due_time'     => $request->due_time,
            'status'       => $request->status,
            'notes'        => $request->notes,
            'is_important' => $isImportant,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task Created Successfully.');
    }

    public function deleteTask($id)
    {
        $task = Task::findOrFail($id);
        if ($task->user_id !== auth()->id()) {
            abort(403, 'Unauthorized to complete this action');
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task Deleted Successfully.');
    }

    public function editTask($id)
    {
        $categories = Category::all();
        $task = Task::with('category')
            ->where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        return view('tasks.edit', ['task' => $task, 'categories' => $categories]);
    }

    public function updateTask(Request $request, $id){
        $task = Task::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'category_id'   => 'nullable|exists:categories,id',
            'priority'      => 'required|in:low,medium,high',
            'due_date'      => 'nullable|date',
            'due_time'      => 'nullable|date_format:H:i',
            'status'        => 'required|in:pending,in_progress,completed',
            'notes'         => 'nullable|string',
            'is_important'  => 'nullable|boolean',
        ]);

        $validated['is_important'] = $request->input('is_important');
        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task Updated Successfully.');
    }
    
    public function showTask($id){
        $task = Task::with('category')->where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        return view('tasks.show', ['task' => $task]);
    }

    public function toggleComplete($id){
        $task = Task::where('user_id', auth()->id())->findOrFail($id);

        $task->is_completed = !$task->is_completed;

        $task->completed_at = $task->is_completed ? now() : null;

        $task->save();

        return response()->json([
            'success' => true,
            'status' => $task->is_completed ? 'completed' : 'reopened'
        ]);
    }

    public function toggleImportant($id){
        $task = Task::where('user_id', auth()->id())->findOrFail($id);

        $task->is_important = !$task->is_important;

        $task->save();

        return response()->json([
            'success' => true,
            'status' => $task->is_important
        ]);
    }

    public function todayTask(Request $request){
        $categories = Category::all();

        $query = Task::with('category')->where('user_id', auth()->id())->where('due_date', Carbon::today());

        $status = $request->input('status', 'all'); // default 'all'
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('priority') && $request->priority != 'all') {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('category') && $request->category != 'all') {
            $query->where('category_id', $request->category);
        }

        switch ($request->sort) {
            case 'due_date':
                $query->orderBy('due_date', 'asc');
                break;
            case 'priority':
                // You can order by priority using FIELD for custom order if needed
                $query->orderByRaw("FIELD(priority, 'high', 'medium', 'low')");
                break;
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            default: // latest first
                $query->latest();
                break;
        }

        $tasks = $query->paginate(10)->withQueryString();

        $counts = [
            'all' => Task::where('user_id', auth()->id())->where('due_date', Carbon::today())->count(),
            'pending' => Task::where('user_id', auth()->id())->where('status', 'pending')->where('due_date', Carbon::today())->count(),
            'in_progress' => Task::where('user_id', auth()->id())->where('status', 'in_progress')->where('due_date', Carbon::today())->count(),
            'completed' => Task::where('user_id', auth()->id())->where('status', 'completed')->where('due_date', Carbon::today())->count(),
        ];

        return view('tasks.today', ['tasks' => $tasks, 'categories' => $categories, 'counts' => $counts, 'status' => $status]);
    }

    public function taskCompleted(Request $request){
        $categories = Category::all();

        $query = Task::with('category')->where('user_id', auth()->id())->where('is_completed', 1);

        $status = $request->input('status', 'all'); // default 'all'
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('priority') && $request->priority != 'all') {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('category') && $request->category != 'all') {
            $query->where('category_id', $request->category);
        }

        switch ($request->sort) {
            case 'due_date':
                $query->orderBy('due_date', 'asc');
                break;
            case 'priority':
                // You can order by priority using FIELD for custom order if needed
                $query->orderByRaw("FIELD(priority, 'high', 'medium', 'low')");
                break;
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            default: // latest first
                $query->latest();
                break;
        }

        $tasks = $query->paginate(10)->withQueryString();

        $counts = [
            'all' => Task::where('user_id', auth()->id())->where('is_completed', 1)->count()
        ];

        return view('tasks.completed', ['tasks' => $tasks, 'categories' => $categories, 'counts' => $counts, 'status' => $status]);
    }

    public function taskImportant(Request $request){
        $categories = Category::all();

        $query = Task::with('category')->where('user_id', auth()->id())->where('is_important', 1);

        $status = $request->input('status', 'all'); // default 'all'
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('priority') && $request->priority != 'all') {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('category') && $request->category != 'all') {
            $query->where('category_id', $request->category);
        }

        switch ($request->sort) {
            case 'due_date':
                $query->orderBy('due_date', 'asc');
                break;
            case 'priority':
                // You can order by priority using FIELD for custom order if needed
                $query->orderByRaw("FIELD(priority, 'high', 'medium', 'low')");
                break;
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            default: // latest first
                $query->latest();
                break;
        }

        $tasks = $query->paginate(10)->withQueryString();

        $counts = [
            'all' => Task::where('user_id', auth()->id())->where('is_important', 1)->count(),
            'pending' => Task::where('user_id', auth()->id())->where('status', 'pending')->where('is_important', 1)->count(),
            'in_progress' => Task::where('user_id', auth()->id())->where('status', 'in_progress')->where('is_important', 1)->count(),
            'completed' => Task::where('user_id', auth()->id())->where('status', 'completed')->where('is_important', 1)->count(),
        ];

        return view('tasks.today', ['tasks' => $tasks, 'categories' => $categories, 'counts' => $counts, 'status' => $status]);
    }

    public function taskOverdue(Request $request){
        $categories = Category::all();

        $query = Task::with('category')
                ->where('user_id', auth()->id())
                ->where('due_date', '<' ,Carbon::today())
                ->where('is_completed', 0);

        $status = $request->input('status', 'all'); // default 'all'
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('priority') && $request->priority != 'all') {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('category') && $request->category != 'all') {
            $query->where('category_id', $request->category);
        }

        switch ($request->sort) {
            case 'due_date':
                $query->orderBy('due_date', 'asc');
                break;
            case 'priority':
                // You can order by priority using FIELD for custom order if needed
                $query->orderByRaw("FIELD(priority, 'high', 'medium', 'low')");
                break;
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            default: // latest first
                $query->latest();
                break;
        }

        $tasks = $query->paginate(10)->withQueryString();

        $counts = [
            'all' => Task::where('user_id', auth()->id())->where('is_completed', 0)->where('due_date', '<' , Carbon::today())->count(),
            'pending' => Task::where('user_id', auth()->id())->where('is_completed', 0)->where('status', 'pending')->where('due_date', '<' , Carbon::today())->count(),
            'in_progress' => Task::where('user_id', auth()->id())->where('is_completed', 0)->where('status', 'in_progress')->where('due_date', '<' , Carbon::today())->count(),
            'completed' => Task::where('user_id', auth()->id())->where('is_completed', 0)->where('status', 'completed')->where('due_date','<' ,  Carbon::today())->count(),
        ]; 

        return view('tasks.overdue', ['tasks' => $tasks, 'categories' => $categories, 'counts' => $counts, 'status' => $status]);
    }

    public function categoryTasks($id, Request $request){
        $categories = Category::all();

        $query = Task::with('category')->where('user_id', auth()->id())->where('category_id', $id);

        $status = $request->input('status', 'all'); // default 'all'
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('priority') && $request->priority != 'all') {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('category') && $request->category != 'all') {
            $query->where('category_id', $request->category);
        }

        switch ($request->sort) {
            case 'due_date':
                $query->orderBy('due_date', 'asc');
                break;
            case 'priority':
                // You can order by priority using FIELD for custom order if needed
                $query->orderByRaw("FIELD(priority, 'high', 'medium', 'low')");
                break;
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            default: // latest first
                $query->latest();
                break;
        }

        $tasks = $query->paginate(10)->withQueryString();

        $counts = [
            'all' => Task::where('user_id', auth()->id())->where('category_id', $id)->count(),
            'pending' => Task::where('user_id', auth()->id())->where('status', 'pending')->where('category_id', $id)->count(),
            'in_progress' => Task::where('user_id', auth()->id())->where('status', 'in_progress')->where('category_id', $id)->count(),
            'completed' => Task::where('user_id', auth()->id())->where('status', 'completed')->where('category_id', $id)->count(),
        ];
        $category_id = $id;
        return view('tasks.categoryTasks', ['tasks' => $tasks, 'categories' => $categories, 'counts' => $counts, 'status' => $status, 'cat_id' => $category_id]);
    }
}
