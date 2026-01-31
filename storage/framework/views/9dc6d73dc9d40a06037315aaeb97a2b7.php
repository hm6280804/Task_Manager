

<?php $__env->startSection('title', 'Create New Task'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">
    <h1 class="page-title">Update Your Task</h1>
    <p class="page-subtitle">Update your existing tasks.</p>
</div>

<form action="<?php echo e(route('task.update', $task->id)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <div class="row">
        <!-- Main Form -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Task Details</h5>
                </div>
                <div class="card-body">
                    
                    <!-- Task Title -->
                    <div class="mb-4">
                        <label for="title" class="form-label fw-semibold">
                            Task Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control form-control-md <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               id="title" 
                               name="title" 
                               value="<?php echo e($task->title); ?>" 
                               placeholder="e.g., Complete project proposal"
                               autofocus>
                        <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                  id="description" 
                                  name="description" 
                                  rows="4" 
                                  placeholder="Add more details about this task..."><?php echo e($task->description); ?></textarea>
                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <small class="text-muted">Optional: Provide additional context or instructions</small>
                    </div>

                    <!-- Category and Priority -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="category_id" class="form-label fw-semibold">Category</label>
                            <select class="form-select <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                    id="category_id" 
                                    name="category_id">
                                <option value="">Uncategorized</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>"
                                            <?php echo e(($task->category == $category) ? 'selected' : ''); ?>

                                            data-color="<?php echo e($category->color); ?>"
                                            data-icon="<?php echo e($category->icon); ?>">
                                        <?php echo e($category->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            
                            <?php if($categories->isEmpty()): ?>
                                <small class="text-muted">
                                    <a href="<?php echo e(route('categories.create')); ?>">Create a category</a> first
                                </small>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-6">
                            <label for="priority" class="form-label fw-semibold">
                                Priority <span class="text-danger">*</span>
                            </label>
                            <select class="form-select <?php $__errorArgs = ['priority'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                    id="priority" 
                                    name="priority" 
                                    required>
                                <option value="low" <?php echo e(($task->priority == 'low') ? 'selected' : ''); ?>>
                                    🟢 Low Priority
                                </option>
                                <option value="medium" <?php echo e(($task->priority == 'medium') ? 'selected' : ''); ?>>
                                    🟡 Medium Priority
                                </option>
                                <option value="high" <?php echo e(($task->priority == 'high') ? 'selected' : ''); ?>>
                                    🔴 High Priority
                                </option>
                            </select>
                            <?php $__errorArgs = ['priority'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <!-- Due Date and Time -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="due_date" class="form-label fw-semibold">Due Date</label>
                            <input type="date" 
                                   class="form-control <?php $__errorArgs = ['due_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="due_date" 
                                   name="due_date" 
                                   value="<?php echo e($task->due_date); ?>">
                            <?php $__errorArgs = ['due_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-md-6">
                            <label for="due_time" class="form-label fw-semibold">Due Time</label>
                            <input type="time" 
                                   class="form-control <?php $__errorArgs = ['due_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="due_time" 
                                   name="due_time" 
                                   value="<?php echo e(old('due_time', \Carbon\Carbon::parse($task->due_time)->format('H:i'))); ?>">
                            <?php $__errorArgs = ['due_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <label for="status" class="form-label fw-semibold">
                            Status <span class="text-danger">*</span>
                        </label>
                        <select class="form-select <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                id="status" 
                                name="status" 
                                required>
                            <option value="pending" <?php echo e(($task->status === 'pending') ? 'selected' : ''); ?>>
                                ⏳ Pending
                            </option>
                            <option value="in_progress" <?php echo e(($task->status === 'in_progress') ? 'selected' : ''); ?>>
                                🔄 In Progress
                            </option>
                            <option value="completed" <?php echo e(($task->status === 'completed') ? 'selected' : ''); ?>>
                                ✅ Completed
                            </option>
                        </select>
                        <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Additional Notes -->
                    <div class="mb-4">
                        <label for="notes" class="form-label fw-semibold">Additional Notes</label>
                        <textarea class="form-control <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                  id="notes" 
                                  name="notes" 
                                  rows="3" 
                                  placeholder="Any extra information or reminders..."><?php echo e($task->notes); ?></textarea>
                        <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>>
                    </div>

                    <!-- Important Checkbox -->
                    <div class="form-check mb-3">
                        <input class="form-check-input" 
                               type="checkbox" 
                               id="is_important" 
                               name="is_important" 
                               value="1"
                               <?php echo e(($task->is_important) ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="is_important">
                            <i class="bi bi-star text-warning me-1"></i>
                            Mark this task as important
                        </label>
                    </div>

                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            
            <!-- Quick Tips Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="bi bi-lightbulb text-warning me-2"></i>Quick Tips
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="small mb-0 ps-3">
                        <li class="mb-2">Use clear, action-oriented titles</li>
                        <li class="mb-2">Set realistic due dates</li>
                        <li class="mb-2">Break large tasks into smaller ones</li>
                        <li class="mb-2">Use categories to organize tasks</li>
                        <li class="mb-2">Mark important tasks with a star</li>
                    </ul>
                </div>
            </div>

            <!-- Task Preview Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="bi bi-eye me-2"></i>Preview
                    </h6>
                </div>
                <div class="card-body">
                    <div class="task-preview" id="taskPreview">
                        <div class="d-flex align-items-start gap-2 mb-2">
                            <i class="bi bi-star-fill text-warning" id="previewStar" style="display: none;"></i>
                            <div class="flex-grow-1">
                                <h6 class="mb-1" id="previewTitle">Your task title</h6>
                                <p class="text-muted small mb-2" id="previewDescription">Task description will appear here</p>
                            </div>
                        </div>
                        
                        <div class="d-flex gap-2 flex-wrap">
                            <span class="badge bg-secondary" id="previewCategory">Uncategorized</span>
                            <span class="badge bg-warning" id="previewPriority">Medium</span>
                            <span class="badge bg-warning" id="previewStatus">Pending</span>
                        </div>
                        
                        <div class="mt-3" id="previewDueDate" style="display: none;">
                            <small class="text-muted">
                                <i class="bi bi-calendar me-1"></i>
                                <span id="previewDueDateText"></span>
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="card">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary w-100 mb-2">
                        <i class="bi bi-check-circle me-2"></i>Update Task
                    </button>
                    <a href="<?php echo e(route('tasks.index')); ?>" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-x-circle me-2"></i>Cancel
                    </a>
                </div>
            </div>

        </div>
    </div>
</form>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .task-preview {
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
        border-left: 4px solid #023B7E;
    }

    .form-label {
        color: #023B7E;
    }

    .card-header h5,
    .card-header h6 {
        color: #023B7E;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Live Preview Updates
    const titleInput = document.getElementById('title');
    const descriptionInput = document.getElementById('description');
    const prioritySelect = document.getElementById('priority');
    const statusSelect = document.getElementById('status');
    const categorySelect = document.getElementById('category_id');
    const dueDateInput = document.getElementById('due_date');
    const dueTimeInput = document.getElementById('due_time');
    const importantCheckbox = document.getElementById('is_important');

    const previewTitle = document.getElementById('previewTitle');
    const previewDescription = document.getElementById('previewDescription');
    const previewPriority = document.getElementById('previewPriority');
    const previewStatus = document.getElementById('previewStatus');
    const previewCategory = document.getElementById('previewCategory');
    const previewDueDate = document.getElementById('previewDueDate');
    const previewDueDateText = document.getElementById('previewDueDateText');
    const previewStar = document.getElementById('previewStar');

    // Title
    titleInput.addEventListener('input', function() {
        previewTitle.textContent = this.value || 'Your task title';
    });

    // Description
    descriptionInput.addEventListener('input', function() {
        previewDescription.textContent = this.value || 'Task description will appear here';
    });

    // Priority
    prioritySelect.addEventListener('change', function() {
        const priorityMap = {
            'high': { text: 'High', class: 'bg-danger' },
            'medium': { text: 'Medium', class: 'bg-warning' },
            'low': { text: 'Low', class: 'bg-success' }
        };
        const selected = priorityMap[this.value];
        previewPriority.textContent = selected.text;
        previewPriority.className = 'badge ' + selected.class;
    });

    // Status
    statusSelect.addEventListener('change', function() {
        const statusMap = {
            'pending': { text: 'Pending', class: 'bg-warning' },
            'in_progress': { text: 'In Progress', class: 'bg-info' },
            'completed': { text: 'Completed', class: 'bg-success' }
        };
        const selected = statusMap[this.value];
        previewStatus.textContent = selected.text;
        previewStatus.className = 'badge ' + selected.class;
    });

    // Category
    categorySelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        if (this.value) {
            const color = selectedOption.dataset.color || '#023B7E';
            previewCategory.textContent = selectedOption.text;
            previewCategory.style.background = color + '20';
            previewCategory.style.color = color;
            previewCategory.className = 'badge';
        } else {
            previewCategory.textContent = 'Uncategorized';
            previewCategory.className = 'badge bg-secondary';
            previewCategory.style.background = '';
            previewCategory.style.color = '';
        }
    });

    // Due Date
    function updateDueDate() {
        if (dueDateInput.value) {
            const date = new Date(dueDateInput.value);
            let dateStr = date.toLocaleDateString('en-US', { 
                month: 'short', 
                day: 'numeric', 
                year: 'numeric' 
            });
            
            if (dueTimeInput.value) {
                dateStr += ' at ' + dueTimeInput.value;
            }
            
            previewDueDateText.textContent = dateStr;
            previewDueDate.style.display = 'block';
        } else {
            previewDueDate.style.display = 'none';
        }
    }

    dueDateInput.addEventListener('change', updateDueDate);
    dueTimeInput.addEventListener('change', updateDueDate);

    // Important Star
    importantCheckbox.addEventListener('change', function() {
        previewStar.style.display = this.checked ? 'inline-block' : 'none';
    });

    // Set due date to today by default (optional)
    // dueDateInput.value = new Date().toISOString().split('T')[0];
    // updateDueDate();
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Software_Development\laravel_Projects\Task_Management\resources\views/tasks/edit.blade.php ENDPATH**/ ?>