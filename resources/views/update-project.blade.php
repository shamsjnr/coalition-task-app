@extends('layouts.main')

@section('main')
<h3 class="text-lg font-semibold title">Update Project</h3>
@error('name')
    <div class="text-red-500 text-center">{{ $message }}</div>
@enderror
<form action="{{ route('project.edit', $project->id) }}" class="flex flex-col gap-4 mt-4" method="POST">
    @csrf
    @method('PUT')
    <div class="group flex flex-col gap-1">
        <label for="name">Project Name:</label>
        <input type="text" name="name" value="{{ $project->name }}" id="name" class="w-full py-3 px-4 outline-none border-2" />
    </div>
    <div class="group flex flex-col gap-1 pt-4">
        <button class="bg-amber-400 transition-all hover:shadow-md p-4">Submit</button>
    </div>
</form>
@endsection
