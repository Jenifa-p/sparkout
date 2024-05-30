@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Task for Project: {{ $project->name }}</h1>
    <form action="{{ route('taskupdate', [$project, $task]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Task Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $task->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ $task->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="due_date">Due Date</label>
            <input type="date" name="due_date" id="due_date" class="form-control" value="{{ $task->due_date }}" required>
        </div>
        <div class="form-group">
            <label for="user_id">Assign to</label>
            <select name="user_id" id="user_id" class="form-control">
                <option value="">Unassigned</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $task->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Task</button>
    </form>
</div>
@endsection