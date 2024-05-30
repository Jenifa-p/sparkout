<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    public function memberDashboard(User $user)
    {
        $tasks = Task::where('user_id', $user->id)->get();

        return view('member.dashboard', compact('tasks', 'user'));
    }
}
