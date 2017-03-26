<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ApiHelper;

class Settings extends Controller
{
  use ApiHelper{
    ApiHelper::__construct as Construct;
  }

  public function __construct ()
  {
    $this->Construct();

    $this->middleware('auth');

    $this->user = stdClass($request->user);
  }

  /**
   *
   *
  */
  public function get ()
  {

    if($this->request->has('update'))
    {
      return $this->switchAction();
    }

    return $this->json(u());
  }

  /**
   * @return string JSON
  */
  public function switchAction ()
  {
    switch ($this->request->section)
    {
      case 'primary':
       return $this->updatePrimary();
      break;

      case 'social':
       return $this->updateSocial();
      break;

      case 'notification':
       return $this->updateNotification();
      break;

      case 'security':
       return $this->updateSecurity();
      break;
    }
  }

  /**
   * Update basic account information.
  */
  public function updatePrimary ()
  {
    u()->update([
      'position' => $this->user->position,
      'location' => $this->user->location,
      'about'    => $this->user->about
    ]);

    return $this->message('Settings updated', 'Basic profile settings successfully updated.', true);
  }

  /**
   * Update user social accounts.
  */
  public function updateSocial ()
  {
    foreach ($this->user->social as $social_key => $social)
    {
      if($social->url !== $social->full_link)
      {
        if(strpos($social->full_link, $social->contain) === false) {
          $count = count(explode('://', $social->full_link));

          if($count > 1) {
            $social->full_link = $social->url;
          }else {
            $social->full_link = strtolower($social->url.$social->full_link);
          }
        }
      }
    }

    u()->update([
      'social' => $this->user->social
    ]);

    return $this->message('Settings updated!', 'Social settings successfully updated.', true, $this->user);
  }

  /**
   * Update user notifications
  */
  public function updateNotification ()
  {
    $notify = $this->user->settings->notify;

    //return dd($notify);

    foreach($notify as $key => $value)
    {
      $notify->$key = $value ? 1 : 0;
    }


    u()->update([
        'settings->notify->new_comment_to_shot'     => $notify->new_comment_to_shot,
        'settings->notify->new_follower'            => $notify->new_follower,
        'settings->notify->new_newsletters'         => $notify->new_newsletters,
        'settings->notify->new_shot_from_following' => $notify->new_shot_from_following
    ]);

    return $this->message('Settings updated!', 'Notification settings successfully updated.', true);
  }

  /**
   * Json answer for sweetALert.
   * @param string $title
   * @param string $message
   * @param boolval $success
   * @param object $user
  */
  public function message ($title, $message, $success, $user = null)
  {
    return $this->json([
      'success' => $success,
      'message' => [
        'title' => $title,
        'message' => $message
      ],
      'user' => $user

    ]);
  }
}
