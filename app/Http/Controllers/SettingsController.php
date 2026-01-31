<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('settings.index', compact('user'));
    }

    public function blog()
{
    // Fake posts data
    $posts = collect([
        (object)[
            'id' => 1,
            'title' => 'Getting Started with Laravel',
            'excerpt' => 'Learn the basics of Laravel framework and build modern web apps.',
            'view_count' => 120,
            'created_at' => now()->subDays(2),
            'user' => (object)['name' => 'Admin'],
            'category' => (object)['name' => 'Laravel'],
            'tags' => collect(['PHP', 'Laravel'])
        ],
        (object)[
            'id' => 2,
            'title' => 'Understanding React Components',
            'excerpt' => 'A beginner-friendly guide to React components and props.',
            'view_count' => 95,
            'created_at' => now()->subDays(5),
            'user' => (object)['name' => 'Editor'],
            'category' => (object)['name' => 'React'],
            'tags' => collect(['React', 'JavaScript'])
        ],
        (object)[
            'id' => 3,
            'title' => 'PHP Best Practices for Clean Code',
            'excerpt' => 'Write maintainable and scalable PHP applications.',
            'view_count' => 180,
            'created_at' => now()->subDays(1),
            'user' => (object)['name' => 'Admin'],
            'category' => (object)['name' => 'PHP'],
            'tags' => collect(['PHP', 'Backend'])
        ],
    ]);

    // Fake featured post (highest views)
    $featuredPost = $posts->sortByDesc('view_count')->first();

    // Fake categories with post counts
    $categories = collect([
        (object)['name' => 'Laravel', 'published_posts_count' => 4],
        (object)['name' => 'React', 'published_posts_count' => 3],
        (object)['name' => 'PHP', 'published_posts_count' => 5],
    ]);

    // Fake popular posts
    $popularPosts = $posts->sortByDesc('view_count')->take(5);

    return view('settings.test1', compact(
        'posts',
        'featuredPost',
        'categories',
        'popularPosts'
    ));
}

}
