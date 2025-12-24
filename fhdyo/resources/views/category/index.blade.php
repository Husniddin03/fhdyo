<x-app title="category">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-semibold text-gray-900">Categories</h1>

        <a href="{{ route('categories.create') }}"
            class="flex justify-center items-center gap-2 border px-4 py-2 rounded-md border-gray-300 bg-green-50 hover:bg-green-100 transition">
            <span>Add category</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
        </a>
    </div>

    <div class="mt-6 space-y-4">
        @foreach ($categories as $index => $category)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Category Header (Dropdown Toggle) -->
                <div class="flex justify-between items-center p-4 bg-gray-50 cursor-pointer hover:bg-gray-100 transition"
                    onclick="toggleCategory({{ $index }})">
                    <div class="flex items-center gap-3">
                        <svg id="arrow-{{ $index }}" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-5 h-5 transition-transform duration-200">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                        <div>
                            <h3 class="text-lg font-medium text-gray-800">{{ $category->category }}</h3>
                            <p class="text-sm text-gray-600">{{ $category->description }}</p>
                        </div>
                    </div>
                    <span class="text-sm text-gray-500">{{ count($category->questions) }} questions</span>
                </div>

                <!-- Category Content (Collapsible) -->
                <div id="category-{{ $index }}" class="hidden">
                    <div class="p-4">
                        <!-- Bulk Actions Bar -->
                        <form id="bulkDeleteForm-{{ $index }}" method="POST"
                            action="{{ route('categories.destroy', -1) }}"
                            onsubmit="return confirm('Are you sure you want to delete selected questions?');"
                            class="hidden mb-4 bg-red-500 flex justify-between items-center gap-2 p-3 rounded-md">
                            @csrf
                            @method('DELETE')
                            <div id="selectedInputs-{{ $index }}"></div>
                            <span class="text-white font-medium" id="selectedCount-{{ $index }}">0
                                selected</span>
                            <button type="submit" class="text-white bg-red-600 hover:bg-red-700 px-4 py-1 rounded">
                                Delete selected
                            </button>
                        </form>

                        <!-- Add Question Button -->
                        <div class="mb-4 flex justify-end">
                            <a href="{{ route('categories.edit', $category->id) }}"
                                class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-900 font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Edit category
                            </a>

                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center gap-2 text-red-600 hover:text-red-900 font-medium ml-6"
                                    onclick="return confirm('Are you sure you want to delete this category?');">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.166m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                    Delete category
                                </button>
                            </form>
                        </div>



                        <!-- Questions Table -->
                        @if (count($category->questions) > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 py-1 text-left">
                                                <input type="checkbox" id="allCheckbox-{{ $index }}"
                                                    class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                    onchange="toggleAllCheckboxes({{ $index }})" />
                                            </th>
                                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Question
                                            </th>
                                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($category->questions as $question)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-4 py-3">
                                                    <input type="checkbox"
                                                        id="checkbox-{{ $index }}-{{ $question->id }}"
                                                        data-question="{{ $question->id }}"
                                                        data-category="{{ $index }}"
                                                        class="question-checkbox w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                        onchange="updateDeleteForm({{ $index }})" />
                                                </td>
                                                <td class="px-4 py-3 text-sm text-gray-800">{{ $question->question }}
                                                </td>
                                                <td class="px-4 py-3 text-sm">
                                                    <div class="flex items-center gap-3">
                                                        <form method="POST"
                                                            action="{{ route('questions.destroy', $question->id) }}"
                                                            onsubmit="return confirm('Are you sure you want to delete this question?');"
                                                            class="inline-flex items-center gap-2 text-red-600 hover:text-red-900 font-medium">
                                                            @csrf
                                                            @method('DELETE')
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="w-5 h-5">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.166m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                            </svg>
                                                            <button type="submit"
                                                                class="text-red-600 hover:text-red-900 font-medium">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-8">No questions in this category yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app>

<script>
    // Toggle category dropdown
    function toggleCategory(index) {
        const content = document.getElementById(`category-${index}`);
        const arrow = document.getElementById(`arrow-${index}`);

        content.classList.toggle('hidden');
        arrow.classList.toggle('rotate-180');
    }

    // Toggle all checkboxes in a category
    function toggleAllCheckboxes(categoryIndex) {
        const allCheckbox = document.getElementById(`allCheckbox-${categoryIndex}`);
        const checkboxes = document.querySelectorAll(
            `input[type="checkbox"][data-category="${categoryIndex}"].question-checkbox`
        );

        checkboxes.forEach(checkbox => {
            checkbox.checked = allCheckbox.checked;
        });

        updateDeleteForm(categoryIndex);
    }

    // Update bulk delete form for a specific category
    function updateDeleteForm(categoryIndex) {
        const bulkForm = document.getElementById(`bulkDeleteForm-${categoryIndex}`);
        const selectedInputs = document.getElementById(`selectedInputs-${categoryIndex}`);
        const selectedCount = document.getElementById(`selectedCount-${categoryIndex}`);
        const allCheckbox = document.getElementById(`allCheckbox-${categoryIndex}`);

        // Get all checked checkboxes in this category
        const checked = document.querySelectorAll(
            `input[type="checkbox"][data-category="${categoryIndex}"].question-checkbox:checked`
        );

        // Clear previous hidden inputs
        selectedInputs.innerHTML = '';

        // Add hidden input for each checked question
        checked.forEach(cb => {
            const hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'questions[]';
            hidden.value = cb.dataset.question;
            selectedInputs.appendChild(hidden);
        });

        // Update selected count
        selectedCount.textContent = `${checked.length} selected`;

        // Show/hide bulk delete form
        bulkForm.classList.toggle('hidden', checked.length === 0);

        // Update "select all" checkbox state
        const totalCheckboxes = document.querySelectorAll(
            `input[type="checkbox"][data-category="${categoryIndex}"].question-checkbox`
        ).length;

        if (allCheckbox) {
            allCheckbox.checked = checked.length === totalCheckboxes && totalCheckboxes > 0;
            allCheckbox.indeterminate = checked.length > 0 && checked.length < totalCheckboxes;
        }
    }
</script>

<style>
    .rotate-180 {
        transform: rotate(-90deg);
    }
</style>
