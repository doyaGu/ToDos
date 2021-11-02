<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskEditRequest;
use App\Http\Requests\TaskFormRequest;
use App\Task;
use App\Todolist;

class TaskController extends Controller
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


    public function index(int $id)
    {
        $current_todolist = Todolist::find($id);

        $tasks = $current_todolist->tasks()->get();

        return view('tasks/index', [
            'current_todolist' => $current_todolist,
            'tasks' => $tasks,
        ]);
    }

    public function create(int $id, TaskFormRequest $request)
    {
        $current_todolist = Todolist::find($id);

        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        $current_todolist->tasks()->save($task);

        $task->save();

        return redirect()->route('tasks.index', [
            'id' => $current_todolist->id,
        ]);
    }


    public function showCreateForm(int $id)
    {
        return view('tasks/create', [
            'todolist_id' => $id
        ]);
    }

    public function showEditForm(int $id, int $tid)
    {
        $todolist = Todolist::find($id);
        $task = Task::find($tid);

        $this->checkRelation($todolist, $task);

        return view('tasks/edit', [
            'task' => $task,
        ]);
    }

    public function edit(int $id, int $tid, TaskEditRequest $request)
    {
        $todolist = Todolist::find($id);
        $task = Task::find($tid);

        $this->checkRelation($todolist, $task);

        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        return redirect()->route('tasks.index', [
            'id' => $task->todolist_id,
        ]);
    }

    public function delete(int $id, int $tid)
    {
        $task = Task::find($tid);

        $task->delete();

        return redirect()->route('tasks.index', [
            'id' => $id
        ]);
    }

    public function checkAll(int $id)
    {
        Task::where('todolist_id', $id)->update(['status' => 3]);

        return redirect()->route('tasks.index', [
            'id' => $id
        ]);
    }

    public function deleteCompleted(int $id)
    {
        Task::where('todolist_id', $id)->delete();

        return redirect()->route('tasks.index', [
            'id' => $id
        ]);
    }

    private function checkRelation(Todolist $todolist, Task $task)
    {
        if ($todolist->id !== $task->todolist_id) {
            abort(404);
        }
    }
}
