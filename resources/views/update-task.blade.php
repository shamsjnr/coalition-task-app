@extends('layouts.main')

@section('main')
<h3 class="text-lg font-semibold title">Update Task</h3>
@error('name')
    <div class="text-red-500 text-center">{{ $message }}</div>
@enderror
@error('date')
    <div class="text-red-500 text-center">{{ $message }}</div>
@enderror
<form action="{{ route('task.edit', $task->id) }}" class="flex flex-col gap-4 mt-4" method="POST">
    @csrf
    @method('PUT')
    <div class="group flex flex-col gap-1">
        <label for="name">Task Name:</label>
        <input type="text" name="name" value="{{ $task->name }}" id="name" class="w-full py-3 px-4 outline-none border-2" />
    @error('name')
        <span class="text-red-500">{{ $message }}</span>
    @enderror
    </div>
    <div class="grid grid-cols-2 gap-2">
        <div class="group flex flex-col gap-1">
            <label for="date">Date:</label>
            <input type="date" name="date" id="date" value="{{ $task->dated }}" class="w-full py-3 px-4 outline-none border-2" />
        </div>
        <div class="group flex flex-col gap-1">
            <label for="name">Priority:</label>
            <select name="priority" id="priority" class="w-full pt-4 pb-3 px-4 outline-none border-2">
                <option value="HIGH" {{ $task->priority == 'HIGH' ? 'selected' : '' }}>HIGH</option>
                <option value="MEDIUM" {{ $task->priority == 'MEDIUM' ? 'selected' : '' }}>MEDIUM</option>
                <option value="LOW" {{ $task->priority == 'LOW' ? 'selected' : '' }}>LOW</option>
            </select>
        </div>
    </div>
    <div class="group flex flex-col gap-1 pt-4">
        <button class="bg-amber-400 transition-all hover:shadow-md p-4">Submit</button>
    </div>
</form>
@endsection
