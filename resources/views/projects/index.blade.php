@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h3>Projects</h3>
                <div class="card-body">
                    @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Project Manager'))
                        <button class="btn btn-primary mt-2">
                            <a href="{{ route('projectcreate') }}" target="_blank">Create Project</a>
                        </button>
                    @endif
                </div>
                <div class="table-container">
                    <div class="table-row header">
                        <div class="table-cell">Name</div>
                        <div class="table-cell">Description</div>
                        <div class="table-cell">Start Date</div>
                        <div class="table-cell">End Date</div>
                        <div class="table-cell">Assigned Team Members</div>
                        <div class="table-cell">Actions</div>
                    </div>
                    @foreach ($projects as $project)
                        <div class="table-row">
                            <div class="table-cell">{{ $project->name }}</div>
                            <div class="table-cell">{{ $project->description }}</div>
                            <div class="table-cell">{{ $project->start_date }}</div>
                            <div class="table-cell">{{ $project->end_date }}</div>
                            <div class="table-cell">
                                <ul>
                                    @foreach ($project->teamMembers as $member)
                                        <li>{{ $member->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="table-cell">
                                <a href="{{ route('projectedit', $project->id) }}" class="btn btn-primary" target="_blank">Edit</a>
                                <a href="{{ route('projectview', $project->id) }}" class="btn btn-primary" target="_blank">View</a>
                                <form action="{{ route('projectdestroy', $project->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this project?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


@endsection