<!-- resources/views/history-navigation.blade.php -->
@extends('layouts.app')

@section('title', $task->title)

<a href="{{ route('tasks.index') }}" class="btn btn-primary">Tasks List</a>


@section('content')
    <div>
        <p>
            {{ $task->description }}
        </p>

        @if ($task->long_description)
            <p>
                {{ $task->long_description }}
            </p>
        @endif
        <div>
            <p>{{ $task->created_at }}</p>
            <p>{{ $task->updated_at }}</p>
        </div>


        <div class="">
            <form method="GET" action="{{route('tasks.edit', ['task' => $task->id])}}">
                @csrf
                <button type="submit">Edit Task</button>
            </form>



            <form method="POST" action="{{ route('tasks.destroy', ['task' => $task->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Delete Task</button>
            </form>
        </div>
    </div>
@endsection
