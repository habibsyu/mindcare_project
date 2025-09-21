<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\ContentInteraction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    public function index(Request $request)
    {
        $query = Content::published()->with('author');

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
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
            case 'liked':
                $query->orderBy('likes', 'desc');
                break;
            case 'oldest':
                $query->orderBy('published_at', 'asc');
                break;
            default: // latest
                $query->orderBy('published_at', 'desc');
        }

        $contents = $query->paginate(12);

        // Get categories for filter
        $categories = Content::published()
            ->selectRaw('category, COUNT(*) as count')
            ->whereNotNull('category')
            ->groupBy('category')
            ->pluck('count', 'category');

        return view('content.index', compact('contents', 'categories'));
    }

    public function show(Content $content)
    {
        if (!$content->published) {
            abort(404);
        }

        // Increment views
        $content->incrementViews();

        // Track view interaction if user is authenticated
        if (Auth::check()) {
            ContentInteraction::createOrUpdate(Auth::id(), $content->id, 'view');
        }

        // Get related content
        $relatedContent = Content::published()
            ->where('id', '!=', $content->id)
            ->where('category', $content->category)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        // Get user interactions if authenticated
        $userInteractions = [];
        if (Auth::check()) {
            $userInteractions = ContentInteraction::where('user_id', Auth::id())
                ->where('content_id', $content->id)
                ->pluck('type')
                ->toArray();
        }

        return view('content.show', compact('content', 'relatedContent', 'userInteractions'));
    }

    public function like(Content $content)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Authentication required'], 401);
        }

        $isLiked = ContentInteraction::toggle(Auth::id(), $content->id, 'like');
        
        // Update content likes count
        if ($isLiked) {
            $content->increment('likes');
        } else {
            $content->decrement('likes');
        }

        return response()->json([
            'liked' => $isLiked,
            'likes_count' => $content->fresh()->likes
        ]);
    }

    public function bookmark(Content $content)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Authentication required'], 401);
        }

        $isBookmarked = ContentInteraction::toggle(Auth::id(), $content->id, 'bookmark');

        return response()->json([
            'bookmarked' => $isBookmarked
        ]);
    }

    public function share(Content $content)
    {
        if (Auth::check()) {
            ContentInteraction::createOrUpdate(Auth::id(), $content->id, 'share');
        }

        return response()->json(['success' => true]);
    }

    public function categories()
    {
        $categories = Content::published()
            ->selectRaw('category, COUNT(*) as count')
            ->whereNotNull('category')
            ->groupBy('category')
            ->orderBy('count', 'desc')
            ->get();

        return view('content.categories', compact('categories'));
    }

    public function category($category)
    {
        $contents = Content::published()
            ->where('category', $category)
            ->latest('published_at')
            ->paginate(12);

        return view('content.category', compact('contents', 'category'));
    }
}