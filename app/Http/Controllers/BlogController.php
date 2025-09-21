<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::published()->with('author');

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by tag
        if ($request->filled('tag')) {
            $query->whereJsonContains('tags', $request->tag);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('body', 'like', "%{$search}%");
            });
        }

        // Sort
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'popular':
                $query->orderBy('views', 'desc');
                break;
            case 'oldest':
                $query->orderBy('published_at', 'asc');
                break;
            default: // latest
                $query->orderBy('published_at', 'desc');
        }

        $blogs = $query->paginate(10);

        // Get featured blogs for sidebar
        $featuredBlogs = Blog::published()
            ->featured()
            ->latest('published_at')
            ->limit(5)
            ->get();

        // Get categories for filter
        $categories = Blog::published()
            ->selectRaw('category, COUNT(*) as count')
            ->groupBy('category')
            ->orderBy('count', 'desc')
            ->get();

        // Get popular tags
        $popularTags = Blog::published()
            ->whereNotNull('tags')
            ->get()
            ->pluck('tags')
            ->flatten()
            ->countBy()
            ->sortDesc()
            ->take(20);

        return view('blog.index', compact('blogs', 'featuredBlogs', 'categories', 'popularTags'));
    }

    public function show(Blog $blog)
    {
        if (!$blog->published) {
            abort(404);
        }

        // Increment views
        $blog->incrementViews();

        // Get related blogs
        $relatedBlogs = Blog::published()
            ->where('id', '!=', $blog->id)
            ->where('category', $blog->category)
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('blog.show', compact('blog', 'relatedBlogs'));
    }

    public function category($category)
    {
        $blogs = Blog::published()
            ->where('category', $category)
            ->latest('published_at')
            ->paginate(10);

        return view('blog.category', compact('blogs', 'category'));
    }

    public function tag($tag)
    {
        $blogs = Blog::published()
            ->whereJsonContains('tags', $tag)
            ->latest('published_at')
            ->paginate(10);

        return view('blog.tag', compact('blogs', 'tag'));
    }
}