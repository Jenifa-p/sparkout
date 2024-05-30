@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Create Task for Project: {{ ucfirst($project->name) }}</h3>
    <form action="{{ route('taskstore', $project) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Task Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="due_date">Due Date</label>
            <input type="date" name="due_date" id="due_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="user_id">Assign to</label>
            <select name="user_id" id="user_id" class="form-control">
                <option value="">Unassigned</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create Task</button>
    </form>
</div>
@endsection