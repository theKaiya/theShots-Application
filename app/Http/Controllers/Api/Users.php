<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\TheShots\Traits\ApiHelper;
use App\TheShots\Models\User;
use App\TheShots\Models\Shot;

class Users extends Controller
{
    use ApiHelper{
        ApiHelper::__construct as Construct;
    }

    /**
     * Select needed values.
     *
     * @var array
     */
    protected $userFields;

    protected $id;


    public function __construct()
    {
        $this->Construct();

        $this->userFields = [
            'users.id',
            'users.username',
            'users.position',
            'users.about',
            'users.picture'
        ];

        $this->id = $this->request->get('id');
    }

    /**
     * Get user followers.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function followers ()
    {
        $user_id = $this->request->get('id');

        if (!$user_id || !is_numeric($user_id))
            return $this->errorResponse('Provide user id');

        $followers = User::leftJoin('follows', 'users.id', 'follows.from')
            ->where('follows.to', $user_id)
            ->select($this->userFields);

        return $this->successResponse($followers);
    }

    /**
     * User followings.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function followings ()
    {
        $user_id = $this->request->get('id');

        if (!$user_id || !is_numeric($user_id))
            return $this->errorResponse('Provide user id');

        $followings = User::leftJoin('follows', 'users.id', 'follows.to')
            ->where('follows.from', $user_id)
            ->select($this->userFields);

        return $this->successResponse($followings);
    }

    /**
     * Return a user shots.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function shots()
    {
        $user_id = $this->request->get('id');

        if (!$user_id)
            return $this->errorResponse('User id not provided.');

        $shots = Shot::where('user_id', $user_id);

        return $this->successResponse($shots);
    }

    /**
     * Return a user liked shots.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function likes()
    {
        $user_id = $this->request->get('id');

        if (!$user_id)
            return $this->errorResponse('User id not provided.');

        $likes = Shot::leftJoin('likes', 'shots.id', 'likes.shot_id')
            ->where('likes.user_id', $user_id);

        return $this->successResponse($likes);
    }

    public function search ()
    {
        $query = l($this->request->get('querySearch'));

        if(! $query)
            return $this->errorResponse('please, provide a search query.');

        $users = User::where('username', 'like', $query)
            ->orWhere('position', 'like', $query)
            ->orWhere('about', 'like', $query)
            ->select($this->userFields);

        return $this->successResponse($users);
    }

    public function get ()
    {
        if(! $this->id)
            return $this->errorResponse('Please, provide a user id.');

        $user = User::where('id', $this->id)
            ->select($this->userFields);

        return $this->successResponse($user);
    }

}
