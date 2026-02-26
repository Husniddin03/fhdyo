@extends('layouts.app')

@section('title', 'Categories')
@section('nav', 'category')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Categories</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage categories and their questions.</p>
            </div>

            <a href="{{ route('categories.create') }}"
                class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl px-5 py-2.5 w-full sm:w-auto">
                <span>Add category</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </a>
        </div>

        <div class="mt-6 space-y-4">
            @foreach ($categories as $index => $category)
                <div class="rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 overflow-hidden">
                    <div class="flex justify-between items-center p-4 sm:p-5 bg-gray-50 dark:bg-gray-700 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 transition"
                        onclick="toggleCategory({{ $index }})">
                        <div class="flex items-center gap-3">
                            <svg id="arrow-{{ $index }}" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="w-5 h-5 text-gray-500 dark:text-gray-200 transition-transform duration-200">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                            <div>
                                <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white">{{ $category->category }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-300">{{ $category->description }}</p>
                            </div>
                        </div>
                        <span class="text-sm text-gray-500 dark:text-gray-300">{{ count($category->questions) }} questions</span>
                    </div>

                    <div id="category-{{ $index }}" class="hidden">
                        <div class="p-4 sm:p-5">
                            <form id="bulkDeleteForm-{{ $index }}" method="POST" action="{{ route('categories.destroy', -1) }}"
                                onsubmit="return confirm('Are you sure you want to delete selected questions?');"
                                class="hidden mb-4 rounded-xl border border-rose-200 dark:border-rose-900/40 bg-rose-50 dark:bg-rose-950/40 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-4">
                                @csrf
                                @method('DELETE')
                                <div id="selectedInputs-{{ $index }}"></div>
                                <span class="text-sm font-medium text-rose-700 dark:text-rose-200" id="selectedCount-{{ $index }}">0 selected</span>
                                <button type="submit"
                                    class="bg-rose-600 hover:bg-rose-700 text-white rounded-xl px-5 py-2.5 w-full sm:w-auto">
                                    Delete selected
                                </button>
                            </form>

                            <div class="mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-end gap-3">
                                <a href="{{ route('categories.edit', $category->id) }}"
                                    class="inline-flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white rounded-xl px-5 py-2.5 w-full sm:w-auto">
                                    Edit category
                                </a>

                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="w-full sm:w-auto">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full inline-flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-rose-700 dark:text-rose-200 rounded-xl px-5 py-2.5"
                                        onclick="return confirm('Are you sure you want to delete this category?');">
                                        Delete category
                                    </button>
                                </form>
                            </div>

                            @if (count($category->questions) > 0)
                                <div class="overflow-x-auto rounded-xl overflow-hidden divide-y divide-gray-200 dark:divide-gray-700 border border-gray-200 dark:border-gray-700">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-200">
                                            <tr>
                                                <th class="px-4 py-3 text-left">
                                                    <input type="checkbox" id="allCheckbox-{{ $index }}"
                                                        class="w-4 h-4 rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500"
                                                        onchange="toggleAllCheckboxes({{ $index }})" />
                                                </th>
                                                <th class="px-4 py-3 text-left text-sm font-medium">Question</th>
                                                <th class="px-4 py-3 text-left text-sm font-medium">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                            @foreach ($category->questions as $question)
                                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                                    <td class="px-4 py-3">
                                                        <input type="checkbox" id="checkbox-{{ $index }}-{{ $question->id }}"
                                                            data-question="{{ $question->id }}" data-category="{{ $index }}"
                                                            class="question-checkbox w-4 h-4 rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500"
                                                            onchange="updateDeleteForm({{ $index }})" />
                                                    </td>
                                                    <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-100">{{ $question->question }}</td>
                                                    <td class="px-4 py-3 text-sm">
                                                        <form method="POST" action="{{ route('questions.destroy', $question->id) }}"
                                                            onsubmit="return confirm('Are you sure you want to delete this question?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="inline-flex items-center justify-center rounded-lg p-2 hover:bg-gray-100 dark:hover:bg-gray-600 transition text-rose-600 dark:text-rose-200">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.166m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-gray-500 dark:text-gray-400 text-center py-8">No questions in this category yet.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

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
