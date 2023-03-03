<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
  public function createFollow(User $user)
  {
    // you cant follow self
    if ($user->id == auth()->user()->id) {
      return back()->with('failed', 'You cannot follow yourself.');
  }
    // you cant follow someone your already following
    $existCheck = Follow::where([['user_id', '=', auth()->user()->id], ['followeduser', '=', $user->id]])->count();

    if ($existCheck) {
      return back()->with('failed', 'You are already following this user.');
    }

    $newFollow = new Follow;
    $newFollow->user_id = auth()->user()->id;
    $newFollow->followeduser = $user->id;
    $newFollow->save();

    return back()->with('success', 'User successfully followed.');
  }

  public function removeFollow(User $user)
  {
    Follow::where([['user_id', '=', auth()->user()->id], ['followeduser', '=', $user->id]])->delete();
    return back()->with('success', 'User successfully unfollowed.');
  }
}
