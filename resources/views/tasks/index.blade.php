@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h1>{{ $current_todolist->title }}</h1>
                    </div>
                    <div class="panel-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="displayModeSelect">Options</label>
                            </div>
                            <select v-model="selected" class="custom-select" id="displayModeSelect">
                                <option v-for="option in options" v-bind:value="option.value">
                                    @{{ option.text }}
                                </option>
                            </select>
                        </div>

                        <div v-if="selected <= 2">
                            <h4>Tasks in progress</h4>
                            <table class="table text-center">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Deadline</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $task)
                                    @if($task->status <= 2)
                                        <tr>
                                            <td>{{ $task->title }}</td>
                                            <td>
                                                <span
                                                    class="label {{ $task->status_class }}">{{ $task->status_label }}</span>
                                            </td>
                                            <td>{{ $task->formatted_due_date }}</td>
                                            <td>
                                                <a href="{{ route('tasks.edit', ['id' => $current_todolist->id, 'tid' => $task->id]) }}"
                                                   class="label">
                                                    Edit
                                                </a>
                                                <a href="{{ route('tasks.delete', ['id' => $current_todolist->id, 'tid' => $task->id]) }}"
                                                   class="label"
                                                   onclick="return confirm('Are you sure to delete?')">
                                                    Delete
                                                </a>
                                            </td>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div v-if="selected === 1 || selected === 3">
                            <h4>Tasks completed</h4>
                            <table class="table text-center">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Deadline</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $task)
                                    @if($task->status === 3)
                                        <tr>
                                            <td>{{ $task->title }}</td>
                                            <td>
                                                <span
                                                    class="label {{ $task->status_class }}">{{ $task->status_label }}</span>
                                            </td>
                                            <td>{{ $task->formatted_due_date }}</td>
                                            <td>
                                                <a href="{{ route('tasks.edit', ['id' => $current_todolist->id, 'tid' => $task->id]) }}"
                                                   class="label">
                                                    Edit
                                                </a>
                                                <a href="{{ route('tasks.delete', ['id' => $current_todolist->id, 'tid' => $task->id]) }}"
                                                   class="label"
                                                   onclick="return confirm('Are you sure to delete?')">
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="btn btn-primary btn-lg btn-block">
                                    <a href="{{ route('tasks.create', ['id' => $current_todolist->id]) }}"
                                       class="btn btn-default btn-block">
                                        Add Task
                                    </a>
                                </div>
                            </div>
                            <div class="col">
                                <div class="btn btn-secondary btn-lg btn-block">
                                    <a href="{{ route('home') }}"
                                       class="btn btn-default btn-block">
                                        Back
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="btn btn-warning btn-lg btn-block">
                                    <a href="{{ route('tasks.check-all', ['id' => $current_todolist->id]) }}"
                                       class="btn btn-default btn-block">
                                        Check All Tasks
                                    </a>
                                </div>
                            </div>
                            <div class="col">
                                <div class="btn btn-danger btn-lg btn-block">
                                    <a href="{{ route('tasks.delete-completed', ['id' => $current_todolist->id]) }}"
                                       class="btn btn-default btn-block">
                                        Delete Completed Tasks
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
