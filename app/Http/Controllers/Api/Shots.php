<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\TheShots\Traits\ApiHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\TheShots\Models\Shot;
use App\TheShots\Models\User;

class Shots extends Controller
{
    use ApiHelper {
        ApiHelper::__construct as Construct;
    }

    public function __construct()
    {
        $this->Construct();

        $this->middleware('auth', ['except' => [
            'get',
            'userShots',
            'userLikes',
            'recent',
            'gaining',
            'popular',
            'search'
        ]]);
    }

    /**
     * Get current shot.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get()
    {
        $id = $this->request->get('id');

        if (!$id)
            return $this->errorResponse('Please, provide a shot id.', '/api/shots.get?id=1');

        $shot = Shot::where('id', $id)
            ->with('comments.user', 'comments.likes')
            ->with('user.followed');

        return $this->successResponse($shot, true);
    }

    /**
     * Search shots.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function search()
    {
        $query = l($this->request->get('querySearch'));

        if(! $query)
            return $this->e('Please, provide a search query.');

        $shot = Shot::where('title', 'like', $query)
            ->orWhere('tags', 'like', $query)
            ->orWhere('about', 'like', $query);

        return $this->successResponse($shot);
    }

    /**
     * Return list of recent shots.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function recent()
    {
        return $this->successResponse(Shot::query());
    }

    /**
     * Return list of popular shots.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function popular()
    {
        $shots = Shot::has('likes', '>', '1')
            ->has('views', '>', '2');

        return $this->successResponse($shots);
    }


    /**
     * Increasingly popular shots.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function gaining()
    {
        $shots = Shot::where('created_at', '>=', Carbon::now()->subDay(1))
            ->has('likes', '>=', '1')
            ->has('views', '>=', '1');

        return $this->successResponse($shots);
    }

    /**
     * User followings shots section, in shots.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function followings()
    {
        $shots = Shot::where('follows.from', 1)
            ->leftJoin('follows', 'shots.user_id', 'follows.to');

        return $this->successResponse($shots);
    }
}
