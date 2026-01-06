@extends('layout.app')

@section('title', isset($task) ? 'Edit Task' : 'Add Task')
@section('content')

    <form method="POST" action="{{ isset($task) ? route('tasks.update', ['task' => $task]) : route('tasks.store') }}">
        @csrf
        @isset($task)
            @method('PUT')
        @endisset
        <div class="input-container mb-4">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ $task->title ?? old('title') }}" 
            @class(['border-red-500'=>$errors->has('title')])/>
            @error('title')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="description">Description</label>
            <textarea type="textarea" name="description" id="description" rows="5"
            @class(['border-red-500'=>$errors->has('description')])>{{ $task->description ?? old('description') }}
            </textarea>
            @error('description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="long_description">Long Description</label>
            <textarea type="textarea" name="long_description" id="long_description" rows="10"
             @class(['border-red-500'=>$errors->has('long_description')])>{{ $task->long_description ?? old('long_description') }}</textarea>
            @error('long_description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex items-baseline">
            <button type="submit" class="btn">
            @isset($task)
                Edit Task
            @else
                Add Task
            @endisset
        </button> 
        <a  href="{{ route('tasks.index') }}"class="link">Cancel</a>
    
    </div>
        
    </form>
@endsection
