<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.25rem; font-weight: 600; color: #2d3748;">Edit User</h2>
    </x-slot>

    <div style="padding-top: 1.5rem;">
        <div style="max-width: 640px; margin: 0 auto; background-color: white; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-radius: 0.5rem;">
            
            @if ($errors->any())
                <div style="margin-bottom: 1rem; color: #e53e3e;">
                    <ul style="padding-left: 1.25rem; list-style-type: disc;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div style="margin-bottom: 1rem;">
                    <label for="name" style="display: block; color: #4a5568; font-weight: 500; margin-bottom: 0.25rem;">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                           style="width: 100%; border: 1px solid #cbd5e0; border-radius: 0.375rem; padding: 0.5rem;">
                </div>

                <!-- Email -->
                <div style="margin-bottom: 1rem;">
                    <label for="email" style="display: block; color: #4a5568; font-weight: 500; margin-bottom: 0.25rem;">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                           style="width: 100%; border: 1px solid #cbd5e0; border-radius: 0.375rem; padding: 0.5rem;">
                </div>

                <!-- Role -->
                <div style="margin-bottom: 1rem;">
                    <label for="role_id" style="display: block; color: #4a5568; font-weight: 500; margin-bottom: 0.25rem;">Role</label>
                    <select name="role_id" id="role_id" required
                            style="width: 100%; border: 1px solid #cbd5e0; border-radius: 0.375rem; padding: 0.5rem;">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Buttons -->
                <div style="margin-top: 1.5rem; text-align: right;">
                    <a href="{{ route('users.index') }}" style="margin-right: 1rem; color: #4a5568; text-decoration: underline;">Cancel</a>
                    <button type="submit"
                            style="background-color: #3182ce; color: white; font-weight: 600; padding: 0.5rem 1rem; border-radius: 0.375rem; border: none; cursor: pointer;">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
