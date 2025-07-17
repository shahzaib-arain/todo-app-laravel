<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.25rem; font-weight: 600; color: #1F2937;">All Tasks</h2>
    </x-slot>

    <div style="padding: 1.5rem;">
        <form method="GET" style="margin-bottom: 1rem;">
            <select name="status" style="padding: 0.5rem; margin-right: 0.5rem;">
                <option value="">-- Status --</option>
                <option value="pending">Pending</option>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>

            <select name="priority" style="padding: 0.5rem; margin-right: 0.5rem;">
                <option value="">-- Priority --</option>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>

            <select name="user_id" style="padding: 0.5rem; margin-right: 0.5rem;">
                <option value="">-- Assigned To --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>

            <button type="submit" style="background-color: #3B82F6; color: white; padding: 0.5rem 1rem; border-radius: 4px;">Filter</button>
        </form>

        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #F3F4F6;">
                    <th style="border: 1px solid #D1D5DB; padding: 0.5rem;">Title</th>
                    <th style="border: 1px solid #D1D5DB; padding: 0.5rem;">Assigned To</th>
                    <th style="border: 1px solid #D1D5DB; padding: 0.5rem;">Status</th>
                    <th style="border: 1px solid #D1D5DB; padding: 0.5rem;">Priority</th>
                    <th style="border: 1px solid #D1D5DB; padding: 0.5rem;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td style="border: 1px solid #E5E7EB; padding: 0.5rem;">{{ $task->title }}</td>
                        <td style="border: 1px solid #E5E7EB; padding: 0.5rem;">{{ $task->user->name }}</td>
                        <td style="border: 1px solid #E5E7EB; padding: 0.5rem;">{{ $task->status }}</td>
                        <td style="border: 1px solid #E5E7EB; padding: 0.5rem;">{{ $task->priority }}</td>
                        <td style="border: 1px solid #E5E7EB; padding: 0.5rem;">
                            <a href="{{ route('tasks.edit', $task->id) }}" style="color: #2563EB; margin-right: 0.5rem;">Edit</a>
                            <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Delete task?')" style="color: red;">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
