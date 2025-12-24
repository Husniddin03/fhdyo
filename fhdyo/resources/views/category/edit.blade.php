<x-app title='category'>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Update Category</h1>
        <a href="{{ route('categories.index') }}"
            class="flex justify-center items-center gap-2 border px-4 py-2 rounded-md border-gray-300 hover:bg-gray-50 transition">
            <span>Back</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
            </svg>
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form method="POST" action="{{ route('categories.update', $category->id) }}" id="categoryForm">
            @csrf
            @method('PUT')

            <!-- Category Name -->
            <div class="mb-6">
                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                    Category Name <span class="text-red-500">*</span>
                </label>
                <input type="text" name="category" id="category" required
                    value="{{ old('category', $category->category) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                    placeholder="Enter category name">
                @error('category')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category Description -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Description
                </label>
                <textarea name="description" id="description" rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                    placeholder="Enter category description (optional)">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Questions Section -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-4">
                    <label class="block text-sm font-medium text-gray-700">
                        Questions
                    </label>
                    <button type="button" onclick="addQuestion()"
                        class="flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Add Question
                    </button>
                </div>

                <!-- Questions Container -->
                <div id="questionsContainer" class="space-y-3">
                    @foreach ($category->questions as $index => $question)
                        <div class="question-item flex items-center gap-3 p-3 bg-gray-50 rounded-md">
                            <span class="question-number text-sm font-medium text-gray-600 min-w-[30px]">{{ $index + 1 }}.</span>
                            <input type="text" name="questions[]" value="{{ old('questions.' . $index, $question->question) }}"
                                class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                placeholder="Enter question">
                            <button type="button" onclick="removeQuestion(this)"
                                class="remove-btn {{ $loop->count == 1 ? 'hidden' : '' }} text-red-600 hover:text-red-800 p-2 rounded-md hover:bg-red-50 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>

                <p class="mt-2 text-sm text-gray-500">
                    Update questions for this category. You can also add/remove questions.
                </p>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('categories.index') }}"
                    class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition">
                    Cancel
                </a>
                <button type="submit"
                    class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                    Update Category
                </button>
            </div>
        </form>
    </div>
</x-app>
<script>
    let questionCount = document.querySelectorAll('.question-item').length;

    function addQuestion() {
        questionCount++;
        const container = document.getElementById('questionsContainer');

        const questionItem = document.createElement('div');
        questionItem.className = 'question-item flex items-center gap-3 p-3 bg-gray-50 rounded-md animate-slideIn';
        questionItem.innerHTML = `
            <span class="question-number text-sm font-medium text-gray-600 min-w-[30px]">${questionCount}.</span>
            <input type="text" name="questions[]" 
                class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                placeholder="Enter question">
            <button type="button" onclick="removeQuestion(this)" 
                class="remove-btn text-red-600 hover:text-red-800 p-2 rounded-md hover:bg-red-50 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        `;
        container.appendChild(questionItem);
        questionItem.querySelector('input').focus();
        updateRemoveButtons();
    }

    function removeQuestion(button) {
        const questionItem = button.closest('.question-item');
        questionItem.style.opacity = '0';
        questionItem.style.transform = 'translateX(-20px)';
        setTimeout(() => {
            questionItem.remove();
            updateQuestionNumbers();
            updateRemoveButtons();
        }, 300);
    }

    function updateQuestionNumbers() {
        const questions = document.querySelectorAll('.question-item');
        questions.forEach((item, index) => {
            item.querySelector('.question-number').textContent = `${index + 1}.`;
        });
        questionCount = questions.length;
    }

    function updateRemoveButtons() {
        const questions = document.querySelectorAll('.question-item');
        const removeButtons = document.querySelectorAll('.remove-btn');
        if (questions.length > 1) {
            removeButtons.forEach(btn => btn.classList.remove('hidden'));
        } else {
            removeButtons.forEach(btn => btn.classList.add('hidden'));
        }
    }

    document.addEventListener('DOMContentLoaded', updateRemoveButtons);
</script>
