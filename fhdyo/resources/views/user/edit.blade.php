<x-app title="admin">
    <div class="flex justify-between">
        <h1 class="text-2xl font-semibold text-gray-900">Edit admin</h1>

        <div class="flex justify-center items-center gap-2">
            <a href="{{ route('users.index') }}"
                class="mx-3 flex justify-center items-center gap-2 border p-2 rounded-md border-gray-300">
                <h4 class="">Back</h4>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
            </a>
        </div>

    </div>
    <div class="mt-4 p-6 bg-white rounded-lg shadow-md">
        <form action="{{ route('users.update', $user->id) }}" method="POST"
            class="space-y-4 flex flex-wrap flex-row gap-4">
            @csrf
            @method('PUT')
            <div class="w-auto">
                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input required type="text" name="name" id="name" value="{{ $user->name }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            
            <div class="w-auto">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input required type="text" name="email" id="email" value="{{ $user->email }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div class="w-auto">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input required type="password" name="password" id="password" value=""
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div class="w-auto">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Password Confirmation</label>
                <input required type="password" name="password_confirmation" id="password_confirmation" value=""
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div class="w-auto">
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select required name="role" id="role"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="super_admin" {{ $user->role == 'super_admin' ? 'selected' : '' }}>Super admin</option>
                </select>
            </div>
            <div class="w-auto">
                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                <select required name="gender" id="gender"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>
            <div class="w-auto">
                <label for="birthday" class="block text-sm font-medium text-gray-700">Birthday</label>
                <input required type="date" name="birthday" id="birthday" value="{{ $user->birthday }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div class="w-full flex justify-between mt-4">
                <div class="w-auto flex items-end">
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Create</button>
                </div>
                <div class="flex w-auto items-end justify-center gap-2">
                    <a href="{{ route('users.index') }}"
                        class="flex justify-center items-center gap-2 border p-2 rounded-md border-gray-300">
                        <h4 class="">Back</h4>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                        </svg>
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-app>
