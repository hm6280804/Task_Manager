

<?php $__env->startSection('title', 'All Categories'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1 class="page-title">Work Categories</h1>
        <p class="page-subtitle">Organize your tasks with custom categories</p>
    </div>
    <a href="<?php echo e(route('category.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>New Category
    </a>
</div>

<!-- Categories Grid -->
<?php if($categories->isEmpty()): ?>
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="bi bi-folder-x" style="font-size: 60px; color: #6c757d;"></i>
            <h4 class="mt-3">No Categories Yet</h4>
            <p class="text-muted">Create your first category to organize your tasks</p>
            <a href="<?php echo e(route('category.create')); ?>" class="btn btn-primary mt-3">
                <i class="bi bi-plus-circle me-2"></i>Create Category
            </a>
        </div>
    </div>
<?php else: ?>
    <div class="row">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 category-card" style="border-left: 4px solid <?php echo e($category->color); ?>;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="category-icon" style="background: <?php echo e($category->color); ?>20; color: <?php echo e($category->color); ?>;">
                                    <i class="<?php echo e($category->icon ?? 'bi-folder'); ?>"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0"><?php echo e($category->name); ?></h5>
                                    <small class="text-muted">category->task_count</small>
                                </div>
                            </div>
                            
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="">
                                            <i class="bi bi-eye me-2"></i>View Tasks
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo e(route('category.edit', $category->id)); ?>">
                                            <i class="bi bi-pencil me-2"></i>Edit
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="<?php echo e(route('category.delete', $category->id)); ?>" method="POST" 
                                              onsubmit="return confirm('Are you sure? Tasks will be unassigned from this category.')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="bi bi-trash me-2"></i>Delete
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            <?php echo e($categories->links()); ?>

                        </div>

                        <?php if($category->description): ?>
                            <p class="text-muted small mb-3"><?php echo e($category->description); ?></p>
                        <?php endif; ?>

                        <!-- Progress Bar -->
                        

                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <small class="text-muted">Progress</small>
                                <small class="text-muted">completed task/total tasks</small>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar" 
                                     role="progressbar" 
                                     style="width: 50%; background-color: <?php echo e($category->color); ?>;"
                                     aria-valuenow="50" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                </div>
                            </div>
                        </div>

                        <a href="" class="btn btn-outline-primary btn-sm w-100">
                            View All Tasks
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .category-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
    }

    .category-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .progress-bar {
        transition: width 0.5s ease;
    }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Software_Development\laravel_Projects\Task_Management\resources\views/categories/workIndex.blade.php ENDPATH**/ ?>