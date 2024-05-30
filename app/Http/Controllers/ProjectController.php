<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::with('users')->paginate(10);
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teammembers = User::role('Team Member')->get();
        return view('projects.create', compact('teammembers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'team_members' => 'required|array',
            'team_members.*' => 'exists:users,id',
        ]);

        $project = Project::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
        ]);

        $project->teamMembers()->sync($validatedData['team_members']);

        return redirect()->route('projectindex')->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $tasks = $project->tasks()->get();
        return view('projects.view', compact('project','tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $teamMembers = User::role('Team Member')->get();
        return view('projects.edit', compact('project', 'teamMembers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'team_members' => 'required|array',
        ]);

        $project = Project::find($request->id);
        $project->update([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        $project->teamMembers()->sync($request->team_members);

        return redirect()->route('projectindex')->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->teamMembers()->detach();
        $project->delete();

        return redirect()->route('projectindex')->with('success', 'Project deleted successfully.');
    }
}
