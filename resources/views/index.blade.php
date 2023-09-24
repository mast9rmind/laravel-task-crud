@extends('layouts.app')

@section('title', 'Tasks List')

<form method="GET" action="{{ route('tasks.create') }}">
    @csrf
    <button type="submit">Add New Task</button>
</form>


@section('content')
    <div>
        @forelse ($tasks as $task)
            <div>
                <a href="{{ route('tasks.show', ['task' => $task->id]) }}">
                    {{ $task->title }}
                </a>
            </div>
        @empty
            <div> There are no tasks </div>
        @endforelse
    </div>
@endsection
