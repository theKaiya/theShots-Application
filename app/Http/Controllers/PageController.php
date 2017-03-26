<?php

namespace App\Http\Controllers;

use App\TheShots\Models\Comment;
use App\TheShots\Models\Shot;
use App\TheShots\Models\Like;
use App\TheShots\Models\User;
use App\TheShots\Models\Page;

class PageController extends Controller
{
    /**
     * Show home page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home ()
    {
        $shots = Shot::orderBy('id', 'desc')
            ->with('image')
            ->withCount('likes')
            ->take(6)
            ->get();

        $header_shots = Shot::inRandomOrder()
            ->with('image')
            ->take(6)
            ->get();

        return view('pages.home', [
            'shots' => $shots,
            'header_shots' => $header_shots,
            'users_count' => k( User::count() ),
            'shots_count' => k( Shot::count() ),
            'likes_count' => k( Like::count() ),
            'comments_count' => k( Comment::count() ),
        ]);
    }

    /**
     * Show search page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search ()
    {
        return view('pages.search');
    }

    public function page (Page $page)
    {
        return view('pages.page', [
            'page' => $page,
        ]);
    }
}
