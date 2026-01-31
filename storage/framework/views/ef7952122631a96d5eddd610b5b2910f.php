

<?php $__env->startSection('title', 'Dashboard - Task Management'); ?>

<?php $__env->startSection('content'); ?>

    <div class="page-header">
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">Welcome back, <?php echo e(Auth::user()->name); ?>! Here's your task overview.</p>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Tasks</h6>
                            <h2 class="mb-0"><?php echo e($allTasks ?? 0); ?></h2>
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
                            <h2 class="mb-0 text-warning"><?php echo e($pendingTasks ?? 0); ?></h2>
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
                            <h2 class="mb-0 text-success"><?php echo e($completedTasks ?? 0); ?></h2>
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
                            <h2 class="mb-0 text-danger"><?php echo e($overdueTasks); ?></h2>
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
                                <?php $__empty_1 = true; $__currentLoopData = $upcomingTasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <i class="bi bi-circle-fill text-primary me-2" style="font-size: 8px;"></i>
                                            <?php echo e($task->title); ?>

                                        </td>

                                        <td>
                                            <span class="badge bg-info">
                                                <?php echo e($task->category->name ?? '—'); ?>

                                            </span>
                                        </td>

                                        <td>
                                            <span
                                                class="badge 
                                                <?php echo e($task->priority === 'high' ? 'bg-danger' : ($task->priority === 'medium' ? 'bg-warning' : 'bg-success')); ?>">
                                                <?php echo e(ucfirst($task->priority)); ?>

                                            </span>
                                        </td>

                                        <td>
                                            <?php
                                                $dueDate = \Carbon\Carbon::parse($task->due_date);
                                            ?>

                                            <?php if($dueDate->isToday()): ?>
                                                Today
                                            <?php elseif($dueDate->isTomorrow()): ?>
                                                Tomorrow
                                            <?php else: ?>
                                                <?php echo e(now()->startOfDay()->diffInDays($dueDate->startOfDay(), false)); ?> days
                                                left
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <span class="badge bg-warning">
                                                <?php echo e(ucfirst($task->status)); ?>

                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">
                                            No upcoming tasks
                                        </td>
                                    </tr>
                                <?php endif; ?>
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
                        <?php $__empty_1 = true; $__currentLoopData = $todayTasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="d-flex align-items-start mb-3">
                                
                                <input type="checkbox" class="form-check-input me-3 mt-1"
                                    <?php echo e($task->status === 'completed' ? 'checked' : ''); ?> disabled>
                                <div class="flex-grow-1">
                                    <p class="mb-1">
                                        <?php if($task->status === 'completed'): ?>
                                            <del><strong><?php echo e($task->title); ?></strong></del>
                                        <?php else: ?>
                                            <strong><?php echo e($task->title); ?></strong>
                                        <?php endif; ?>
                                    </p>

                                    <?php if($task->status === 'completed'): ?>
                                        <small class="text-success">Completed</small>
                                    <?php else: ?>
                                        <small class="text-muted">
                                            Due: <?php echo e(\Carbon\Carbon::parse($task->due_time)->format('h:i A')); ?>

                                        </small>
                                    <?php endif; ?>
                                </div>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-muted text-center mb-0">
                                No tasks for today 🎉
                            </p>
                        <?php endif; ?>
                    </div>
                    <a href="<?php echo e(route('task.today')); ?>" class="btn btn-outline-primary btn-sm w-100">
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
                    <a href="<?php echo e(route('category.create')); ?>" class="btn btn-outline-primary w-100">
                        <i class="bi bi-folder-plus me-2"></i>Add Category
                    </a>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Software_Development\laravel_Projects\Task_Management\resources\views/dashboard.blade.php ENDPATH**/ ?>