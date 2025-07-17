<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 1rem;">Create Task</h2>
    </x-slot>

    <div style="padding: 1.5rem; max-width: 700px; margin: 0 auto;">
        <form method="POST" action="{{ route('tasks.store') }}" style="display: flex; flex-direction: column; gap: 1rem;">
            @csrf

            <div>
                <label style="font-weight: 600; display: block; margin-bottom: 0.5rem;">Task Title</label>
                <input type="text" name="title" placeholder="Task Title" 
                    style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 6px;" required />
            </div>

            <div>
                <label style="font-weight: 600; display: block; margin-bottom: 0.5rem;">Description</label>
                <textarea name="description" rows="4"
                    style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 6px;" required></textarea>
            </div>

            <div>
                <label style="font-weight: 600; display: block; margin-bottom: 0.5rem;">Assign to User</label>
                <select name="user_id" style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 6px;" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label style="font-weight: 600; display: block; margin-bottom: 0.5rem;">Status</label>
                <select name="status" style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 6px;" required>
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
            </div>

            <div>
                <label style="font-weight: 600; display: block; margin-bottom: 0.5rem;">Priority</label>
                <select name="priority" style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 6px;" required>
                    <option value="low">Low</option>
                    <option value="medium" selected>Medium</option>
                    <option value="high">High</option>
                </select>
            </div>

            <div>
                <label style="font-weight: 600; display: block; margin-bottom: 0.5rem;">Deadline</label>
                <input type="date" name="deadline" 
                    style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 6px;" required />
            </div>

            <div style="margin-top: 1rem;">
                <button type="submit" 
                    style="background-color: #2563eb; color: white; padding: 0.6rem 1.2rem; border: none; border-radius: 6px; cursor: pointer;">
                    Submit
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
