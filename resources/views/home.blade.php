@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Todo Lists</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="panel panel-default">
                            <div class="panel-body">
                                @if ($todolists->count() === 0)
                                    <div class="alert alert-info">
                                        You don't have todo-lists.
                                    </div>
                                @else
                                    <div class="list-group">
                                        @foreach ($todolists as $todolist)
                                            <div class="list-group-item">
                                                <a href="{{ route('tasks.index', ['id' => $todolist->id]) }}"
                                                   class="text-center">
                                                    {{ $todolist->title }}
                                                </a>

                                                <a href="{{ route('todolists.delete', ['id' => $todolist->id]) }}"
                                                   class="float-right btn btn-danger btn-sm"
                                                   onclick="return confirm('Are you sure to delete?')">
                                                    Delete
                                                </a>

                                                <!-- Button trigger modal -->
                                                <button type="button" class="float-right btn btn-primary btn-sm" data-toggle="modal" data-target="#shareModal">
                                                    Share
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="shareModalLabel">Share Todo-list</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('user.share', ['id' => $todolist->id]) }}" method="POST">
                                                                    @csrf
                                                                    <div class="input-group flex-nowrap">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text" id="addon-wrapping">@</span>
                                                                        </div>
                                                                        <input type="text" class="form-control" name="username" id="username"
                                                                               placeholder="Nickname / Email"
                                                                               aria-label="Username"
                                                                               aria-describedby="addon-wrapping">
                                                                        <button type="submit" class="btn btn-primary">Share</button>

                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        <a href="{{ route('todolists.create') }}" class="btn btn-primary btn-block">
                            New Todo List
                        </a>
                    </div>
                </div>

                <br/>

                <div class="card">
                    <div class="card-header">Friend's Todo Lists</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="panel panel-default">
                            <div class="panel-body">
                                @if ($subscriptions->count() === 0)
                                    <div class="alert alert-info">
                                        You don't have the todo-lists of your friends.
                                    </div>
                                @else
                                    <div class="list-group">
                                        @foreach ($subscriptions as $todolist)
                                            <div class="list-group-item">
                                                <a href="{{ route('tasks.index', ['id' => $todolist->id]) }}"
                                                   class="text-center">
                                                    {{ $todolist->title }}
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <br/>

                <div class="card">
                    <div class="card-header">Friends</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="panel panel-default">
                            <div class="panel-body">
                                @if ($friends->count() === 0)
                                    <div class="alert alert-info">
                                        You don't have friends. Find your friend.
                                    </div>
                                @else
                                    <div class="list-group">
                                        @foreach ($friends as $friend)
                                            @if ($user->id === $friend->sender_id)
                                                <div class="list-group-item">
                                                    <span class="text-center">
                                                        {{ App\User::find($friend->recipient_id)->name }}
                                                        ({{ $friend->status }})
                                                    </span>
                                                    <a href="{{ route('user.delete-friend', ['id' => $friend->recipient_id]) }}"
                                                       class="float-right btn btn-danger btn-sm"
                                                       onclick="return confirm('Are you sure to delete?')">
                                                        Delete
                                                    </a>
                                                </div>
                                            @else
                                                <div class="list-group-item">
                                                    <span class="text-center">
                                                        {{ App\User::find($friend->sender_id)->name }}
                                                        ({{ $friend->status }})
                                                    </span>
                                                    @if ($friend->status === 'pending')
                                                        <a href="{{ route('user.reject-friend', ['id' => $friend->sender_id]) }}"
                                                           class="float-right btn btn-secondary btn-sm">
                                                            Reject
                                                        </a>
                                                        <a href="{{ route('user.confirm-friend', ['id' => $friend->sender_id]) }}"
                                                           class="float-right btn btn-primary btn-sm">
                                                            Confirm
                                                        </a>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif

                                <form action="{{ route('user.new-friend') }}" method="POST">
                                    @csrf
                                    <div class="input-group flex-nowrap">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="addon-wrapping">@</span>
                                        </div>
                                        <input type="text" class="form-control" name="username" id="username"
                                               placeholder="Nickname / Email"
                                               aria-label="Username"
                                               aria-describedby="addon-wrapping">
                                        <div class="input-group-append">
                                            <button type="submit"
                                                    class="float-right btn btn-outline-secondary">
                                                Request
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
