<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Blog;
use App\Models\Content;
use App\Models\CommunityLink;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'featured_content' => Content::published()
                ->featured()
                ->latest('published_at')
                ->limit(6)
                ->get(),
            'latest_blogs' => Blog::published()
                ->latest('published_at')
                ->limit(3)
                ->get(),
            'community_links' => CommunityLink::active()
                ->ordered()
                ->get(),
            'stats' => $this->getStats(),
        ];

        return view('home', $data);
    }

    private function getStats()
    {
        return [
            'total_assessments' => Assessment::count(),
            'total_articles' => Content::ofType('article')->published()->count(),
            'total_videos' => Content::ofType('video')->published()->count(),
            'total_blogs' => Blog::published()->count(),
        ];
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function privacy()
    {
        return view('privacy');
    }

    public function terms()
    {
        return view('terms');
    }
}