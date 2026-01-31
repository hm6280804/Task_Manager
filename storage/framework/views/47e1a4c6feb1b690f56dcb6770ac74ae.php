<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'A professional blog platform'); ?>">
    <meta name="keywords" content="<?php echo $__env->yieldContent('meta_keywords', 'blog, articles, news'); ?>">
    <title><?php echo $__env->yieldContent('title', 'Blog'); ?> - MyBlog</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #023B7E;
            --secondary-color: #d6001c;
            --text-color: #333;
            --light-bg: #f8f9fa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-color);
            line-height: 1.6;
        }

        /* Navbar */
        .navbar-custom {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 15px 0;
        }

        .navbar-brand {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary-color) !important;
        }

        .nav-link {
            color: var(--text-color) !important;
            font-weight: 500;
            margin: 0 10px;
            transition: color 0.3s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary-color) !important;
        }

        .btn-primary-custom {
            background: var(--primary-color);
            border: none;
            padding: 10px 25px;
            border-radius: 25px;
            color: white;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary-custom:hover {
            background: #012f63;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(2, 59, 126, 0.3);
        }

        /* Search Bar */
        .search-form {
            position: relative;
        }

        .search-input {
            border-radius: 25px;
            padding: 8px 40px 8px 20px;
            border: 2px solid #e9ecef;
            width: 250px;
        }

        .search-input:focus {
            border-color: var(--primary-color);
            box-shadow: none;
        }

        .search-btn {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--primary-color);
        }

        /* Footer */
        .footer {
            background: #1a1a1a;
            color: #ccc;
            padding: 50px 0 20px;
            margin-top: 80px;
        }

        .footer h5 {
            color: white;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: #ccc;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: white;
        }

        .social-links a {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            border-radius: 50%;
            background: #333;
            color: white;
            margin-right: 10px;
            transition: all 0.3s;
        }

        .social-links a:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
        }

        .copyright {
            border-top: 1px solid #333;
            padding-top: 20px;
            margin-top: 30px;
            text-align: center;
        }

        /* Content Spacing */
        .content-wrapper {
            min-height: calc(100vh - 400px);
            padding: 40px 0;
        }

        @media (max-width: 991px) {
            .search-input {
                width: 100%;
                margin-top: 15px;
            }
        }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand" href="">
                <i class="bi bi-newspaper me-2"></i>MyBlog
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('blog.index') ? 'active' : ''); ?>" 
                           href="">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                            
                            
                             <li>
                                    <a class="dropdown-item" href="">
                                        cat 1
                                    </a>
                                </li> <li>
                                    <a class="dropdown-item" href="">
                                        cat 2
                                    </a>
                                </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                
                <!-- Search Form -->
                <form action="" method="GET" class="search-form me-3">
                    <input type="text" 
                           name="q" 
                           class="form-control search-input" 
                           placeholder="Search articles..."
                           value="<?php echo e(request('q')); ?>">
                    <button type="submit" class="search-btn">
                        <i class="bi bi-search"></i>
                    </button>
                </form>

                <?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(route('login')); ?>" class="btn btn-primary-custom">Login</a>
                <?php else: ?>
                    <div class="dropdown">
                        <button class="btn btn-primary-custom dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <?php echo e(Auth::user()->name); ?>

                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="content-wrapper">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5>About MyBlog</h5>
                    <p>A professional blog platform where writers share their insights, stories, and expertise with the world.</p>
                    <div class="social-links mt-3">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Categories</h5>
                    <ul class="footer-links">
                        
                            <li><a href="">cat 1</a></li>
                            <li><a href="">cat 2</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 mb-4">
                    <h5>Newsletter</h5>
                    <p>Subscribe to get latest articles</p>
                    <form class="mt-3">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Your email">
                            <button class="btn btn-primary-custom">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="copyright">
                <p>&copy; <?php echo e(date('Y')); ?> MyBlog. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH D:\Software_Development\laravel_Projects\Task_Management\resources\views/layouts/blog.blade.php ENDPATH**/ ?>