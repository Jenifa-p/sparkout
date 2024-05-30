@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Project</h1>
    <form action="{{ route('projectupdate', $project->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $project->id }}">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $project->name }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $project->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="start_date">Start Date:</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $project->start_date }}" required>
        </div>

        <div class="form-group">
            <label for="end_date">End Date:</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $project->end_date }}" required>
        </div>

        <div class="form-group">
            <label for="team_members">Assigned Team Members:</label>
            <select class="form-control" id="team_members" name="team_members[]" multiple required>
                @foreach($teamMembers as $member)
                    <option value="{{ $member->id }}" {{ in_array($member->id, $project->teamMembers->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $member->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Project</button>
    </form>
</div>
@endsection