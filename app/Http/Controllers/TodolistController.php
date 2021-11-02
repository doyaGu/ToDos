<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodolistFormRequest;
use App\Todolist;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodolistController extends Controller
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

    public function showCreateForm()
    {
        return view('todolists/create');
    }

    public function create(TodolistFormRequest $request)
    {
        $todolist = new Todolist();
        $todolist->title = $request->title;
        Auth::user()->todolists()->save($todolist);
        $todolist->save();

        return redirect()->route('tasks.index', [
            'id' => $todolist->id,
        ]);
    }

    public function delete(int $id)
    {
        $todolist = Todolist::find($id);
        $todolist->delete();

        return redirect()->route('home');
    }
}
