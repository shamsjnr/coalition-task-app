@extends('layouts.main')

@section('main')
<div class="flex justify-between items-center">
    <h3 class="text-xl">My Tasks</h3>
    <button class="bg-amber-400 py-2 px-4 rounded-3xl hover:shadow-md transition-all" data-show-modal="taskModal">
        Add Task
    </button>
</div>
<div class="sortable-list flex flex-col gap-1 pt-3">
@forelse ($tasks as $task)
    <div class="py-3 px-4 pe-2 border flex justify-between items-center gap-3 rounded-lg item" draggable="true">
        <div class="flex items-center gap-3" draggable="true">
            <span>{{ $task->name }}</span>
            <span class="border rounded-md text-[0.6em] py-1 px-2">{{ $task->priority }}</span>
        </div>
        <div>
            <a href="{{ route('task.edit', $task->id) }}" class="text-sm bg-amber-400 py-2 px-4">Edit</a>
            <form action="{{ route('task.edit', $task->id) }}" method="post" class="inline">
                @csrf
                @method('DELETE')
                <button class="text-sm bg-red-600 py-2 px-4 text-white">Delete</button>
            </form>
        </div>
    </div>
@empty
    <div class="p-4 text-center border rounded-lg mt-3 bg-gray-50 dark:bg-gray-800 text-sm">It looks empty here! <br />But, you can always create a new Task</div>
@endforelse
</div>
@endsection
