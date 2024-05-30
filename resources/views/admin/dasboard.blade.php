@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                @if (Auth::user()->hasRole('Admin'))
                    <p>Welcome, Admin!</p>
                @else
                    <p>Welcome, {{ucfirst(Auth::user()->name)}}</p>
                @endif
                </div>
            </div>
            <div class="mt-3">
                <button class="btn btn-primary mt-2">
                    <a href="{{ route('projectindex') }}">Projects</a>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection