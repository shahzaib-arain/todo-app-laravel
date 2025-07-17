<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">User Dashboard</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded">
                <h1 class="text-2xl font-bold mb-4">Welcome, {{ Auth::user()->name }} (User)</h1>

                <x-dashboard-buttons />

                <p class="mt-6 text-gray-700">
                    You can create, update, delete, and mark your own tasks as complete.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
