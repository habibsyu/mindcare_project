<?php

namespace App\Http\Controllers;

use App\Models\CommunityLink;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function index()
    {
        $discordLinks = CommunityLink::active()
            ->platform('discord')
            ->ordered()
            ->get();

        $telegramLinks = CommunityLink::active()
            ->platform('telegram')
            ->ordered()
            ->get();

        return view('community.index', compact('discordLinks', 'telegramLinks'));
    }

    public function redirect(CommunityLink $link)
    {
        if (!$link->active) {
            abort(404);
        }

        // Track click (you could implement analytics here)
        
        return redirect()->away($link->url);
    }
}