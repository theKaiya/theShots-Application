<?php
/**
 *Class to redirect the user to a page to login, along with his actions.

 * For example, if the user was not logged in, and clicked on "like",
 * it will be forwarded to the login page.
 * If the user successfully logs on - he will not only be redirected to the previous page,
 * And the like will have already been delivered.
 *
*/

namespace App\TheShots\Traits;

use App\Http\Controllers\Api\Comments as CommentApi;
use App\Http\Controllers\Api\Follows;
use App\Http\Controllers\Api\Likes as LikesApi;
use Shot;

trait PreviousUrl
{

  use ApiHelper;

  /**
   * Previous url to redirect.
  */
  public $url;

  /**
   * Action, eg like or follow.
  */
  public $action;

  /**
   * Action id, if action == follow, it was user_id, on which you want to subscribe
   * if like, it was shot id.
  */
  public $action_id;

  public function __construct ()
  {
    /**
     * If we have previous session, we can take data.
     * Based in PreviousUrlMiddleware
    */
    $this->middleware(function ($request, $next) {

        $this->previous_url = session()->get('previous.back');

        $this->action = session()->get('previous.action');

        $this->action_id = session()->get('previous.action_id');

        return $next($request);

    });
  }

  /**
   * if have $action, and $action_id, we're moving on.
   *
   * Also if we have previous url - we redirect to him.
   * else - to default route home.
  */
  public function switchPreviousUrl ()
  {
    if($this->action && is_numeric($this->action_id)) {
      $this->makeAction();
    }

    if($this->previous_url) {

      session()->forget('previous');

      return redirect()->to($this->previous_url);
    }

    return redirect()->route('home');
  }

  /**
   * Switch current action, and make him.
   * likeOrUnlike and followOrUnfollow based on ApiHelper trait, because we use it in our api.
  */
  public function makeAction ()
  {
    switch ($this->action)
    {
      case 'like':
        LikesApi::likeOrUnlike($this->action_id, true);
      break;

      case 'follow':
        FollowsApi::followOrUnfollow($this->action_id);
      break;

      /*
       case 'comment':
        (new CommentApi())->add($this->action_id, $this->action_data);
       break;
       */
    }
  }

}
