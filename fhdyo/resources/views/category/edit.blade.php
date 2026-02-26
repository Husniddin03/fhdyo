@extends('layouts.app')

@section('title', 'Update Category')
@section('nav', 'category')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Update Category</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Edit category details and questions.</p>
            </div>
            <a href="{{ route('categories.index') }}"
                class="inline-flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white rounded-xl px-5 py-2.5 w-full sm:w-auto">
                <span>Back</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
            </a>
        </div>

        <div class="mt-6 max-w-2xl mx-auto rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-6 sm:p-8">
            <form method="POST" action="{{ route('categories.update', $category->id) }}" id="categoryForm" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Category Name</label>
                    <input type="text" name="category" id="category" required value="{{ old('category', $category->category) }}"
                        class="mt-2 w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500"
                        placeholder="Enter category name">
                    @error('category')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Description</label>
                    <textarea name="description" id="description" rows="3"
                        class="mt-2 w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500"
                        placeholder="Enter category description (optional)">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Questions</label>
                        <button type="button" onclick="addQuestion()"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl px-5 py-2.5 w-full sm:w-auto inline-flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Add Question
                        </button>
                    </div>

                    <div id="questionsContainer" class="mt-4 space-y-3">
                        @foreach ($category->questions as $index => $question)
                            <div class="question-item flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-900/40 rounded-xl border border-gray-200 dark:border-gray-700">
                                <span class="question-number text-sm font-medium text-gray-600 dark:text-gray-300 min-w-[30px]">{{ $index + 1 }}.</span>
                                <input type="text" name="questions[]" value="{{ old('questions.' . $index, $question->question) }}"
                                    class="flex-1 w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500"
                                    placeholder="Enter question">
                                <button type="button" onclick="removeQuestion(this)"
                                    class="remove-btn {{ $loop->count == 1 ? 'hidden' : '' }} rounded-lg p-2 hover:bg-gray-100 dark:hover:bg-gray-700 transition text-rose-600 dark:text-rose-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Update questions for this category. You can also add/remove questions.</p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 sm:justify-end pt-2">
                    <a href="{{ route('categories.index') }}"
                        class="inline-flex items-center justify-center bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white rounded-xl px-5 py-2.5 w-full sm:w-auto">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl px-5 py-2.5 w-full sm:w-auto">
                        Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
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
