<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.25rem; font-weight: 600;">Edit Task</h2>
    </x-slot>

    <div style="padding: 1.5rem;">
        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 1rem;">
                <label>Title</label><br>
                <input type="text" name="title" value="{{ old('title', $task->title) }}" required style="width: 100%; padding: 0.5rem;">
                @error('title') <div style="color: red;">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 1rem;">
                <label>Description</label><br>
                <textarea name="description" style="width: 100%; padding: 0.5rem;">{{ old('description', $task->description) }}</textarea>
            </div>

            <div style="margin-bottom: 1rem;">
                <label>Deadline</label><br>
                <input type="date" name="deadline" value="{{ old('deadline', $task->deadline) }}" style="padding: 0.5rem;">
            </div>

            <div style="margin-bottom: 1rem;">
                <label>Status</label><br>
                <select name="status" style="padding: 0.5rem;">
                    <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <button type="submit" style="background-color: #2563EB; color: white; padding: 0.5rem 1rem; border: none;">Save</button>
            <a href="{{ route('tasks.index') }}" style="margin-left: 1rem; background-color: gray; color: white; padding: 0.5rem 1rem; text-decoration: none;">Back</a>
        </form>
    </div>
</x-app-layout>
    