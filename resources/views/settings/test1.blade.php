@extends('layouts.blog')

@section('title', 'Home')

@section('content')

    <!-- Hero Section -->
    @if ($featuredPost)
        <section class="hero-section"
            style="background: linear-gradient(135deg, #023B7E 0%, #0056b3 100%); color: white; padding: 80px 0;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <span class="badge bg-light text-dark mb-3">Featured Post</span>
                        <h1 class="display-4 fw-bold mb-3">{{ $featuredPost->title }}</h1>
                        <p class="lead mb-4"> {{ $featuredPost->excerpt ?? '' }}</p>
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($featuredPost->user->name) }}&background=random"
                                class="rounded-circle" width="40" height="40" alt="{{ $featuredPost->user->name }}">
                            <div>
                                <div class="fw-semibold">{{ $featuredPost->user->name }}</div>
                                <small>date and time</small>
                            </div>
                        </div>
                        <a href="" class="btn btn-light btn-lg">
                            Read Article <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        @if (0)
                            <img src="{{ asset('storage/' . $featuredPost->featured_image) }}"
                                class="img-fluid rounded shadow-lg" alt="{{ $featuredPost->title }}">
                        @else
                            <div class="placeholder-image"
                                style="background: rgba(255,255,255,0.1); height: 400px; border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-image" style="font-size: 80px; opacity: 0.5;"></i>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Latest Posts -->
    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">Latest Articles</h2>
                <a href="" class="text-decoration-none">View All <i
                        class="bi bi-arrow-right"></i></a>
            </div>

            @if ($posts->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 60px; color: #ccc;"></i>
                    <h4 class="mt-3">No posts yet</h4>
                    <p class="text-muted">Check back soon for new content!</p>
                </div>
            @else
                <div class="row">
                    @foreach ($posts as $post)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card post-card h-100 border-0 shadow-sm">
                                @if (0)
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" class="card-img-top"
                                        alt="{{ $post->title }}" style="height: 220px; object-fit: cover;">
                                @else
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                        style="height: 220px;">
                                        <i class="bi bi-image text-muted" style="font-size: 50px;"></i>
                                    </div>
                                @endif

                                <div class="card-body">
                                    @if ($post->category)
                                        <span class="badge mb-2"
                                            style="background: yellow; color: pink;">
                                            {{ $post->category->name }}
                                        </span>
                                    @endif
<h5 class="card-title">
                                <a href="" class="text-decoration-none text-dark">
                                    str limit some 
                                </a>
                            </h5>
                            
                            <p class="card-text text-muted small">
                                again some string
                            </p>
                            
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&size=32&background=random" 
                                         class="rounded-circle" 
                                         width="32" 
                                         height="32"
                                         alt="{{ $post->user->name }}">
                                    <small class="text-muted">{{ $post->user->name }}</small>
                                </div>
                                <small class="text-muted">
                                    <i class="bi bi-clock me-1"></i>post reading time
                                </small>
                            </div>
                        </div>
                        
                        <div class="card-footer bg-white border-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="bi bi-eye me-1"></i>{{ $post->view_count }} views
                                </small>
                                <small class="text-muted">post date</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            pagination link
        </div>
    @endif
</div>
</section>
<!-- Categories Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="fw-bold text-center mb-5">Explore Categories</h2>
        <div class="row">
            @foreach($categories->take(6) as $category)
                <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                    <a href="" 
                       class="text-decoration-none">
                        <div class="category-card text-center p-4 rounded" 
                             style="background: yellow; transition: transform 0.3s;">
                            <h3 class="mb-2" style="color: blue;">
                                {{ $category->published_posts_count }}
                            </h3>
                            <h6 class="fw-semibold" style="color: yellow;">
                                {{ $category->name }}
                            </h6>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
@push('styles')
<style>
    .post-card {
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .post-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
    }

    .category-card:hover {
        transform: translateY(-5px);
    }
</style>
@endpush