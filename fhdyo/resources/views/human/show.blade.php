<x-app title="human">
    <div class="flex justify-between">
        <h1 class="text-2xl font-semibold text-gray-900">Human</h1>

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
                                            <span>Gender</span>
                                        </label>
                                    </div>
                                </div>
                            </th>
                            <th class="py-4 px-5 w-[12%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between">
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Birthday</span>
                                        </label>
                                    </div>
                                </div>

                            </th>
                            <th class="py-4 px-5 w-[12%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between">
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Phone</span>
                                        </label>
                                    </div>
                                </div>

                            </th>
                            <th class="py-4 px-5 w-[13%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between">
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Jshshir</span>
                                        </label>
                                    </div>
                                </div>
                            </th>
                            <th class="py-4 px-5 w-[12%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between">
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Passport ID</span>
                                        </label>
                                    </div>
                                </div>

                            </th>
                            <th class="py-4 px-5 w-[12%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between">
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Address</span>
                                        </label>
                                    </div>
                                </div>

                            </th>
                            <th class="py-4 px-5 w-[7%]"></th>
                        </tr>
                    </thead>
                    <!-- Body -->
                    <tbody class="bg-gray-100">
                        <tr class="border-t border-gray-400">
                            <td class="px-4 py-3 w-[20%]">
                                <div class="flex items-center space-x-2">
                                    <div>
                                        <span
                                            class="block font-bold">{{ $human->first_name . ' ' . $human->last_name . ' ' . $human->middle_name }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 w-[12%]">
                                <div>
                                    <span>{{ $human->gender }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 w-[12%]">{{ $human->birthday }}</td>
                            <td class="px-4 py-3 w-[12%]">{{ $human->phone }}</td>
                            <td class="px-4 py-3 w-[13%]">
                                <div class="flex flex-col">
                                    <span>{{ $human->jshshir }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 w-[12%] text-xs">{{ $human->passport_id }}</td>
                            <td class="px-4 py-3 w-[12%] text-xs">{{ $human->province . ', ' . $human->region }}
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
                                                <a href="{{ route('humans.edit', $human->id) }}"
                                                    class="block px-4 py-2 hover:bg-gray-100">✏️ Tahrirlash</a>
                                            </li>
                                            <li>
                                                <form method="POST" action="{{ route('humans.destroy', $human->id) }}"
                                                    onsubmit="return confirm('Are you sure you want to delete selected humans?');">
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
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="flex justify-between mt-5">
        <h1 class="text-2xl font-semibold text-gray-900">Couples</h1>

    </div>

    <div class="mt-4 bg-white rounded-lg shadow-md">
        <div class="mt-4 p-6 bg-white rounded-lg shadow-md flex justify-center space-x-4 contents-center">

            <div class="w-full border items-center border-gray-400 rounded-lg">
                <!-- Table -->
                <table class="w-full text-left min-w-[1400px]">
                    <!-- Head -->
                    <thead class="font-bold">
                        <tr>
                            <th class="py-4 px-5 w-[18%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Husband</span>
                                        </label>
                                    </div>
                                </div>
                            </th>
                            <th class="py-4 px-5 w-[18%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Wife</span>
                                        </label>
                                    </div>
                                </div>
                            </th>
                            <th class="py-4 px-5 w-[13%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Created At</span>
                                        </label>
                                    </div>
                                </div>
                            </th>
                            <th class="py-4 px-5 w-[13%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>User</span>
                                        </label>
                                    </div>
                                </div>
                            </th>
                            <th class="py-4 px-5 w-[13%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Status</span>
                                        </label>
                                    </div>
                                </div>
                            </th>
                            <th class="py-4 px-5 w-[13%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Results</span>
                                        </label>
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
                                    {{ $couple->user ? $couple->user->name : 'N/A' }}
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
