<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\TheShots\Traits\ApiHelper;
use App\TheShots\Models\Comment;
use App\TheShots\Models\Shot;
use App\TheShots\Models\Like;

class Likes extends Controller
{
    use ApiHelper {
        ApiHelper::__construct as Construct;
    }

    public function __construct()
    {
        $this->Construct();

        $this->middleware('auth');
    }

    public function like ()
    {
        if(! $this->request->get('id'))
            return $this->errorResponse('Please, provide a id.');

        if(! $this->request->get('type'))
            return $this->errorResponse('Please, provide a like type.');

        return $this->getLikeByType();
    }

    /**
     * @param $item
     * @return mixed
     */
    public function putLike ($item)
    {
        if($item->liked) {
            $item->unlike();
        }else {
            $item->like();
        }

        return $this->successResponse([
            'likes_count' => k( $item->likes()->count() ),
        ], true);
    }

    /**
     * @return mixed
     */
    public function getLikeByType ()
    {
        $id = $this->request->get('id');

        if($this->request->get('type') == 'shot') {
            $item = Shot::find($id);
        }else {
            $item = Comment::find($id);
        }

        if(! $item)
            return $this->errorResponse('Shot or comment not found.');

        return $this->putLike($item);
    }
}
