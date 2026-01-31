

<?php $__env->startSection('title', 'Create Category'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">
    <h1 class="page-title">Create New Category</h1>
    <p class="page-subtitle">Add a new category to organize your tasks</p>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form action="<?php echo e(route('category.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <!-- Category Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               id="name" 
                               name="name" 
                               value="<?php echo e(old('name')); ?>" 
                               placeholder="e.g., Work, Personal, Shopping"
                               >
                        <?php $__errorArgs = ['name'];
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

                    <!-- Color Picker -->
                    <div class="mb-3">
                        <label for="color" class="form-label">Color <span class="text-danger">*</span></label>
                        <div class="d-flex gap-2 align-items-center">
                            <input type="color" 
                                   class="form-control form-control-color <?php $__errorArgs = ['color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="color" 
                                   name="color" 
                                   value="<?php echo e(old('color', '#023B7E')); ?>"
                                   style="width: 70px; height: 45px;">
                            <input type="text" 
                                   class="form-control" 
                                   id="colorHex" 
                                   value="<?php echo e(old('color', '#023B7E')); ?>"
                                   readonly>
                        </div>
                        <small class="text-muted">Choose a color to identify this category</small>
                        <?php $__errorArgs = ['color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Icon Selector -->
                    <div class="mb-3">
                        <label class="form-label">Icon (Optional)</label>
                        <input type="hidden" name="icon" id="selectedIcon" value="<?php echo e(old('icon', 'bi-folder')); ?>">
                        
                        <div class="icon-selector">
                            <div class="row g-2">
                                <?php
                                    $icons = [
                                        'bi-folder', 'bi-briefcase', 'bi-person', 'bi-cart', 
                                        'bi-heart-pulse', 'bi-book', 'bi-house', 'bi-laptop',
                                        'bi-camera', 'bi-music-note', 'bi-gift', 'bi-airplane',
                                        'bi-star', 'bi-lightbulb', 'bi-palette', 'bi-hammer'
                                    ];
                                ?>
                                <?php $__currentLoopData = $icons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-3 col-md-2">
                                        <div class="icon-option <?php echo e(old('icon', 'bi-folder') == $icon ? 'active' : ''); ?>" 
                                             data-icon="<?php echo e($icon); ?>">
                                            <i class="<?php echo e($icon); ?>"></i>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description (Optional)</label>
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
                                  rows="3" 
                                  placeholder="Brief description of this category"><?php echo e(old('description')); ?></textarea>
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
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-2"></i>Create Category
                        </button>
                        <a href="<?php echo e(route('categories.index')); ?>" class="btn btn-secondary">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Preview Card -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Preview</h5>
            </div>
            <div class="card-body">
                <div class="category-preview" id="categoryPreview">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="preview-icon" id="previewIcon">
                            <i class="bi-folder"></i>
                        </div>
                        <div>
                            <h5 class="mb-0" id="previewName">Category Name</h5>
                            <small class="text-muted">0 tasks</small>
                        </div>
                    </div>
                    <p class="text-muted small" id="previewDescription">Description will appear here</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .icon-option {
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 15px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 24px;
    }

    .icon-option:hover {
        border-color: #023B7E;
        background: #f8f9fa;
    }

    .icon-option.active {
        border-color: #023B7E;
        background: #023B7E;
        color: white;
    }

    .preview-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        background: #023B7E20;
        color: #023B7E;
    }

    .category-preview {
        padding: 20px;
        border-left: 4px solid #023B7E;
        background: #f8f9fa;
        border-radius: 8px;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Color picker sync
    const colorInput = document.getElementById('color');
    const colorHex = document.getElementById('colorHex');
    const previewIcon = document.getElementById('previewIcon');
    const categoryPreview = document.querySelector('.category-preview');

    colorInput.addEventListener('input', function() {
        colorHex.value = this.value;
        previewIcon.style.background = this.value + '20';
        previewIcon.style.color = this.value;
        categoryPreview.style.borderLeftColor = this.value;
    });

    // Icon selector
    const iconOptions = document.querySelectorAll('.icon-option');
    const selectedIconInput = document.getElementById('selectedIcon');
    const previewIconElement = previewIcon.querySelector('i');

    iconOptions.forEach(option => {
        option.addEventListener('click', function() {
            iconOptions.forEach(opt => opt.classList.remove('active'));
            this.classList.add('active');
            const icon = this.dataset.icon;
            selectedIconInput.value = icon;
            previewIconElement.className = icon;
        });
    });

    // Name preview
    const nameInput = document.getElementById('name');
    const previewName = document.getElementById('previewName');

    nameInput.addEventListener('input', function() {
        previewName.textContent = this.value || 'Category Name';
    });

    // Description preview
    const descriptionInput = document.getElementById('description');
    const previewDescription = document.getElementById('previewDescription');

    descriptionInput.addEventListener('input', function() {
        previewDescription.textContent = this.value || 'Description will appear here';
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Software_Development\laravel_Projects\Task_Management\resources\views/categories/create.blade.php ENDPATH**/ ?>