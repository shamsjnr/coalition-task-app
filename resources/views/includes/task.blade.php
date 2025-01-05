<h3 class="text-lg font-semibold title">Add Task</h3>
@error('name')
    <div class="text-red-500 text-center">{{ $message }}</div>
@enderror
@error('date')
    <div class="text-red-500 text-center">{{ $message }}</div>
@enderror
<form action="{{ route('task.create') }}" class="flex flex-col gap-4 mt-4" method="POST">
    @csrf
    <div class="group flex flex-col gap-1">
        <label for="name">Task Name:</label>
        <input type="text" name="name" id="name" class="w-full py-3 px-4 outline-none border-2" />
    </div>
    <div class="grid grid-cols-2 gap-2">
        <div class="group flex flex-col gap-1">
            <label for="date">Date:</label>
            <input type="date" name="date" id="date" class="w-full py-3 px-4 outline-none border-2" />
        </div>
        <div class="group flex flex-col gap-1">
            <label for="priority">Priority:</label>
            <select name="priority" id="priority" class="w-full pt-4 pb-3 px-4 outline-none border-2">
                <option value="HIGH">HIGH</option>
                <option value="MEDIUM" selected>MEDIUM</option>
                <option value="LOW">LOW</option>
            </select>
        </div>
    </div>
    <div class="group flex flex-col gap-1 pt-4">
        <button class="bg-amber-400 transition-all hover:shadow-md p-4">Submit</button>
    </div>
</form>
