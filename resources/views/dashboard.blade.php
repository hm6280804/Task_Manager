@extends('layouts.app')

@section('title', 'Dashboard - Task Management')

@section('content')

    <div class="page-header">
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">Welcome back, {{ Auth::user()->name }}! Here's your task overview.</p>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Tasks</h6>
                            <h2 class="mb-0">{{ $allTasks ?? 0 }}</h2>
                        </div>
                        <div class="text-primary" style="font-size: 40px;">
                            <i class="bi bi-list-task"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Pending</h6>
                            <h2 class="mb-0 text-warning">{{ $pendingTasks ?? 0 }}</h2>
                        </div>
                        <div class="text-warning" style="font-size: 40px;">
                            <i class="bi bi-clock"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Completed</h6>
                            <h2 class="mb-0 text-success">{{ $completedTasks ?? 0 }}</h2>
                        </div>
                        <div class="text-success" style="font-size: 40px;">
                            <i class="bi bi-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Overdue</h6>
                            <h2 class="mb-0 text-danger">{{ $overdueTasks }}</h2>
                        </div>
                        <div class="text-danger" style="font-size: 40px;">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Tasks & Today's Tasks -->
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Recent Tasks</span>
                    <a href="" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Task</th>
                                    <th>Category</th>
                                    <th>Priority</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($upcomingTasks as $task)
                                    <tr>
                                        <td>
                                            <i class="bi bi-circle-fill text-primary me-2" style="font-size: 8px;"></i>
                                            {{ $task->title }}
                                        </td>

                                        <td>
                                            <span class="badge bg-info">
                                                {{ $task->category->name ?? '—' }}
                                            </span>
                                        </td>

                                        <td>
                                            <span
                                                class="badge 
                                                {{ $task->priority === 'high' ? 'bg-danger' : ($task->priority === 'medium' ? 'bg-warning' : 'bg-success') }}">
                                                {{ ucfirst($task->priority) }}
                                            </span>
                                        </td>

                                        <td>
                                            @php
                                                $dueDate = \Carbon\Carbon::parse($task->due_date);
                                            @endphp

                                            @if ($dueDate->isToday())
                                                Today
                                            @elseif($dueDate->isTomorrow())
                                                Tomorrow
                                            @else
                                                {{ now()->startOfDay()->diffInDays($dueDate->startOfDay(), false) }} days
                                                left
                                            @endif
                                        </td>

                                        <td>
                                            <span class="badge bg-warning">
                                                {{ ucfirst($task->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">
                                            No upcoming tasks
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header">
                    Today's Tasks
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        @forelse ($todayTasks as $task)
                            <div class="d-flex align-items-start mb-3">
                                {{-- Checkbox --}}
                                <input type="checkbox" class="form-check-input me-3 mt-1"
                                    {{ $task->status === 'completed' ? 'checked' : '' }} disabled>
                                <div class="flex-grow-1">
                                    <p class="mb-1">
                                        @if ($task->status === 'completed')
                                            <del><strong>{{ $task->title }}</strong></del>
                                        @else
                                            <strong>{{ $task->title }}</strong>
                                        @endif
                                    </p>

                                    @if ($task->status === 'completed')
                                        <small class="text-success">Completed</small>
                                    @else
                                        <small class="text-muted">
                                            Due: {{ \Carbon\Carbon::parse($task->due_time)->format('h:i A') }}
                                        </small>
                                    @endif
                                </div>

                            </div>
                        @empty
                            <p class="text-muted text-center mb-0">
                                No tasks for today 🎉
                            </p>
                        @endforelse
                    </div>
                    <a href="{{ route('task.today') }}" class="btn btn-outline-primary btn-sm w-100">
                        View All Today's Tasks
                    </a>
                </div>
            </div>


            <div class="card mt-4">
                <div class="card-header">
                    Quick Actions
                </div>
                <div class="card-body">
                    <a href="" class="btn btn-primary w-100 mb-2">
                        <i class="bi bi-plus-circle me-2"></i>Create New Task
                    </a>
                    <a href="{{ route('category.create') }}" class="btn btn-outline-primary w-100">
                        <i class="bi bi-folder-plus me-2"></i>Add Category
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
