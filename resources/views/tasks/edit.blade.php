@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-md-offset-3 col-md-6">
                <nav class="panel panel-default">
                    <div class="panel-heading">Edit Task</div>
                    <div class="panel-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $message)
                                    <p>{{ $message }}</p>
                                @endforeach
                            </div>
                        @endif
                        <form
                            action="{{ route('tasks.edit', ['id' => $task->todolist_id, 'tid' => $task->id]) }}"
                            method="POST"
                        >
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title"
                                       value="{{ old('title') ?? $task->title }}" />
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    @foreach(\App\Task::STATUS as $key => $val)
                                        <option
                                            value="{{ $key }}"
                                            {{ $key == old('status', $task->status) ? 'selected' : '' }}
                                        >
                                            {{ $val['label'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="due_date">Deadline</label>
                                <input type="text" class="form-control" name="due_date" id="due_date"
                                       value="{{ old('due_date') ?? $task->formatted_due_date }}" />
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">OK</button>
                            </div>
                        </form>
                    </div>
                </nav>
            </div>
        </div>
    </div>
@endsection
