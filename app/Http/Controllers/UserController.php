<?php

namespace App\Http\Controllers;

use App\Notifications\FriendRequest;
use App\Todolist;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function newFriend(Request $request)
    {
        $recipient = $this->getUser($request->username);
        if ($recipient && !$this->hasFriend($recipient)) {
            Auth::user()->befriend($recipient);
        }

        return redirect()->route('home');
    }

    public function beFriend(int $id)
    {
        $recipient = User::find($id);
        Auth::user()->befriend($recipient);
    }

    public function confirmFriend(int $id)
    {
        $sender = User::find($id);
        Auth::user()->acceptFriendRequest($sender);

        return redirect()->route('home');
    }

    public function rejectFriend(int $id)
    {
        $sender = User::find($id);
        Auth::user()->denyFriendRequest($sender);

        return redirect()->route('home');
    }

    public function deleteFriend(int $id)
    {
        $friend = User::find($id);
        Auth::user()->unfriend($friend);

        return redirect()->route('home');
    }

    public function share(int $id, Request $request)
    {
        $todolist = Todolist::find($id);

        $recipient = $this->getUser($request->username);
        if ($recipient && !$this->hasFriend($recipient)) {
            abort(404);
        }

        $recipient->subscribe($todolist);

        return redirect()->route('home');
    }

    private function hasFriend($friend) : bool
    {
        if ($friend && Auth::user()->getFriendship($friend)) {
            return true;
        }
        return false;
    }

    private function getUser($username)
    {
        $recipient = null;
        if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $recipient = User::where('name', $username)->first();
        } else {
            $recipient = User::where('email', $username)->first();
        }
        return $recipient;
    }
}
