@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h3>Project - {{ucfirst($project->name)}}</h3>
                <div class="table-container">
                    <div class="table-row header">
                        <div class="table-cell">Name</div>
                        <div class="table-cell">Description</div>
                        <div class="table-cell">Start Date</div>
                        <div class="table-cell">End Date</div>
                        <div class="table-cell">Assigned Team Members</div>
                    </div>
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
                    </div> 
                </div>
                <h3>Task Lists for Project: {{ ucfirst($project->name) }}</h3>
                <div class="card-body">
                    @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Project Manager'))
                        <button class="btn btn-primary mt-2">
                            <a href="{{ route('taskcreate', $project->id)}}" target="_blank">Create Task</a>
                        </button>
                    @endif
                </div>
                <div class="table-container">
                    <div class="table-row header">
                        <div class="table-cell">Name</div>
                        <div class="table-cell">Description</div>
                        <div class="table-cell">Assigned To</div>
                        <div class="table-cell">Due Date</div>
                        <div class="table-cell">Status</div>
                        <div class="table-cell">Action</div>
                    </div>
                    @if(count($tasks) > 0)
                        @foreach ($tasks as $task)
                        <div class="table-row">
                            <div class="table-cell">{{ $task->name }}</div>
                            <div class="table-cell">{{ $task->description }}</div>
                            <div class="table-cell">{{ $task->user ? $task->user->name : 'Unassigned' }}</div>
                            <div class="table-cell">{{ $task->due_date }}</div>
                            <div class="table-cell">{{ $task->is_completed ? 'Completed' : 'Pending' }}</div>
                            <div class="table-cell">
                                <a href="{{ route('taskedit', [$project->id, $task->id]) }}" class="btn btn-primary" target="_blank">Edit</a>
                                <form action="{{ route('taskdestroy', [$project, $task]) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                                </form>
                                @if (!$task->is_completed)
                                <form action="{{ route('markAsCompleted', [$project, $task]) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to completed this task?')">Mark as Completed</button>
                                </form>
                                @endif
                            </div>
                        </div> 
                        @endforeach
                    @else
                        <div class="table-row ">
                            <p>Task Not Assigned</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection