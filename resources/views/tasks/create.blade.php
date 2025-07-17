<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.25rem; font-weight: 600;">Create Task</h2>
    </x-slot>

    <div style="padding: 1.5rem;">
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 1rem;">
                <label>Title</label><br>
                <input type="text" name="title" required value="{{ old('title') }}" style="width: 100%; padding: 0.5rem;">
                @error('title') <div style="color: red;">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom: 1rem;">
                <label>Description</label><br>
                <textarea name="description" style="width: 100%; padding: 0.5rem;">{{ old('description') }}</textarea>
            </div>

            <div style="margin-bottom: 1rem;">
                <label>Deadline</label><br>
                <input type="date" name="deadline" value="{{ old('deadline') }}" style="padding: 0.5rem;">
            </div>

            <button type="submit" style="background-color: green; color: white; padding: 0.5rem 1rem; border: none;">Save</button>
            <a href="{{ route('tasks.index') }}" style="margin-left: 1rem; background-color: gray; color: white; padding: 0.5rem 1rem; text-decoration: none;">Back</a>
        </form>
    </div>
</x-app-layout>
