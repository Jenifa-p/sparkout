@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Create Project</h4>
    <form action="{{ route('projectstore') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Project Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter project name" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter project description" required></textarea>
        </div>

        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
        </div>
        
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
        </div>

        <div class="form-group">
            <label for="team_members">Assign Team Members</label>
            <select class="form-control" id="team_members" name="team_members[]" multiple required>
                @foreach($teammembers as $member)
                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Create Project</button>
    </form>
</div>
@endsection