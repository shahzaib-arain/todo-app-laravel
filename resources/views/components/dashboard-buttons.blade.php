@php $role = Auth::user()->role->name ?? 'unknown'; @endphp

@if ($role === 'admin')
    <a href="{{ route('tasks.index') }}" class="text-blue-600 underline">View All Tasks</a>
    <a href="{{ route('tasks.create') }}" class="text-purple-600 underline">Create Task</a>
    <a href="{{ route('users.index') }}" class="text-red-600 underline">Manage Users</a>
@endif

@if ($role === 'user')
    <a href="{{ route('tasks.index') }}" class="text-blue-600 underline">My Tasks</a>
    <a href="{{ route('tasks.create') }}" class="text-purple-600 underline">Create New Task</a>
@endif

@if ($role === 'pm')
    <a href="{{ route('tasks.index') }}" class="text-blue-600 underline">Team Tasks</a>
@endif

@if ($role === 'viewer')
    <a href="{{ route('tasks.index') }}" class="text-blue-600 underline">View Public Tasks</a>
@endif

<a href="{{ route('profile.edit') }}" class="text-green-600 underline">Edit Profile</a>
