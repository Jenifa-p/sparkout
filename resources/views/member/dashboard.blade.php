@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (Auth::user()->hasRole('Admin'))
                        <p>Welcome, Admin!</p>
                    @else
                        <p>Welcome, {{ucfirst(Auth::user()->name)}}</p>
                    @endif
                </div>
                <h3>Please find your task</h3>
                <div class="table-container">
                    <div class="table-row header">
                        <div class="table-cell">Project</div>
                        <div class="table-cell">Task Name</div>
                        <div class="table-cell">Description</div>
                        <div class="table-cell">Assigned To</div>
                        <div class="table-cell">Due Date</div>
                        <div class="table-cell">Status</div>
                    </div>
                    @if(count($tasks) > 0)
                        @foreach ($tasks as $task)
                        <div class="table-row">
                        <div class="table-cell">{{ ucfirst($task->project->name) }}</div>
                            <div class="table-cell">{{ $task->name }}</div>
                            <div class="table-cell">{{ $task->description }}</div>
                            <div class="table-cell">{{ $task->user ? $task->user->name : 'Unassigned' }}</div>
                            <div class="table-cell">{{ $task->due_date }}</div>
                            <div class="table-cell">{{ $task->is_completed ? 'Completed' : 'Pending' }}</div>
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