<x-app title="admin">
    <div class="flex justify-between">
        <h1 class="text-2xl font-semibold text-gray-900">Admin</h1>

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
    <div class="mt-4 bg-white rounded-lg shadow-md">
        <div class="mt-4 p-6 bg-white rounded-lg shadow-md flex justify-center space-x-4 contents-center">

            <div class="w-full border items-center border-gray-400 rounded-lg">
                <!-- Table -->
                <table class="w-full text-left min-w-[1200px]">
                    <!-- Head -->
                    <thead class="font-bold">
                        <tr>
                            <th class="py-4 px-5 w-[20%]">
                                <div class="flex items-center gap-4">

                                    <div class="">
                                        <div class="flex items-center justify-between mb-2">
                                            <label class="font-medium text-gray-700 flex items-center gap-2">
                                                <span>Full name</span>
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </th>
                            <th class="py-4 px-5 w-[12%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between">
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Email</span>
                                        </label>
                                    </div>
                                </div>
                            </th>
                            <th class="py-4 px-5 w-[12%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between">
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Role</span>
                                        </label>
                                    </div>
                                </div>

                            </th>
                            <th class="py-4 px-5 w-[12%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between">
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Gender</span>
                                        </label>
                                    </div>
                                </div>

                            </th>
                            <th class="py-4 px-5 w-[13%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between">
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Birthday</span>
                                        </label>
                                    </div>
                                </div>
                            </th>
                            @if (Auth::user()->role == 'super_admin')
                                <th class="py-4 px-5 w-[7%]"></th>
                            @endif
                        </tr>
                    </thead>
                    <!-- Body -->
                    <tbody class="bg-gray-100">
                        <tr class="border-t border-gray-400">
                            <td class="px-4 py-3 w-[20%]">
                                <div class="flex items-center space-x-2">
                                    <div>
                                        <span class="block font-bold">{{ $user->name }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 w-[12%]">
                                <div>
                                    <span>{{ $user->email }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 w-[12%]">{{ $user->role }}</td>
                            <td class="px-4 py-3 w-[12%]">{{ $user->userData->gender ?? '-' }}</td>
                            <td class="px-4 py-3 w-[13%]">
                                <div class="flex flex-col">
                                    <span>{{ $user->userData->birthday ?? '-' }}</span>
                                </div>
                            </td>

                            @if (Auth::user()->role == 'super_admin')
                                <td class="px-4 py-3 w-[7%] relative">
                                    <div class="w-full flex justify-end">
                                        <button onclick="toggleDropdown(this)"
                                            class="flex flex-col gap-y-1 mr-6 text-black hover:text-gray-600 px-5 py-2 hover:bg-gray-200 rounded-md">
                                            <span class="bg-black h-1 w-1 rounded-full"></span>
                                            <span class="bg-black h-1 w-1 rounded-full"></span>
                                            <span class="bg-black h-1 w-1 rounded-full"></span>
                                        </button>

                                        <div
                                            class="hidden absolute right-0 mt-8 bg-white border rounded-md shadow-lg w-32 z-50">
                                            <ul class="flex flex-col text-sm text-gray-700">
                                                <li>
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                        class="block px-4 py-2 hover:bg-gray-100">✏️ Tahrirlash</a>
                                                </li>
                                                <li>
                                                    <form method="POST"
                                                        action="{{ route('users.destroy', $user->id) }}"
                                                        onsubmit="return confirm('Are you sure you want to delete selected users?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600">
                                                            🗑️ O‘chirish
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="flex justify-between mt-5">
        <h1 class="text-2xl font-semibold text-gray-900">Tish user created couples</h1>

        <div class="flex justify-center items-center gap-2">
            <form id="bulkDeleteForm" method="POST" action="{{ route('couples.destroy', -1) }}"
                onsubmit="return confirm('Are you sure you want to delete selected couples?');"
                class="hidden bg-red-500 mx-3 flex justify-center items-center gap-2 border p-2 rounded-md border-gray-300">
                @csrf
                @method('DELETE')
                <div id="selectedInputs"></div>
                <button type="submit" class="text-white">
                    Delete selected
                </button>
            </form>

            <a href="{{ route('couples.create') }}"
                class="mx-3 flex justify-center items-center gap-2 border p-2 rounded-md border-gray-300 bg-green-50 hover:bg-green-100">
                <h4 class="">Add couple</h4>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </a>

            <a href="{{ route('users.show', $user->id) }}"
                class="mx-3 flex justify-center items-center gap-2 border p-2 rounded-md border-gray-300">
                <h4 class="">Clear filter</h4>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 13.5V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 9.75V10.5" />
                </svg>
            </a>
            <form method="GET" action="{{ route('couples.destroy', -1) }}"
                class="mx-3 flex justify-center items-center gap-2 border p-2 rounded-md border-gray-300">
                <h4>Per page</h4>
                @foreach (request()->except('per_page') as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
                <select name="per_page" onchange="this.form.submit()">
                    @for ($i = 10; $i <= $count; $i += 10)
                        <option value="{{ $i }}" {{ request()->get('per_page') == $i ? 'selected' : '' }}>
                            {{ $i }}</option>
                    @endfor
                    <option {{ request()->get('per_page') == $count ? 'selected' : '' }} value="{{ $count }}">
                        All
                    </option>
                </select>
            </form>
        </div>

    </div>
    <div class="mt-4 bg-white rounded-lg shadow-md">
        <div class="mt-4 p-6 bg-white rounded-lg shadow-md flex justify-center space-x-4 contents-center">

            <div class="w-full border items-center border-gray-400 rounded-lg">
                <!-- Table -->
                <table class="w-full text-left min-w-[1400px]">
                    <!-- Head -->
                    <thead class="font-bold">
                        <tr>
                            <th class="py-4 px-5 w-[5%]">
                                <input type="checkbox" id="allCheckbox" class="w-5 h-5 rounded-lg " />
                            </th>
                            <th class="py-4 px-5 w-[18%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Husband</span>
                                            {{-- Sort toggle --}}
                                            <form method="GET" action="{{ route('users.show', $user->id) }}">
                                                @foreach (request()->except(['husband_sort', 'wife_sort', 'created_at_sort', 'status_sort']) as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit" name="husband_sort"
                                                    value="{{ request('husband_sort') === 'asc' ? 'desc' : 'asc' }}">
                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg"
                                                        class="text-gray-600 hover:text-black transition">
                                                        <path d="M15 9.167L10 4.167 5 9.167h10Z"
                                                            fill="{{ request('husband_sort') === 'asc' ? 'black' : '#9CA3AF' }}" />
                                                        <path d="M15 10.833 10 15.833 5 10.833h10Z"
                                                            fill="{{ request('husband_sort') === 'desc' ? 'black' : '#9CA3AF' }}" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </label>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        {{-- Search input --}}
                                        <form method="GET" action="{{ route('users.show', $user->id) }}"
                                            class="flex-1 relative">
                                            @foreach (request()->except('husband') as $key => $value)
                                                <input type="hidden" name="{{ $key }}"
                                                    value="{{ $value }}">
                                            @endforeach
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                                <path
                                                    d="M14 14l-3.465-3.465M10.535 10.535A5 5 0 1 0 2 7a5 5 0 0 0 8.535 3.535Z"
                                                    stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <input type="text" name="husband"
                                                class="bg-white p-2 pl-8 text-sm border rounded-md border-gray-300 w-full focus:ring focus:ring-blue-200"
                                                placeholder="Search husband..."
                                                value="{{ request('husband') ?? '' }}" />
                                        </form>

                                        {{-- Clear button --}}
                                        @if (request()->has('husband'))
                                            <form method="GET" action="{{ route('users.show', $user->id) }}">
                                                @foreach (request()->except('husband') as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit"
                                                    class="p-2 text-gray-500 hover:text-red-600 transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 18 18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </th>
                            <th class="py-4 px-5 w-[18%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Wife</span>
                                            {{-- Sort toggle --}}
                                            <form method="GET" action="{{ route('users.show', $user->id) }}">
                                                @foreach (request()->except(['husband_sort', 'wife_sort', 'created_at_sort', 'status_sort']) as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit" name="wife_sort"
                                                    value="{{ request('wife_sort') === 'asc' ? 'desc' : 'asc' }}">
                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg"
                                                        class="text-gray-600 hover:text-black transition">
                                                        <path d="M15 9.167L10 4.167 5 9.167h10Z"
                                                            fill="{{ request('wife_sort') === 'asc' ? 'black' : '#9CA3AF' }}" />
                                                        <path d="M15 10.833 10 15.833 5 10.833h10Z"
                                                            fill="{{ request('wife_sort') === 'desc' ? 'black' : '#9CA3AF' }}" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </label>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        {{-- Search input --}}
                                        <form method="GET" action="{{ route('users.show', $user->id) }}"
                                            class="flex-1 relative">
                                            @foreach (request()->except('wife') as $key => $value)
                                                <input type="hidden" name="{{ $key }}"
                                                    value="{{ $value }}">
                                            @endforeach
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                                <path
                                                    d="M14 14l-3.465-3.465M10.535 10.535A5 5 0 1 0 2 7a5 5 0 0 0 8.535 3.535Z"
                                                    stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <input type="text" name="wife"
                                                class="bg-white p-2 pl-8 text-sm border rounded-md border-gray-300 w-full focus:ring focus:ring-blue-200"
                                                placeholder="Search wife..." value="{{ request('wife') ?? '' }}" />
                                        </form>

                                        {{-- Clear button --}}
                                        @if (request()->has('wife'))
                                            <form method="GET" action="{{ route('users.show', $user->id) }}">
                                                @foreach (request()->except('wife') as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit"
                                                    class="p-2 text-gray-500 hover:text-red-600 transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 18 18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </th>
                            <th class="py-4 px-5 w-[13%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Created At</span>
                                            {{-- Sort toggle --}}
                                            <form method="GET" action="{{ route('users.show', $user->id) }}">
                                                @foreach (request()->except(['husband_sort', 'wife_sort', 'created_at_sort', 'status_sort']) as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit" name="created_at_sort"
                                                    value="{{ request('created_at_sort') === 'asc' ? 'desc' : 'asc' }}">
                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg"
                                                        class="text-gray-600 hover:text-black transition">
                                                        <path d="M15 9.167L10 4.167 5 9.167h10Z"
                                                            fill="{{ request('created_at_sort') === 'asc' ? 'black' : '#9CA3AF' }}" />
                                                        <path d="M15 10.833 10 15.833 5 10.833h10Z"
                                                            fill="{{ request('created_at_sort') === 'desc' ? 'black' : '#9CA3AF' }}" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </label>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        {{-- Search input --}}
                                        <form method="GET" action="{{ route('users.show', $user->id) }}"
                                            class="flex-1 relative">
                                            @foreach (request()->except('created_at') as $key => $value)
                                                <input type="hidden" name="{{ $key }}"
                                                    value="{{ $value }}">
                                            @endforeach
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                                <path
                                                    d="M14 14l-3.465-3.465M10.535 10.535A5 5 0 1 0 2 7a5 5 0 0 0 8.535 3.535Z"
                                                    stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <input type="text" name="created_at"
                                                class="bg-white p-2 pl-8 text-sm border rounded-md border-gray-300 w-full focus:ring focus:ring-blue-200"
                                                value="{{ request('created_at') ?? '' }}" />
                                        </form>

                                        {{-- Clear button --}}
                                        @if (request()->has('created_at'))
                                            <form method="GET" action="{{ route('users.show', $user->id) }}">
                                                @foreach (request()->except('created_at') as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit"
                                                    class="p-2 text-gray-500 hover:text-red-600 transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 18 18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </th>
                            <th class="py-4 px-5 w-[13%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Status</span>
                                            {{-- Sort toggle --}}
                                            <form method="GET" action="{{ route('users.show', $user->id) }}">
                                                @foreach (request()->except(['husband_sort', 'wife_sort', 'created_at_sort', 'status_sort']) as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit" name="status_sort"
                                                    value="{{ request('status_sort') === 'asc' ? 'desc' : 'asc' }}">
                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg"
                                                        class="text-gray-600 hover:text-black transition">
                                                        <path d="M15 9.167L10 4.167 5 9.167h10Z"
                                                            fill="{{ request('status_sort') === 'asc' ? 'black' : '#9CA3AF' }}" />
                                                        <path d="M15 10.833 10 15.833 5 10.833h10Z"
                                                            fill="{{ request('status_sort') === 'desc' ? 'black' : '#9CA3AF' }}" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </label>
                                    </div>

                                    <div class="relative">
                                        <form method="GET" action="{{ route('users.show', $user->id) }}">
                                            @foreach (request()->except('status') as $key => $value)
                                                <input type="hidden" name="{{ $key }}"
                                                    value="{{ $value }}">
                                            @endforeach
                                            <select name="status" id="status" onchange="this.form.submit()"
                                                class="bg-white p-2 px-3 text-sm focus:outline-none border rounded-md border-gray-300 w-full">
                                                <option value=""
                                                    {{ request('status') === '' ? 'selected' : '' }}>All</option>
                                                <option value="married"
                                                    {{ request('status') === 'married' ? 'selected' : '' }}>Married
                                                </option>
                                                <option value="unmarried"
                                                    {{ request('status') === 'unmarried' ? 'selected' : '' }}>Unmarried
                                                </option>
                                                <option value="divorced"
                                                    {{ request('status') === 'divorced' ? 'selected' : '' }}>Divorced
                                                </option>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                            </th>
                            <th class="py-4 px-5 w-[13%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Results</span>
                                            {{-- Sort toggle --}}
                                            <form method="GET" action="{{ route('users.show', $user->id) }}">
                                                @foreach (request()->except(['husband_sort', 'results_sort', 'wife_sort', 'created_at_sort', 'status_sort']) as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit" name="results_sort"
                                                    value="{{ request('results_sort') === 'asc' ? 'desc' : 'asc' }}">
                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg"
                                                        class="text-gray-600 hover:text-black transition">
                                                        <path d="M15 9.167L10 4.167 5 9.167h10Z"
                                                            fill="{{ request('status_sort') === 'asc' ? 'black' : '#9CA3AF' }}" />
                                                        <path d="M15 10.833 10 15.833 5 10.833h10Z"
                                                            fill="{{ request('status_sort') === 'desc' ? 'black' : '#9CA3AF' }}" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </label>
                                    </div>

                                    <div class="relative">
                                        <form method="GET" action="{{ route('users.show', $user->id) }}">
                                            @foreach (request()->except('results') as $key => $value)
                                                <input type="hidden" name="{{ $key }}"
                                                    value="{{ $value }}">
                                            @endforeach
                                            <select name="results" id="results" onchange="this.form.submit()"
                                                class="bg-white p-2 px-3 text-sm focus:outline-none border rounded-md border-gray-300 w-full">
                                                <option value=""
                                                    {{ request('results') === '' ? 'selected' : '' }}>All</option>
                                                <option value="0-50"
                                                    {{ request('results') === '0-50' ? 'selected' : '' }}>0% - 50%
                                                </option>
                                                <option value="51-80"
                                                    {{ request('results') === '51-80' ? 'selected' : '' }}>51% - 80%
                                                </option>
                                                <option value="81-100"
                                                    {{ request('results') === '81-100' ? 'selected' : '' }}>81% - 100%
                                                </option>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                            </th>
                            <th class="py-4 px-5 w-[7%]"></th>
                        </tr>
                    </thead>
                    <!-- Body -->
                    <tbody class="bg-gray-100">
                        @foreach ($couples as $couple)
                            <tr class="border-t border-gray-400">
                                <td class="px-4 py-3 w-[5%]">
                                    <input type="checkbox" id="checkbox_{{ $couple->id }}"
                                        data-couple="{{ $couple->id }}" name="couples[]={{ $couple->id }}"
                                        class="w-5 h-5 rounded-lg" />
                                </td>
                                <td class="px-4 py-3 w-[18%]">
                                    <div>
                                        <span class="block font-bold">
                                            {{ $couple->husbandData ? $couple->husbandData->first_name . ' ' . $couple->husbandData->middle_name . ' ' . $couple->husbandData->last_name : 'N/A' }}
                                        </span>
                                        <span class="text-xs text-gray-500">Key: {{ $couple->husband_key }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 w-[18%]">
                                    <div>
                                        <span class="block font-bold">
                                            {{ $couple->wifeData ? $couple->wifeData->first_name . ' ' . $couple->wifeData->middle_name . ' ' . $couple->wifeData->last_name : 'N/A' }}
                                        </span>
                                        <span class="text-xs text-gray-500">Key: {{ $couple->wife_key }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 w-[13%]">
                                    {{ $couple->created_at->format('Y-m-d H:i') }}
                                </td>
                                <td class="px-4 py-3 w-[13%]">
                                    <span
                                        class="px-2 py-1 rounded text-xs {{ $couple->status === 'married' ? 'bg-green-100 text-green-800' : ($couple->status === 'divorced' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ ucfirst($couple->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 w-[13%]">
                                    <div class="relative">
                                        <button onclick="toggleResultsDropdown(this)"
                                            class="px-3 py-1 bg-blue-50 hover:bg-blue-100 rounded-md border border-blue-200 text-sm font-medium">
                                            {{ $couple->result ? number_format($couple->result, 1) . '%' : 'N/A' }}
                                        </button>

                                        @if ($couple->results->count() > 0)
                                            <div
                                                class="hidden absolute right-0 mt-2 bg-white border rounded-md shadow-lg w-64 z-50">
                                                <div class="p-3">
                                                    <h4 class="font-bold text-sm mb-2 border-b pb-2">Results by
                                                        Category</h4>
                                                    <ul class="space-y-2">
                                                        @foreach ($couple->results as $result)
                                                            <li class="flex justify-between items-center text-sm">
                                                                <span
                                                                    class="text-gray-700">{{ $result->category->category ?? 'Category' }}:</span>
                                                                <span
                                                                    class="font-semibold text-blue-600">{{ number_format($result->percent, 1) }}%</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-3 w-[7%] relative">
                                    <div class="w-full flex justify-end">
                                        <button onclick="toggleDropdown(this)"
                                            class="flex flex-col gap-y-1 mr-6 text-black hover:text-gray-600 px-5 py-2 hover:bg-gray-200 rounded-md">
                                            <span class="bg-black h-1 w-1 rounded-full"></span>
                                            <span class="bg-black h-1 w-1 rounded-full"></span>
                                            <span class="bg-black h-1 w-1 rounded-full"></span>
                                        </button>

                                        <div
                                            class="hidden absolute right-0 mt-8 bg-white border rounded-md shadow-lg w-32 z-50">
                                            <ul class="flex flex-col text-sm text-gray-700">
                                                <li>
                                                    <a href="{{ route('couples.show', $couple->id) }}"
                                                        class="block px-4 py-2 hover:bg-gray-100">👁️ Ko‘rish</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('couples.edit', $couple->id) }}"
                                                        class="block px-4 py-2 hover:bg-gray-100">✏️ Tahrirlash</a>
                                                </li>
                                                <li>
                                                    <form method="POST"
                                                        action="{{ route('couples.destroy', $couple->id) }}"
                                                        onsubmit="return confirm('Are you sure you want to delete this couple?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600">
                                                            🗑️ O'chirish
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Pagination -->
                <div class="flex min-w-[1400px] justify-between items-center py-4 px-5 border-t border-gray-400">
                    @if ($couples->onFirstPage())
                        <button disabled
                            class="bg-gray-100 text-gray-400 font-bold border border-gray-300 px-4 py-2 rounded-md cursor-not-allowed">
                            Previous
                        </button>
                    @else
                        <a href="{{ $couples->previousPageUrl() }}"
                            class="bg-white font-bold border border-gray-400 px-4 py-2 rounded-md hover:border-gray-600 hover:bg-gray-50 transition-colors">
                            Previous
                        </a>
                    @endif

                    <span
                        class="bg-white font-bold border border-gray-400 px-6 py-2 rounded-md hover:border-gray-600 hover:bg-gray-50 transition-colors">
                        {{ $couples->appends(request()->all())->links() }}
                    </span>

                    @if ($couples->hasMorePages())
                        <a href="{{ $couples->nextPageUrl() }}"
                            class="bg-white font-bold border border-gray-400 px-6 py-2 rounded-md hover:border-gray-600 hover:bg-gray-50 transition-colors">
                            Next
                        </a>
                    @else
                        <button disabled
                            class="bg-gray-100 text-gray-400 font-bold border border-gray-300 px-6 py-2 rounded-md cursor-not-allowed">
                            Next
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app>

<script>
    function toggleDropdown(button) {
        const dropdown = button.nextElementSibling;
        dropdown.classList.toggle('hidden');
        // tashqariga bosilganda yopish
        document.addEventListener('click', function(e) {
            if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    }
</script>

<script>
    document.getElementById('allCheckbox').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]:not(#allCheckbox)');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateDeleteForm();
    });

    const bulkForm = document.getElementById('bulkDeleteForm');
    const selectedInputs = document.getElementById('selectedInputs');

    function updateDeleteForm() {
        const checked = document.querySelectorAll('input[type="checkbox"][data-couple]:checked');
        selectedInputs.innerHTML = '';

        checked.forEach(cb => {
            const hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'couples[]';
            hidden.value = cb.dataset.couple;
            selectedInputs.appendChild(hidden);
        });

        bulkForm.classList.toggle('hidden', checked.length === 0);
    }

    document.addEventListener('change', function(e) {
        if (e.target.matches('input[type="checkbox"][data-couple]')) {
            updateDeleteForm();
        }
    });

    function toggleDropdown(button) {
        const dropdown = button.nextElementSibling;

        // Close all other dropdowns first
        document.querySelectorAll('.absolute.right-0.mt-8').forEach(d => {
            if (d !== dropdown) {
                d.classList.add('hidden');
            }
        });

        dropdown.classList.toggle('hidden');

        // Close when clicking outside
        if (!dropdown.classList.contains('hidden')) {
            setTimeout(() => {
                document.addEventListener('click', function closeDropdown(e) {
                    if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                        dropdown.classList.add('hidden');
                        document.removeEventListener('click', closeDropdown);
                    }
                });
            }, 0);
        }
    }

    function toggleResultsDropdown(button) {
        const dropdown = button.nextElementSibling;

        // Close all other result dropdowns first
        document.querySelectorAll('.absolute.right-0.mt-2').forEach(d => {
            if (d !== dropdown) {
                d.classList.add('hidden');
            }
        });

        if (dropdown) {
            dropdown.classList.toggle('hidden');

            // Close when clicking outside
            if (!dropdown.classList.contains('hidden')) {
                setTimeout(() => {
                    document.addEventListener('click', function closeResultsDropdown(e) {
                        if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                            dropdown.classList.add('hidden');
                            document.removeEventListener('click', closeResultsDropdown);
                        }
                    });
                }, 0);
            }
        }
    }
</script>
