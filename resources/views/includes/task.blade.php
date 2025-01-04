<h3 class="text-lg font-semibold title">Add Task</h3>
<form action="{{ route('task.create') }}" class="flex flex-col gap-4 mt-4" method="POST">
    @csrf
    <div class="group flex flex-col gap-1">
        <label for="name">Task Name:</label>
        <input type="text" name="name" id="name" class="w-full py-3 px-4 outline-none border-2" />
    @error('name')
        <span class="text-red-500">{{ $message }}</span>
    @enderror
    </div>
    <div class="group flex flex-col gap-1">
        <label for="name">Priority:</label>
        <select name="priority" id="priority" class="w-full py-3 px-4 outline-none border-2">
            <option value="HIGH">HIGH</option>
            <option value="MEDIUM" selected>MEDIUM</option>
            <option value="LOW">LOW</option>
        </select>
    </div>
    <div class="group flex flex-col gap-1 pt-4">
        <button class="bg-amber-400 transition-all hover:shadow-md p-4">Submit</button>
    </div>
</form>
