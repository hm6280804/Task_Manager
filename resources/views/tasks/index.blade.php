@extends('layouts.app')

@section('title', 'All Tasks')

@section('content')

    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">All Tasks</h1>
            <p class="page-subtitle">Manage and organize your tasks</p>
        </div>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>New Task
        </a>
    </div>

    <!-- Filter Tabs -->
    <div class="card mb-4">
        <div class="card-body">
            <ul class="nav nav-pills mb-3">
                <li class="nav-item">
                    <a class="nav-link {{ request('status', 'all') == 'all' ? 'active' : '' }}"
                        href="{{ route('tasks.index') }}">
                        All <span class="badge bg-secondary ms-1">{{ $counts['all'] }}</span>
                        {{-- All <span class="badge bg-secondary ms-1">{{ $counts['all'] }}</span> --}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('status') == 'pending' ? 'active' : '' }}"
                        href="{{ route('tasks.index', ['status' => 'pending']) }}">
                        Pending <span class="badge bg-warning ms-1">{{ $counts['pending'] }}</span>
                        {{-- Pending <span class="badge bg-warning ms-1">{{ $counts['pending'] }}</span> --}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('status') == 'in_progress' ? 'active' : '' }}"
                        href="{{ route('tasks.index', ['status' => 'in_progress']) }}">
                        In Progress <span class="badge bg-info ms-1">{{ $counts['in_progress'] }}</span>
                        {{-- In Progress <span class="badge bg-info ms-1">{{ $counts['in_progress'] }}</span> --}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('status') == 'completed' ? 'active' : '' }}"
                        href="{{ route('tasks.index', ['status' => 'completed']) }}">
                        Completed <span class="badge bg-success ms-1">{{ $counts['completed'] }}</span>
                        {{-- Completed <span class="badge bg-success ms-1">{{ $counts['completed'] }}</span> --}}
                    </a>
                </li>
            </ul>

            <!-- Search and Filters -->
            <form method="GET" action="{{ route('tasks.index') }}" class="row g-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="search" placeholder="Search tasks..."
                        value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <select name="priority" class="form-select">
                        <option value="all">All Priorities</option>
                        <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                        <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="category" class="form-select">
                        <option value="all">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="sort" class="form-select">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest First</option>
                        <option value="due_date" {{ request('sort') == 'due_date' ? 'selected' : '' }}>Due Date</option>
                        <option value="priority" {{ request('sort') == 'priority' ? 'selected' : '' }}>Priority</option>
                        <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Title (A-Z)</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-funnel me-2"></i>Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tasks Table -->
    @if ($tasks->isEmpty())
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="bi bi-clipboard-x" style="font-size: 60px; color: #6c757d;"></i>
                <h4 class="mt-3">No Tasks Found</h4>
                <p class="text-muted">
                    @if (request('search') || request('status') != 'all' || request('priority') != 'all' || request('category') != 'all')
                        Try adjusting your filters or search query.
                    @else
                        Create your first task to get started!
                    @endif
                </p>
                <a href="" class="btn btn-primary mt-3">
                    <i class="bi bi-plus-circle me-2"></i>Create Task
                </a>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="50" class="ps-4">
                                    <input type="checkbox" class="form-check-input" id="selectAll">
                                </th>
                                <th>Task</th>
                                <th>Category</th>
                                <th>Priority</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th width="120" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr class="task-row {{ $task->is_completed ? 'completed-task' : '' }}">
                                    <td class="ps-4">
                                        <input type="checkbox" class="form-check-input task-checkbox"
                                            data-task-id="{{ $task->id }}" {{ $task->is_completed ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            @if ($task->is_important)
                                                <i class="bi bi-star-fill text-warning"></i>
                                            @endif
                                            <div>
                                                <a href="{{ route('task.show', $task->id) }}" class="text-decoration-none fw-semibold {{ $task->is_completed ? 'text-muted text-decoration-line-through' : '' }}">
                                                    {{ $task->title }}
                                                </a>
                                                @if ($task->description)
                                                    <br>
                                                    <small
                                                        class="text-muted">{{ Str::limit($task->description, 50) }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($task->category)
                                            <span class="badge d-inline-flex align-items-center"
                                                style="
                                                    background: {{ $task->category->color }}20;
                                                    color: #000;
                                                    border: 1px solid {{ $task->category->color }}40;
                                                ">
                                                <i class="{{ $task->category->icon ?? 'bi-folder' }} me-1"></i>
                                                {{ $task->category->name }}
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">Uncategorized</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if (strtolower($task->priority) === 'high')
                                            <span class="badge bg-danger">High</span>
                                        @elseif(strtolower($task->priority) === 'medium')
                                            <span class="badge bg-warning text-dark">Medium</span>
                                        @elseif(strtolower($task->priority) === 'low')
                                            <span class="badge bg-success">Low</span>
                                        @else
                                            <span class="badge bg-secondary">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($task->is_overdue)
                                            <span class="badge bg-danger-subtle text-danger fw-semibold">
                                                <i class="bi bi-exclamation-circle me-1"></i>
                                                {{ $task->due_date_label }}
                                            </span>
                                        @elseif($task->due_date)
                                            <span class="badge bg-light text-dark">
                                                <i class="bi bi-calendar me-1"></i>
                                                {{ $task->due_date_label }}
                                            </span>
                                        @else
                                            <span class="text-muted fst-italic">No due date</span>
                                        @endif
                                    </td>

                                    <td>{!! $task->status_badge !!}</td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('task.show', $task->id) }}" class="btn btn-outline-primary"
                                                title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('task.edit', $task->id) }}" class="btn btn-outline-secondary"
                                                title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('task.delete', $task->id) }}" method="POST" class="d-inline"
                                                onsubmit="return confirm('Delete this task?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                                    title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-between align-items-center">
            <div class="text-muted">
                Showing {{ $tasks->firstItem() }} to {{ $tasks->lastItem() }} of {{ $tasks->total() }} tasks
            </div>
            <div>
                {{ $tasks->links() }}
            </div>
        </div>
    @endif

@endsection

@push('styles')
    <style>
        .task-row {
            transition: background 0.2s;
        }

        .task-row:hover {
            background: #f8f9fa;
        }

        .completed-task {
            opacity: 0.6;
        }

        .nav-pills .nav-link {
            color: #6c757d;
        }

        .nav-pills .nav-link.active {
            background: #023B7E;
        }

        .table th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            color: #6c757d;
            letter-spacing: 0.5px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Toggle task completion via AJAX
        document.querySelectorAll('.task-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const taskId = this.dataset.taskId;
                const isChecked = this.checked;

                fetch(`/tasks/${taskId}/toggle-complete`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Reload page to update UI
                            location.reload();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        this.checked = !isChecked; // Revert checkbox
                        alert('Failed to update task. Please try again.');
                    });
            });
        });

        // Select all checkboxes
        document.getElementById('selectAll')?.addEventListener('change', function() {
            document.querySelectorAll('.task-checkbox').forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    </script>
@endpush
