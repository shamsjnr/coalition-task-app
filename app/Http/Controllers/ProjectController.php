<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'projects' => Project::all()
        ];

        return view('projects', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $project = new Project;
        $project->name = $request->input('name');
        $project->save();

        return back()->with(['status'=>'success', 'message'=>'Project Added']);
    }

    public function edit(Project $project)
    {
        return view('update-project', ['project'=>$project]);
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        if ( Project::where('name', $request->name)->whereNot('id', $project->id)->first() ) {
            return back()->withErrors(['name' => 'Another project with this name exists']);
        }

        $project->name = $request->input('name');
        $project->save();

        return to_route('project.create')->with(['status'=>'success', 'message'=>'Project Updated']);
    }

    public function destroy(Project $project)
    {
        // Delete the record
        $project->delete();
        return back()->with(['status'=>'success', 'message'=>'Project Deleted']);
    }
}
