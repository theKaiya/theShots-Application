<?php

namespace App\TheShots\Traits;

use App\TheShots\Models\Shot;
use App\TheShots\Models\User;
use Illuminate\Database\Eloquent\Builder;

trait ApiHelper
{

    /**
     * Store Request
     */
    protected $request;

    /**
     * paginate($perPage)
     */
    protected $perPage;


    /**
     * ApiHelper constructor.
     */
    public function __construct()
    {
        $this->request = request();

        $this->perPage = $this->request->perPage ? $this->request->perPage : 6;
    }



    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function json($data)
    {
        return response()->json($data, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Get items with relations, e.g get shot with comments count, image, etc.
     *
     * @param $data
     * @return mixed
     */
    public function getRelations ($data)
    {
        if($data->model instanceof Shot) {
            return $data
                ->where('shots.is_activated', 1)
                ->withCount('comments', 'views', 'likes')
                ->with('user', 'image');
        }else if($data->model instanceof User) {
            return $data->withCount('shots', 'likes', 'followers', 'followings')
                ->with('followed');
        }else {
            return $data;
        }
    }

    /**
     * @param $items
     * @return mixed
     */
    public function responseRender ($items)
    {
        $items = $this->getRelations($items);

        if($this->request->get('orderBy') == 'asc') {
            $items = $items->orderBy('id', 'asc');
        }else {
            $items = $items->orderBy('id', 'desc');
        }

        if($this->request->get('paginator') == 'false')
            return $items->get();

        return $items->paginate($this->perPage);
    }


    /**
     * Success JSON response.
     *
     * @param $data
     * @param bool $firstItem
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse ($data, $firstItem = false)
    {
        if($firstItem) {
            $items = $this->responseFirst($data);
        }else {
            $items = $this->responseRender($data);
        }

        $result = [
            'status' => true,
            'response' => $items,
        ];

        return $this->json($result);
    }

    /**
     * Return only one item, without paginator.
     *
     * @param $item
     * @return mixed
     */
    public function responseFirst ($item)
    {
        if(isset($item->model) && $item->model instanceof Shot)
            $item = $this->withRelations($item);

        if($item instanceof Builder) {
            $item = $item->first();
            $item->see();
            return $item;
        }

        return $item;
    }

    /**
     * @param $shot
     * @return mixed
     */
    public function withRelations ($shot)
    {
        return $shot->withCount('likes', 'views')
        ->with('images', 'comments')
        ->with(['user' => function ($user) {
            $user->withCount('shots', 'likes', 'followers');
        }]);
    }


    /**
     * @param string $message
     * @param string $example
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse ($message = 'A error was occurred', $example = null)
    {
        $result = [
            'status' => false,
            'message' => $message,
        ];

        if($example)
            $result['example'] = $example;

        return response()->json($result, 401, [], JSON_PRETTY_PRINT);
    }

}
