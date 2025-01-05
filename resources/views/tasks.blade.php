@extends('layouts.main')

@php
    // Preset accent colors for priority tags
    $accents = [
        'HIGH'=>'bg-red-50 text-red-600',
        'MEDIUM'=>'bg-amber-50 text-amber-500',
        'LOW'=>'bg-blue-50 text-blue-500',
    ]
@endphp

@section('main')
<div class="flex justify-between items-center">
    <h3 class="text-xl">All Tasks</h3>
    <div class="flex gap-4 items-center">
        <a href="{{ route('project.create') }}" class="text-blue-700 underline">Projects</a>
        <button class="bg-amber-400 py-2 px-4 rounded-3xl hover:shadow-md transition-all" data-show-modal="taskModal">
            Create Task
        </button>
    </div>
</div>

{{-- Add to Project trigger --}}
<a
    href="javascript:void(0)"
    id="addToProject"
    data-show-modal="addToProjectModal"
    class="hidden fixed top-4 left-1/2 -translate-x-1/2 border-2 border-amber-400 py-3 px-4 bg-white/80 dark:bg-gray-800/80"
>Add to Project</a>

{{-- Sortable list --}}
<div class="sortable-list flex flex-col gap-1 pt-3">
@forelse ($tasks as $task)
    <div
        class="py-3 px-4 pe-2 border flex justify-between items-center gap-3 rounded-lg item"
        draggable="true"
        data-rank="{{ $task->rank }}"
        data-url="{{ route('task.order', [$task->id]) }}"
    >
        <div class="flex items-center gap-3">
            <input type="checkbox" class="project-task w-5 h-5" value="{{ $task->id }}" />
            <span class="text-sm">{{ $task->dated ? date('Y M, d', strtotime($task->dated)) : '' }} &nbsp; |</span>
            <span>{{ $task->name }}</span>
            <span class="border rounded-md text-[0.6em] py-1 px-2 font-semibold {{ $accents[$task->priority] }}">{{ $task->priority }}</span>
        </div>
        <span>
            <a href="{{ route('task.edit', $task->id) }}" class="text-sm bg-amber-400 py-2 px-4">Edit</a>
            <form action="{{ route('task.edit', $task->id) }}" method="post" class="inline">
                @csrf
                @method('DELETE')
                <button class="text-sm bg-red-600 py-2 px-4 text-white">Delete</button>
            </form>
        </span>
    </div>
@empty
    <div class="p-4 text-center border rounded-lg mt-3 bg-gray-50 dark:bg-gray-800 text-sm">It looks empty here! <br />But, you can always create a new Task</div>
@endforelse
</div>
<div id="taskModal" class="modal @error('name') show @enderror @error('date') show @enderror ">
    <div class="modal-dialog bg-white/90 dark:bg-gray-800/20">
        <span class="absolute top-0 right-2 p-2 text-red-600 text-3xl cursor-pointer" data-hide-modal="taskModal">&times;</span>
        @include('includes.task')
    </div>
</div>
<div id="addToProjectModal" class="modal @error('tasks') show @enderror ">
    <div class="modal-dialog bg-white/90 dark:bg-gray-800/20">
        <span class="absolute top-0 right-2 p-2 text-red-600 text-3xl cursor-pointer" data-hide-modal="addToProjectModal">&times;</span>
        <form action="{{ route('tasks.addtoproject') }}" method="post" class="flex flex-col gap-4">
            @csrf
            @method('PATCH')

            <h4 class="text-lg">Add Tasks to a Project</h4>
            @error('tasks')
                <div class="text-red-500 text-center">{{ $message }}</div>
            @enderror
            @error('project')
                <div class="text-red-500 text-center">{{ $message }}</div>
            @enderror

            <div class="group flex flex-col gap-1">
                <label for="project">Project:</label>
                <select name="project" id="project" class="w-full py-3 px-4 outline-none border-2">
                    @forelse ($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @empty
                        <option value="">No data</option>
                    @endforelse
                </select>
            </div>
            <input type="hidden" id="tasks" name="tasks" />
            <button class="bg-amber-400 transition-all hover:shadow-md p-4 mt-2">Proceed</button>
        </form>
    </div>
</div>
@endsection
