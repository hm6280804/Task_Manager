

<?php $__env->startSection('title', 'All Tasks'); ?>

<?php $__env->startSection('content'); ?>

    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Today Tasks To be Completed</h1>
            <p class="page-subtitle">Manage and organize your tasks</p>
        </div>
        <a href="<?php echo e(route('tasks.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>New Task
        </a>
    </div>

    <!-- Filter Tabs -->
    <div class="card mb-4">
        <div class="card-body">
            <ul class="nav nav-pills mb-3">
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request('status', 'all') == 'all' ? 'active' : ''); ?>"
                        href="<?php echo e(route('category.tasks', $cat_id)); ?>">
                        All <span class="badge bg-secondary ms-1"><?php echo e($counts['all']); ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request('status') == 'pending' ? 'active' : ''); ?>"
                        href="<?php echo e(route('category.tasks', [$cat_id, 'status' => 'pending'])); ?>">
                        Pending <span class="badge bg-warning ms-1"><?php echo e($counts['pending']); ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request('status') == 'in_progress' ? 'active' : ''); ?>"
                        href="<?php echo e(route('category.tasks', [$cat_id, 'status' => 'in_progress'])); ?>">
                        In Progress <span class="badge bg-info ms-1"><?php echo e($counts['in_progress']); ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request('status') == 'completed' ? 'active' : ''); ?>"
                        href="<?php echo e(route('category.tasks', [$cat_id, 'status' => 'completed'])); ?>">
                        Completed <span class="badge bg-success ms-1"><?php echo e($counts['completed']); ?></span>
                    </a>
                </li>
            </ul>

            <!-- Search and Filters -->
            <form method="GET" action="<?php echo e(route('category.tasks', $cat_id)); ?>" class="row g-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="search" placeholder="Search tasks..."
                        value="<?php echo e(request('search')); ?>">
                </div>
                <div class="col-md-2">
                    <select name="priority" class="form-select">
                        <option value="all">All Priorities</option>
                        <option value="high" <?php echo e(request('priority') == 'high' ? 'selected' : ''); ?>>High</option>
                        <option value="medium" <?php echo e(request('priority') == 'medium' ? 'selected' : ''); ?>>Medium</option>
                        <option value="low" <?php echo e(request('priority') == 'low' ? 'selected' : ''); ?>>Low</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="category" class="form-select">
                        <option value="all">All Categories</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>"
                                <?php echo e(request('category') == $category->id ? 'selected' : ''); ?>>
                                <?php echo e($category->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="sort" class="form-select">
                        <option value="latest" <?php echo e(request('sort') == 'latest' ? 'selected' : ''); ?>>Latest First</option>
                        <option value="due_date" <?php echo e(request('sort') == 'due_date' ? 'selected' : ''); ?>>Due Date</option>
                        <option value="priority" <?php echo e(request('sort') == 'priority' ? 'selected' : ''); ?>>Priority</option>
                        <option value="title" <?php echo e(request('sort') == 'title' ? 'selected' : ''); ?>>Title (A-Z)</option>
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
    <?php if($tasks->isEmpty()): ?>
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="bi bi-clipboard-x" style="font-size: 60px; color: #6c757d;"></i>
                <h4 class="mt-3">No Tasks Found</h4>
                <p class="text-muted">
                    <?php if(request('search') || request('status') != 'all' || request('priority') != 'all' || request('category') != 'all'): ?>
                        Try adjusting your filters or search query.
                    <?php else: ?>
                        Create your first task to get started!
                    <?php endif; ?>
                </p>
                <a href="" class="btn btn-primary mt-3">
                    <i class="bi bi-plus-circle me-2"></i>Create Task
                </a>
            </div>
        </div>
    <?php else: ?>
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
                            <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="task-row <?php echo e($task->is_completed ? 'completed-task' : ''); ?>">
                                    <td class="ps-4">
                                        <input type="checkbox" class="form-check-input task-checkbox"
                                            data-task-id="<?php echo e($task->id); ?>" <?php echo e($task->is_completed ? 'checked' : ''); ?>>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <?php if($task->is_important): ?>
                                                <i class="bi bi-star-fill text-warning"></i>
                                            <?php endif; ?>
                                            <div>
                                                <a href="<?php echo e(route('task.show', $task->id)); ?>" class="text-decoration-none fw-semibold <?php echo e($task->is_completed ? 'text-muted text-decoration-line-through' : ''); ?>">
                                                    <?php echo e($task->title); ?>

                                                </a>
                                                <?php if($task->description): ?>
                                                    <br>
                                                    <small
                                                        class="text-muted"><?php echo e(Str::limit($task->description, 50)); ?></small>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if($task->category): ?>
                                            <span class="badge d-inline-flex align-items-center"
                                                style="
                                                    background: <?php echo e($task->category->color); ?>20;
                                                    color: #000;
                                                    border: 1px solid <?php echo e($task->category->color); ?>40;
                                                ">
                                                <i class="<?php echo e($task->category->icon ?? 'bi-folder'); ?> me-1"></i>
                                                <?php echo e($task->category->name); ?>

                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Uncategorized</span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?php if(strtolower($task->priority) === 'high'): ?>
                                            <span class="badge bg-danger">High</span>
                                        <?php elseif(strtolower($task->priority) === 'medium'): ?>
                                            <span class="badge bg-warning text-dark">Medium</span>
                                        <?php elseif(strtolower($task->priority) === 'low'): ?>
                                            <span class="badge bg-success">Low</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">N/A</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($task->is_overdue): ?>
                                            <span class="badge bg-danger-subtle text-danger fw-semibold">
                                                <i class="bi bi-exclamation-circle me-1"></i>
                                                <?php echo e($task->due_date_label); ?>

                                            </span>
                                        <?php elseif($task->due_date): ?>
                                            <span class="badge bg-light text-dark">
                                                <i class="bi bi-calendar me-1"></i>
                                                <?php echo e($task->due_date_label); ?>

                                            </span>
                                        <?php else: ?>
                                            <span class="text-muted fst-italic">No due date</span>
                                        <?php endif; ?>
                                    </td>

                                    <td><?php echo $task->status_badge; ?></td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm">
                                            <a href="<?php echo e(route('task.show', $task->id)); ?>" class="btn btn-outline-primary"
                                                title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="<?php echo e(route('task.edit', $task->id)); ?>" class="btn btn-outline-secondary"
                                                title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="<?php echo e(route('task.delete', $task->id)); ?>" method="POST" class="d-inline"
                                                onsubmit="return confirm('Delete this task?')">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                                    title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-between align-items-center">
            <div class="text-muted">
                Showing <?php echo e($tasks->firstItem()); ?> to <?php echo e($tasks->lastItem()); ?> of <?php echo e($tasks->total()); ?> tasks
            </div>
            <div>
                <?php echo e($tasks->links()); ?>

            </div>
        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
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
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Software_Development\laravel_Projects\Task_Management\resources\views/tasks/categoryTasks.blade.php ENDPATH**/ ?>