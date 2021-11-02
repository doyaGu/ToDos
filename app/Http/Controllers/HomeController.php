<?php

namespace App\Http\Controllers;

use App\Todolist;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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

    public function index()
    {
        $todolists = Auth::user()->todolists()->get();
        $friends = Auth::user()->getAllFriendships();

        $subscriptions = Auth::user()->subscriptions(Todolist::class)->get();

        return view('home', [
            'user' => Auth::user(),
            'todolists' => $todolists,
            'friends' => $friends,
            'subscriptions' => $subscriptions,
        ]);
    }
}
