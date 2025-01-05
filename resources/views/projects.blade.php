@extends('layouts.main')

@section('main')
<div class="flex justify-between items-center">
    <h3 class="text-xl">My Projects</h3>
    <div class="flex gap-4 items-center">
        <a href="{{ route('home') }}" class="text-blue-700 underline">Home</a>
        <button class="bg-amber-400 py-2 px-4 rounded-3xl hover:shadow-md transition-all" data-show-modal="projectModal">
            Create Project
        </button>
    </div>
</div>
<div class="sortable-list flex flex-col gap-1 pt-3">
@forelse ($projects as $project)
    <div class="py-3 px-4 pe-2 border flex justify-between items-center gap-3 rounded-lg">
        <div class="flex items-center gap-3">
            <span>{{ $project->name }}</span>
            <span class="border border-amber-400 rounded-md text-sm py-1 px-2">
                {{ count($project->tasks) }} Task{{ count($project->tasks) === 1 ? '' : 's' }}
            </span>
        </div>
        <div>
            <a href="{{ route('home', $project->id) }}" class="text-sm bg-gray-50 border py-2 px-4">View Tasks</a>
            <a href="{{ route('project.edit', $project->id) }}" class="text-sm bg-amber-400 py-2 px-4">Edit</a>
            <form action="{{ route('project.edit', $project->id) }}" method="post" class="inline">
                @csrf
                @method('DELETE')
                <button class="text-sm bg-red-600 py-2 px-4 text-white">Delete</button>
            </form>
        </div>
    </div>
@empty
    <div class="p-4 text-center border rounded-lg mt-3 bg-gray-50 dark:bg-gray-800 text-sm">It looks empty here! <br />But, you can always create a new project</div>
@endforelse
</div>
<div id="projectModal" class="modal @error('name') show @enderror">
    <div class="modal-dialog bg-white/90 dark:bg-gray-800/20">
        <span class="absolute top-0 right-2 p-2 text-red-600 text-3xl cursor-pointer" data-hide-modal="projectModal">&times;</span>
        @include('includes.project')
    </div>
</div>
@endsection
