@extends('layout.app')
@section('title', 'Todo App')

@section('content')

<nav class="mb-3 flex justify-end ">
    <a  class="link" href="{{ route('tasks.create') }}">+ Create Task</a>
</nav>
    @forelse($tasks as $task)
        <div>
            <a href="{{ route('tasks.show', ['task' => $task->id]) }}"
                @class(['line-through'=>$task->completed])>
                <h2>{{ $task->title }}</h2>
            </a>
        </div>

    @empty
        <p>No tasks found.</p>
    @endforelse
    @if ($tasks->count())
        {{ $tasks->links() }}
    @endif
@endsection
