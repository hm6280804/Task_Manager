<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Task Management System'); ?></title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Custom Styles -->
    <style>
        :root {
            --primary-color: #023B7E;
            --secondary-color: #d6001c;
            --sidebar-width: 260px;
            --topbar-height: 65px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            overflow-x: hidden;
        }

        /* Topbar */
        .topbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--topbar-height);
            background: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo i {
            font-size: 28px;
        }

        .menu-toggle {
            display: none;
            font-size: 24px;
            background: none;
            border: none;
            color: white;
            cursor: pointer;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 8px 15px;
            border-radius: 8px;
            transition: background 0.3s;
            position: relative;
        }

        .user-menu:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 16px;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 600;
            font-size: 14px;
        }

        .user-role {
            font-size: 12px;
            opacity: 0.8;
        }

        /* Dropdown Menu */
        .dropdown-menu {
            min-width: 200px;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: var(--topbar-height);
            left: 0;
            width: var(--sidebar-width);
            height: calc(100vh - var(--topbar-height));
            background: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            overflow-y: auto;
            transition: transform 0.3s ease;
            z-index: 999;
        }

        .sidebar-nav {
            padding: 20px 0;
        }

        .nav-section {
            margin-bottom: 25px;
        }

        .nav-section-title {
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .nav-item {
            margin-bottom: 5px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 25px;
            color: #495057;
            text-decoration: none;
            transition: all 0.3s;
            position: relative;
        }

        .nav-link i {
            font-size: 20px;
            width: 24px;
        }

        .nav-link:hover {
            background: #f8f9fa;
            color: var(--primary-color);
        }

        .nav-link.active {
            background: linear-gradient(90deg, rgba(2, 59, 126, 0.1) 0%, transparent 100%);
            color: var(--primary-color);
            font-weight: 600;
            border-left: 4px solid var(--primary-color);
        }

        .badge {
            margin-left: auto;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--topbar-height);
            padding: 30px;
            min-height: calc(100vh - var(--topbar-height));
            transition: margin-left 0.3s ease;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .page-subtitle {
            color: #6c757d;
            font-size: 14px;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
        }

        .card-header {
            background: white;
            border-bottom: 1px solid #e9ecef;
            padding: 20px;
            font-weight: 600;
            color: var(--primary-color);
        }

        .card-body {
            padding: 20px;
        }

        /* Buttons */
        .btn-primary {
            background: var(--primary-color);
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-primary:hover {
            background: #012f63;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .menu-toggle {
                display: block;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .user-info {
                display: none;
            }
        }

        /* Sidebar Scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

    <!-- Topbar -->
    <div class="topbar">
        <div class="topbar-left">
            <button class="menu-toggle" id="menuToggle">
                <i class="bi bi-list"></i>
            </button>
            <div class="logo">
                <i class="bi bi-check2-square"></i>
                <span>TaskFlow</span>
            </div>
        </div>

        <div class="topbar-right">
            <!-- Notifications -->
            <div class="dropdown">
                <button class="btn btn-link text-white position-relative" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-bell" style="font-size: 20px;"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        3
                    </span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><h6 class="dropdown-header">Notifications</h6></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-clock me-2"></i>Task due tomorrow</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-check-circle me-2"></i>Task completed</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-exclamation-circle me-2"></i>Overdue task</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-center" href="#">View all</a></li>
                </ul>
            </div>

            <!-- User Menu -->
            <div class="dropdown">
                <div class="user-menu" data-bs-toggle="dropdown">
                    <div class="user-avatar">
                        <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                    </div>
                    <div class="user-info">
                        <div class="user-name"><?php echo e(Auth::user()->name); ?></div>
                        <div class="user-role">User</div>
                    </div>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="<?php echo e(route('profile.show')); ?>">
                            <i class="bi bi-person me-2"></i>Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="<?php echo e(route('settings.show')); ?>">
                            <i class="bi bi-gear me-2"></i>Settings
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="<?php echo e(route('auth.logout')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <nav class="sidebar-nav">
            <!-- Main Menu -->
            <div class="nav-section">
                <div class="nav-section-title">Main Menu</div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="<?php echo e(route('dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('tasks.index')); ?>" class="nav-link <?php echo e(request()->routeIs('tasks.*') ? 'active' : ''); ?>">
                            <i class="bi bi-list-task"></i>
                            <span>All Tasks</span>
                            <span class="badge bg-primary">12</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('tasks.create')); ?>" class="nav-link">
                            <i class="bi bi-plus-circle"></i>
                            <span>New Task</span>
                        </a>
                    </li>
                </ul>
            </div>
            <?php
                $sideBarCategoryCount = getCategoryCounts();
            ?>

            <!-- Categories -->
            <div class="nav-section">
                <div class="nav-section-title">Categories</div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="<?php echo e(route('categories.index')); ?>" class="nav-link <?php echo e(request()->routeIs('categories.*') ? 'active' : ''); ?>">
                            <i class="bi bi-folder"></i>
                            <span>All Categories</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('category.work.index')); ?>" class="nav-link">
                            <i class="bi bi-briefcase"></i>
                            <span>Work</span>
                            <span class="badge bg-info"><?php echo e($sideBarCategoryCount['workCount']); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('category.personal.index')); ?>" class="nav-link">
                            <i class="bi bi-person"></i>
                            <span>Personal</span>
                            <span class="badge bg-success"><?php echo e($sideBarCategoryCount['personalCount']); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('category.shopping.index')); ?>" class="nav-link">
                            <i class="bi bi-cart"></i>
                            <span>Shopping</span>
                            <span class="badge bg-warning"><?php echo e($sideBarCategoryCount['shoppingCount']); ?></span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Quick Links -->
            <div class="nav-section">
                <div class="nav-section-title">Quick Links</div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="<?php echo e(route('task.today')); ?>" class="nav-link">
                            <i class="bi bi-calendar-day"></i>
                            <span>Today's Tasks</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('task.important')); ?>" class="nav-link">
                            <i class="bi bi-star"></i>
                            <span>Important</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('task.completed')); ?>" class="nav-link">
                            <i class="bi bi-check-circle"></i>
                            <span>Completed</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('task.overdue')); ?>" class="nav-link">
                            <i class="bi bi-exclamation-triangle"></i>
                            <span>Overdue</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Flash Messages -->
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i><?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i><?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Page Content -->
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');

        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth <= 992) {
                if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                    sidebar.classList.remove('active');
                }
            }
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH D:\Software_Development\laravel_Projects\Task_Management\resources\views/layouts/app.blade.php ENDPATH**/ ?>