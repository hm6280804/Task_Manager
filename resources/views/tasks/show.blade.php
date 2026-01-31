@extends('layouts.app')

@section('title', $task->title . ' - Task Details')

@section('content')

    <!-- Header with Actions -->
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('tasks.index') }}" class="btn btn-light">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h1 class="page-title mb-0">Task Details</h1>
                <p class="page-subtitle mb-0">View complete task information</p>
            </div>
        </div>
        <div class="d-flex gap-2 align-items-stretch">
            <a href="{{ route('task.edit', $task->id) }}" class="btn btn-primary d-flex align-items-center">
                <i class="bi bi-pencil me-2"></i> Edit Task
            </a>

            <form action="{{ route('task.delete', $task->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this task?')">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger d-flex align-items-center h-100">
                    <i class="bi bi-trash me-2"></i> Delete
                </button>
            </form>
        </div>

    </div>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">

            <!-- Task Title Card -->
            <div class="card mb-4 {{ $task->is_completed ? 'border-success' : '' }}">
                <div class="card-body">
                    <div class="d-flex align-items-start gap-3">
                        <!-- Completion Checkbox -->
                        <div class="mt-1">
                            <input type="checkbox" class="form-check-input" id="taskCompleteCheckbox"
                                style="width: 24px; height: 24px; cursor: pointer;"
                                {{ $task->is_completed ? 'checked' : '' }}>
                        </div>

                        <div class="flex-grow-1">
                            <!-- Title with Star -->
                            <div class="d-flex align-items-center gap-2 mb-2">
                                @if ($task->is_important)
                                    <i class="bi bi-star-fill text-warning" style="font-size: 24px;"></i>
                                @endif
                                <h2 class="mb-0 {{ $task->is_completed ? 'text-decoration-line-through text-muted' : '' }}">
                                    {{ $task->title }}
                                </h2>
                            </div>

                            <!-- Status Badges -->
                            <div class="d-flex gap-2 flex-wrap mt-3">
                                @if ($task->category)
                                    <span class="badge"
                                        style="background: {{ $task->category->color }}20; color: {{ $task->category->color }}; font-size: 14px;">
                                        <i class="{{ $task->category->icon ?? 'bi-folder' }} me-1"></i>
                                        {{ $task->category->name }}
                                    </span>
                                @else
                                    <span class="badge bg-secondary" style="font-size: 14px;">Uncategorized</span>
                                @endif

                                {!! $task->priority_badge !!}
                                {!! $task->status_badge !!}

                                @if ($task->is_completed)
                                    <span class="badge bg-success" style="font-size: 14px;">
                                        <i class="bi bi-check-circle me-1"></i>Completed
                                    </span>
                                @endif

                                @if ($task->is_overdue && !$task->is_completed)
                                    <span class="badge bg-danger" style="font-size: 14px;">
                                        <i class="bi bi-exclamation-triangle me-1"></i>Overdue
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description Card -->
            @if ($task->description)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-file-text me-2"></i>Description
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-0" style="white-space: pre-wrap; line-height: 1.8;">{{ $task->description }}</p>
                    </div>
                </div>
            @endif

            <!-- Additional Notes Card -->
            @if ($task->notes)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-sticky me-2"></i>Additional Notes
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info mb-0">
                            <p class="mb-0" style="white-space: normal; line-height: 1.8;">
                                {{ $task->notes ?? 'No notes added.' }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Activity Timeline (Optional) -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-clock-history me-2"></i>Activity Timeline
                    </h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <p class="mb-1"><strong>Task Created</strong></p>
                                <small class="text-muted">
                                    <i class="bi bi-calendar me-1"></i>
                                    {{ $task->created_at->format('M d, Y') }} at {{ $task->created_at->format('h:i A') }}
                                </small>
                            </div>
                        </div>

                        @if ($task->updated_at != $task->created_at)
                            <div class="timeline-item">
                                <div class="timeline-marker bg-info"></div>
                                <div class="timeline-content">
                                    <p class="mb-1"><strong>Last Updated</strong></p>
                                    <small class="text-muted">
                                        <i class="bi bi-calendar me-1"></i>
                                        {{ $task->updated_at->format('M d, Y') }} at
                                        {{ $task->updated_at->format('h:i A') }}
                                    </small>
                                </div>
                            </div>
                        @endif

                        @if ($task->is_completed && $task->completed_at)
                            <div class="timeline-item">
                                <div class="timeline-marker bg-success"></div>
                                <div class="timeline-content">
                                    <p class="mb-1"><strong>Task Completed</strong></p>
                                    <small class="text-muted">
                                        <i class="bi bi-calendar me-1"></i>
                                        {{ \Carbon\Carbon::parse($task->completed_at)->format('M d, Y') }} at
                                        {{ \Carbon\Carbon::parse($task->completed_at)->format('h:i A') }}
                                    </small>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">

            <!-- Task Info Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="bi bi-info-circle me-2"></i>Task Information
                    </h6>
                </div>
                <div class="card-body">
                    <div class="info-item mb-3">
                        <label class="text-muted small mb-1">Priority</label>
                        <div>
                            @if ($task->priority === 'high')
                                <span class="badge bg-danger">High</span>
                            @elseif($task->priority === 'medium')
                                <span class="badge bg-warning text-dark">Medium</span>
                            @elseif($task->priority === 'low')
                                <span class="badge bg-success">Low</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($task->priority) }}</span>
                            @endif
                        </div>
                    </div>


                    <div class="info-item mb-3">
                        <label class="text-muted small mb-1">Status</label>
                        <div>{!! $task->status_badge !!}</div>
                    </div>

                    <div class="info-item mb-3">
                        <label class="text-muted small mb-1">Category</label>
                        <div>
                            @if ($task->category)
                                <a href="" class="text-decoration-none">
                                    <span class="badge"
                                        style="background: {{ $task->category->color }}20; color: {{ $task->category->color }};">
                                        <i class="{{ $task->category->icon ?? 'bi-folder' }} me-1"></i>
                                        {{ $task->category->name }}
                                    </span>
                                </a>
                            @else
                                <span class="badge bg-secondary">Uncategorized</span>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <div class="info-item mb-3">
                        <label class="text-muted small mb-1">
                            <i class="bi bi-calendar-event me-1"></i>Due Date
                        </label>
                        <div>
                            @if ($task->due_date)
                                <span
                                    class="{{ $task->is_overdue && !$task->is_completed ? 'text-danger fw-semibold' : '' }}">
                                    {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                                    @if ($task->due_time)
                                        at {{ date('h:i A', strtotime($task->due_time)) }}
                                    @endif
                                </span>
                                @if ($task->is_overdue && !$task->is_completed)
                                    <br><small class="text-danger">
                                        <i class="bi bi-exclamation-circle me-1"></i>
                                        Overdue by {{ \Carbon\Carbon::parse($task->due_date)->diffForHumans(null, true) }}
                                    </small>
                                @elseif(\Carbon\Carbon::parse($task->due_date)->isFuture() && !$task->is_completed)
                                    <br><small class="text-muted">
                                        {{ \Carbon\Carbon::parse($task->due_date)->diffForHumans() }}
                                    </small>
                                @endif
                            @else
                                <span class="text-muted">No due date set</span>
                            @endif
                        </div>
                    </div>

                    <div class="info-item mb-3">
                        <label class="text-muted small mb-1">
                            <i class="bi bi-clock me-1"></i>Created
                        </label>
                        <div>{{ $task->created_at->format('M d, Y h:i A') }}</div>
                    </div>

                    @if ($task->is_completed)
                        <div class="info-item">
                            <label class="text-muted small mb-1">
                                <i class="bi bi-check-circle me-1"></i>Completed
                            </label>
                            <div>{{ \Carbon\Carbon::parse($task->completed_at)->format('M d, Y h:i A') }}</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="bi bi-lightning me-2"></i>Quick Actions
                    </h6>
                </div>
                <div class="card-body">
                    <button class="btn btn-outline-primary w-100 mb-2" id="quickToggle" data-id="{{ $task->id }}">
                        @if ($task->is_completed)
                            <i class="bi bi-arrow-counterclockwise me-2"></i>Reopen Task
                        @else
                            <i class="bi bi-check-circle me-2"></i>Complete Task
                        @endif
                    </button>

                    <a href="{{ route('task.edit', $task->id) }}" class="btn btn-outline-secondary w-100 mb-2">
                        <i class="bi bi-pencil me-2"></i>Edit Details
                    </a>

                    <button class="btn btn-outline-warning w-100 mb-2" onclick="toggleImportant({{ $task->id }})">
                        @if ($task->is_important)
                            <i class="bi bi-star me-2"></i>Remove Star
                        @else
                            <i class="bi bi-star-fill me-2"></i>Mark Important
                        @endif
                    </button>

                    <hr>

                    <form action="{{ route('task.delete', $task->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this task? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="bi bi-trash me-2"></i>Delete Task
                        </button>
                    </form>
                </div>
            </div>
    </div>
</div>

@endsection

@push('styles')
    <style>
                .card-header h5,
                .card-header h6 {
                    color: #023B7E;
                }

                .info-item label {
                    display: block;
                    font-weight: 600;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                }

                /* Timeline Styles */
                .timeline {
                    position: relative;
                    padding-left: 30px;
                }

                .timeline::before {
                    content: '';
                    position: absolute;
                    left: 8px;
                    top: 0;
                    bottom: 0;
                    width: 2px;
                    background: #e9ecef;
                }

                .timeline-item {
                    position: relative;
                    padding-bottom: 20px;
                }

                .timeline-item:last-child {
                    padding-bottom: 0;
                }

                .timeline-marker {
                    position: absolute;
                    left: -26px;
                    width: 16px;
                    height: 16px;
                    border-radius: 50%;
                    border: 3px solid white;
                    box-shadow: 0 0 0 2px #e9ecef;
                }

                .timeline-content {
                    padding-left: 10px;
                }

                .hover-bg:hover {
                    background: #f8f9fa;
                }

                .badge {
                    font-size: 13px;
                    padding: 6px 12px;
                }
            </style>
@endpush

@push('scripts')
    <script>
        // Toggle completion via both buttons and checkbox
        // const toggleButtons = document.querySelectorAll('#toggleComplete, #quickToggle');
        const toggleButtons = document.querySelectorAll('#quickToggle');
        const checkbox = document.getElementById('taskCompleteCheckbox');

        function toggleTaskCompletion(event) {
            const taskId = event.currentTarget.dataset.id;
            fetch(`/tasks/${taskId}/toggle`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to update task. Please try again.');
                });
        }

        toggleButtons.forEach(button => {
            button.addEventListener('click', toggleTaskCompletion);
        });

        checkbox.addEventListener('change', function() {
            toggleTaskCompletion();
        });

        // Toggle important (you'll need to create this route)
        function toggleImportant(taskId) {
            fetch(`/task/${taskId}/toggle-important`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to update task. Please try again.');
                });
        }
    </script>
@endpush
)
