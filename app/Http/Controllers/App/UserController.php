<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TheShots\Models\User;

class UserController extends Controller
{
    public function show ($username)
    {
      $user = User::where('username', $username)
          ->withCount('shots', 'likes', 'followers','followings')
          ->with('followed')
          ->first();

      return view('user.profile', [
          'user' => $user,
      ]);
    }
}
