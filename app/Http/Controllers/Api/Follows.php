<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\TheShots\Models\Follow;
use App\TheShots\Traits\ApiHelper;
use App\TheShots\Models\User;
use Illuminate\Http\Request;

class Follows extends Controller
{
    use ApiHelper {
        ApiHelper::__construct as Construct;
    }
    

    public function __construct()
    {
        $this->Construct();

        $this->middleware('auth', ['except' => ['userFollowers', 'userFollowings']]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function follow ()
    {
        $id = $this->request->get('id');

        if($id == u()->id)
            return $this->errorResponse('Well, You subscribed to yourself... are You satisfied?');

        if(! $id || !is_numeric($id))
            return $this->errorResponse('Please, provide a user id.');

        $user = User::find($id);

        if(! $user)
            return $this->errorResponse('User with this id not found.');

        return $this->toggleFollow($user);
    }

    /**
     * If we already follow to user, we unFollow else, follow.
     *
     * @param $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleFollow ($user)
    {
        if($user->followed()->count()) {
            $user->unfollow();
        }else {
            $user->follow();
        }

        return $this->successResponse([
            'followers_count' => $user->followers()->count(),
        ], true);
    }
}
