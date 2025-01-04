<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Support\Facades\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'tasks' => Task::all()
        ];

        return view('tasks', $data);
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
    public function store(StoreTaskRequest $request)
    {
        // Check for existing task
        $exists = Task::where('name', $request->name)->first();
        if ($exists) return back()->withErrors(['name' => "Task already exist"]);

        $next_rank = Task::count() + 1;

        $task = new Task;
        $task->name = $request->name;
        $task->priority = $request->priority;
        $task->rank = $next_rank;
        $task->save();

        return back()->with(['status'=>'success', 'message'=>'Task Added']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    function reorder(Task $task) {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('update-task', ['task'=>$task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        // Check for existing task
        $exists = Task::where('name', $request->name)->whereNot('id', $task->id)->first();
        if ($exists) return back()->withErrors(['name' => "Task already exist"]);

        // Update record with new values
        $task->name = $request->name;
        $task->priority = $request->priority;
        $task->save();

        return to_route('home')->with(['status'=>'success', 'message'=>'Task Updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        // Rearrange tasks order...
        $tasks = Task::where('rank', '>', $task->rank)->decrement('rank');

        // Delete the record
        $task->delete();
        return back()->with(['status'=>'success', 'message'=>'Task Deleted']);
    }
}
