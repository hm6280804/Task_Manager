

<?php $__env->startSection('title', 'Settings'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header mb-4">
    <h1 class="page-title">Settings</h1>
    <p class="page-subtitle">Customize your task management experience</p>
</div>

<div class="row">
    <!-- Settings Navigation -->
    <div class="col-lg-3">
        <div class="card sticky-top" style="top: 80px;">
            <div class="list-group list-group-flush">
                <a href="#general" class="list-group-item list-group-item-action active" data-bs-toggle="list">
                    <i class="bi bi-gear me-2"></i>General
                </a>
                <a href="#notifications" class="list-group-item list-group-item-action" data-bs-toggle="list">
                    <i class="bi bi-bell me-2"></i>Notifications
                </a>
                <a href="#appearance" class="list-group-item list-group-item-action" data-bs-toggle="list">
                    <i class="bi bi-palette me-2"></i>Appearance
                </a>
                <a href="#privacy" class="list-group-item list-group-item-action" data-bs-toggle="list">
                    <i class="bi bi-shield-lock me-2"></i>Privacy & Security
                </a>
                <a href="#data" class="list-group-item list-group-item-action" data-bs-toggle="list">
                    <i class="bi bi-database me-2"></i>Data Management
                </a>
            </div>
        </div>
    </div>

    <!-- Settings Content -->
    <div class="col-lg-9">
        <div class="tab-content">
            
            <!-- General Settings -->
            <div class="tab-pane fade show active" id="general">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-gear me-2"></i>General Settings
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                        
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Language</label>
                                <select class="form-select" name="language">
                                    <option value="en" selected>English</option>
                                    <option value="es">Spanish</option>
                                    <option value="fr">French</option>
                                </select>
                                <small class="text-muted">Select your preferred language</small>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Time Zone</label>
                                <select class="form-select" name="timezone">
                                    <option value="UTC" selected>UTC (Coordinated Universal Time)</option>
                                    <option value="EST">EST (Eastern Standard Time)</option>
                                    <option value="PST">PST (Pacific Standard Time)</option>
                                    <option value="GMT">GMT (Greenwich Mean Time)</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Date Format</label>
                                <select class="form-select" name="date_format">
                                    <option value="MM/DD/YYYY" selected>MM/DD/YYYY</option>
                                    <option value="DD/MM/YYYY">DD/MM/YYYY</option>
                                    <option value="YYYY-MM-DD">YYYY-MM-DD</option>
                                </select>
                            </div>

                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="autoSave" checked>
                                <label class="form-check-label" for="autoSave">
                                    Enable auto-save
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>Save Changes
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Notifications Settings -->
            <div class="tab-pane fade" id="notifications">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-bell me-2"></i>Notification Preferences
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                        
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="notification-section mb-4">
                                <h6 class="mb-3">Email Notifications</h6>
                                
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="emailNotifications" 
                                           name="email_notifications" 
                                           <?php echo e(session('email_notifications', true) ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="emailNotifications">
                                        <strong>Enable email notifications</strong>
                                        <br><small class="text-muted">Receive updates via email</small>
                                    </label>
                                </div>

                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="taskReminders" 
                                           name="task_reminders"
                                           <?php echo e(session('task_reminders', true) ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="taskReminders">
                                        <strong>Task reminders</strong>
                                        <br><small class="text-muted">Get reminded about upcoming tasks</small>
                                    </label>
                                </div>

                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="overdueAlerts" 
                                           name="overdue_alerts"
                                           <?php echo e(session('overdue_alerts', true) ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="overdueAlerts">
                                        <strong>Overdue task alerts</strong>
                                        <br><small class="text-muted">Be notified when tasks are overdue</small>
                                    </label>
                                </div>
                            </div>

                            <div class="notification-section mb-4">
                                <h6 class="mb-3">Push Notifications</h6>
                                
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="pushNotifications">
                                    <label class="form-check-label" for="pushNotifications">
                                        <strong>Enable push notifications</strong>
                                        <br><small class="text-muted">Get instant updates on your device</small>
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>Save Notification Settings
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Appearance Settings -->
            <div class="tab-pane fade" id="appearance">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-palette me-2"></i>Appearance
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                        
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Theme</label>
                                <div class="theme-selector">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <input type="radio" class="btn-check" name="theme" id="lightTheme" value="light" checked>
                                            <label class="theme-option" for="lightTheme">
                                                <div class="theme-preview light">
                                                    <div class="theme-preview-header"></div>
                                                    <div class="theme-preview-sidebar"></div>
                                                    <div class="theme-preview-content"></div>
                                                </div>
                                                <div class="theme-name">Light</div>
                                            </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" class="btn-check" name="theme" id="darkTheme" value="dark">
                                            <label class="theme-option" for="darkTheme">
                                                <div class="theme-preview dark">
                                                    <div class="theme-preview-header"></div>
                                                    <div class="theme-preview-sidebar"></div>
                                                    <div class="theme-preview-content"></div>
                                                </div>
                                                <div class="theme-name">Dark</div>
                                            </label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" class="btn-check" name="theme" id="autoTheme" value="auto">
                                            <label class="theme-option" for="autoTheme">
                                                <div class="theme-preview auto">
                                                    <div class="theme-preview-header"></div>
                                                    <div class="theme-preview-sidebar"></div>
                                                    <div class="theme-preview-content"></div>
                                                </div>
                                                <div class="theme-name">Auto</div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Tasks Per Page</label>
                                <select class="form-select" name="tasks_per_page">
                                    <option value="10">10 tasks</option>
                                    <option value="15" selected>15 tasks</option>
                                    <option value="25">25 tasks</option>
                                    <option value="50">50 tasks</option>
                                </select>
                            </div>

                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="compactView">
                                <label class="form-check-label" for="compactView">
                                    Compact view (show more tasks on screen)
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>Save Appearance Settings
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Privacy & Security -->
            <div class="tab-pane fade" id="privacy">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-shield-lock me-2"></i>Privacy & Security
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h6 class="mb-3">Two-Factor Authentication</h6>
                            <p class="text-muted mb-3">Add an extra layer of security to your account</p>
                            <button class="btn btn-outline-primary">
                                <i class="bi bi-shield-check me-2"></i>Enable 2FA
                            </button>
                        </div>

                        <hr>

                        <div class="mb-4">
                            <h6 class="mb-3">Active Sessions</h6>
                            <p class="text-muted mb-3">Manage your active sessions across devices</p>
                            
                            <div class="session-item mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="bi bi-laptop me-2"></i>
                                        <strong>Current Device</strong>
                                        <br><small class="text-muted">Last active: Just now</small>
                                    </div>
                                    <span class="badge bg-success">Active</span>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="mb-4">
                            <h6 class="mb-3">Login History</h6>
                            <button class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-clock-history me-2"></i>View Login History
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Management -->
        <div class="tab-pane fade" id="data">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-database me-2"></i>Data Management
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="mb-3">Export Data</h6>
                        <p class="text-muted mb-3">Download all your tasks and categories</p>
                        <button class="btn btn-outline-primary">
                            <i class="bi bi-download me-2"></i>Export as CSV
                        </button>
                        <button class="btn btn-outline-primary">
                            <i class="bi bi-file-earmark-pdf me-2"></i>Export as PDF
                        </button>
                    </div>

                    <hr>

                    <div class="mb-4">
                        <h6 class="mb-3">Import Data</h6>
                        <p class="text-muted mb-3">Import tasks from CSV file</p>
                        <button class="btn btn-outline-secondary">
                            <i class="bi bi-upload me-2"></i>Import Tasks
                        </button>
                    </div>

                    <hr>

                    <div class="mb-4">
                        <h6 class="mb-3 text-danger">Danger Zone</h6>
                        
                        <div class="alert alert-danger">
                            <h6 class="alert-heading">
                                <i class="bi bi-exclamation-triangle me-2"></i>Delete All Tasks
                            </h6>
                            <p class="mb-2">Permanently delete all your tasks. This action cannot be undone.</p>
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure? This will delete ALL your tasks permanently!')">
                                Delete All Tasks
                            </button>
                        </div>

                        <div class="alert alert-danger">
                            <h6 class="alert-heading">
                                <i class="bi bi-person-x me-2"></i>Delete Account
                            </h6>
                            <p class="mb-2">Permanently delete your account and all associated data.</p>
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you absolutely sure? This action is irreversible!')">
                                Delete Account
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
<style>
    .card-header h5 {
        color: #023B7E;
    }

    .list-group-item.active {
        background-color: #023B7E;
        border-color: #023B7E;
    }

    .notification-section h6 {
        color: #023B7E;
        font-weight: 600;
    }

    .theme-option {
        cursor: pointer;
        display: block;
        padding: 15px;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        text-align: center;
        transition: all 0.3s;
    }

    .theme-option:hover {
        border-color: #023B7E;
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .btn-check:checked + .theme-option {
        border-color: #023B7E;
        background: #f8f9fa;
    }

    .theme-preview {
        width: 100%;
        height: 100px;
        border-radius: 8px;
        overflow: hidden;
        position: relative;
        margin-bottom: 10px;
    }

    .theme-preview.light {
        background: #f5f7fa;
    }

    .theme-preview.dark {
        background: #1a1a1a;
    }

    .theme-preview.auto {
        background: linear-gradient(90deg, #f5f7fa 50%, #1a1a1a 50%);
    }

    .theme-preview-header {
        height: 20px;
        background: #023B7E;
    }

    .theme-preview-sidebar {
        position: absolute;
        left: 0;
        top: 20px;
        bottom: 0;
        width: 30%;
        background: rgba(255, 255, 255, 0.5);
    }

    .theme-preview.dark .theme-preview-sidebar {
        background: rgba(255, 255, 255, 0.1);
    }

    .theme-preview-content {
        position: absolute;
        left: 30%;
        top: 30px;
        right: 10px;
        bottom: 10px;
        background: white;
        border-radius: 4px;
    }

    .theme-preview.dark .theme-preview-content {
        background: #2a2a2a;
    }

    .theme-name {
        font-weight: 600;
        color: #495057;
    }

    .session-item {
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .form-check-input:checked {
        background-color: #023B7E;
        border-color: #023B7E;
    }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Software_Development\laravel_Projects\Task_Management\resources\views/settings/index.blade.php ENDPATH**/ ?>