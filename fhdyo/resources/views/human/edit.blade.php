<x-app title="human">
    <div class="flex justify-between">
        <h1 class="text-2xl font-semibold text-gray-900">Update Human</h1>

        <div class="flex justify-center items-center gap-2">
            <a href="{{ route('humans.index') }}"
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
        <form action="{{ route('humans.update', $human->id) }}" method="POST"
            class="space-y-4 flex flex-wrap flex-row gap-4">
            @csrf
            @method('PUT')
            <div class="w-auto">
                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                <input required type="text" name="first_name" id="first_name" value="{{ $human->first_name }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>

            <div class="w-auto">
                <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                <input required type="text" name="last_name" id="last_name" value="{{ $human->last_name }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div class="w-auto">
                <label for="middle_name" class="block text-sm font-medium text-gray-700">Middle Name</label>
                <input required type="text" name="middle_name" id="middle_name" value="{{ $human->middle_name }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div class="w-auto">
                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                <select required name="gender" id="gender"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="male" {{ $human->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $human->gender == 'female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>
            <div class="w-auto">
                <label for="birthday" class="block text-sm font-medium text-gray-700">Birthday</label>
                <input required type="date" name="birthday" id="birthday" value="{{ $human->birthday }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div class="w-auto">
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input required type="text" name="phone" id="phone" value="{{ $human->phone }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div class="w-auto">
                <label for="jshshir" class="block text-sm font-medium text-gray-700">JSHSHIR</label>
                <input required type="text" name="jshshir" id="jshshir" value="{{ $human->jshshir }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div class="w-auto">
                <label for="passport_id" class="block text-sm font-medium text-gray-700">Passport ID</label>
                <input required type="text" name="passport_id" id="passport_id" value="{{ $human->passport_id }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div class="w-auto">
                <label for="province" class="block text-sm font-medium text-gray-700">Province</label>
                <input required type="text" name="province" id="province" value="{{ $human->province }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div class="w-auto">
                <label for="region" class="block text-sm font-medium text-gray-700">Region</label>
                <input required type="text" name="region" id="region" value="{{ $human->region }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div class="w-full flex justify-between mt-4">
                <div class="w-auto flex items-end">
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Update</button>
                </div>
                <div class="flex w-auto items-end justify-center gap-2">
                    <a href="{{ route('humans.index') }}"
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
