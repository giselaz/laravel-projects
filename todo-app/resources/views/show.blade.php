@extends('layout.app')

@section('title', $task->title)
@section('content')
    <a class="link"
        href="{{ route('tasks.index') }}">⬅ Go Back</a>
    <h1>{{ $task->title }}</h1>
    <p class="mb-4 text-slate-700">{{ $task->description }}</p>
    @if ($task->long_description)
        <p class="mb-4 ">{{ $task->long_description }}</p>
    @endif

    <p class="mb-4 text-sm text-slate-500"> Created {{ $task->created_at->diffForHumans() }} • Updated
        {{ $task->updated_at->diffForHumans() }}</p>
    <p class="mb-4">
        @if ($task->completed)
            <span class="font-medium text-green-500">Completed</span>
        @else
            <span class="font-medium red-500">Not Completed</span>
        @endif
    </p>
    <div class="container flex gap-2">
        <a href="{{ route('tasks.edit', ['task' => $task->id]) }}"
            class="btn">Edit</a>
        <div>
            <form method="POST" action="{{ route('tasks.toggle-complete', ['task' => $task]) }}">
                @csrf
                @method('PUT')
                <button type="submit" class="btn">
                    Mark Task as {{ $task->completed ? 'not completed' : 'completed' }}
                </button>
            </form>
        </div>
        <form method="POST" action="{{ route('tasks.destroy', ['task' => $task->id]) }}">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn delete-btn"> Delete</button>
        </form>
    </div>

@endsection
