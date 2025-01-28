@extends('layouts.app')

@section('title', 'The list of tasks')

@section('content')
    <div>There are tasks!</div>
    @forelse($tasks as $task)
        <div>
            <a href="{{ route('tasks.show', ['id'=>$task->id]) }}">{{ $task->title }}</a>
        </div>
    @empty
        <div>There are no tasks!</div>
    @endforelse
@endsection
