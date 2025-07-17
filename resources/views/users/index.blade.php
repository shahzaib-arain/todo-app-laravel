<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">User Management</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded">

                {{-- Success Message --}}
                @if(session('success'))
                    <div class="text-green-600 mb-4 font-medium">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Search Bar --}}
                <form method="GET" action="{{ route('users.index') }}" class="mb-4 flex flex-wrap items-center gap-2">
                    <input type="text" name="search" placeholder="Search by name or email"
                           value="{{ request('search') }}"
                           class="border border-gray-300 p-2 rounded w-full sm:w-1/3" />

                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 shadow">
                        🔍 Search
                    </button>
                </form>

                {{-- Users Table --}}
                <div class="overflow-x-auto">
                    <table class="table-auto w-full border">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="border px-4 py-2">ID</th>
                                <th class="border px-4 py-2">Name</th>
                                <th class="border px-4 py-2">Email</th>
                                <th class="border px-4 py-2">Role</th>
                                <th class="border px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-800">
                            @forelse ($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="border px-4 py-2">{{ $user->id }}</td>
                                    <td class="border px-4 py-2">{{ $user->name }}</td>
                                    <td class="border px-4 py-2">{{ $user->email }}</td>
                                    <td class="border px-4 py-2">{{ $user->role->name ?? 'None' }}</td>
                                    <td class="border px-4 py-2 space-x-2">
                                        <a href="{{ route('users.edit', $user->id) }}"
                                           class="text-blue-600 hover:underline">Edit</a>

                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this user?')"
                                                    class="text-red-600 hover:underline">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="border px-4 py-2 text-center text-gray-500">
                                        No users found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-4">
                    {{ $users instanceof \Illuminate\Pagination\LengthAwarePaginator ? $users->links() : '' }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
