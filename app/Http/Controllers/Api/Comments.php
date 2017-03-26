<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\TheShots\Traits\ApiHelper;
use App\TheShots\Models\Comment;
use App\TheShots\Models\Shot;
use Illuminate\Http\Request;

/**
 * Will be refactoring.
 */
class Comments extends Controller
{
  use ApiHelper {
    ApiHelper::__construct as Construct;
  }

  public function __construct()
  {
    $this->Construct();

    // $this->middleware('auth', ['create']);
  }

  /**
   * @return \Illuminate\Http\JsonResponse
   */
  public function shotComments()
  {
    $id = $this->request->get('id');

    if (!$id) {
      return $this->e('provideShotId');
    }

    $comments = Comment::where('shot_id', $id);

    if ($this->request->get('user_id'))
      $comments = $comments->where('user_id', $this->request->get('user_id'));

    return $this->responseRender($comments);
  }

  /**
   * @return \Illuminate\Http\JsonResponse
   */
  public function userComments()
  {
    $id = $this->request->get('id');

    if (!$id) {
      return $this->e('provideUserId');
    }

    $comments = Comment::where('user_id', $id);

    if ($this->request->get('shot_id'))
      $comments = $comments->where('shot_id', $this->request->get('shot_id'));

    return $this->responseRender($comments);
  }

  /**
   * @param Request $request
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function create(Request $request)
  {
     $this->validate($request, [
        'message' => 'required|max:255'
    ]);

    if(Shot::find($request->get('shot_id'))) {
      $comment = $this->createComment($request);

      return $this->successResponse($comment, true);
    }

    return $this->errorResponse('Shot with this id not found.');
  }


  /**
   * @param $data
   *
   * @return null|static
   */
  public function createComment($data)
  {
    return Comment::create([
      'user_id' => u()->id,
      'shot_id' => $data->shot_id,
      'message' => $data->message,
    ])->fresh('user', 'likes');
  }
}
