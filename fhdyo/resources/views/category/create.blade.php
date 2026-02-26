<x-app title='category'>
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-white">Create Category</h1>
            <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Add a category and optionally seed it with questions.</p>
        </div>

        <x-button variant="soft" color="slate" :href="route('categories.index')" onclick="window.location.href=this.getAttribute('href'); return false;">
            Back
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" stroke="currentColor" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </x-button>
    </div>

    <x-card class="p-6 sm:p-8">
        <form method="POST" action="{{ route('categories.store') }}" id="categoryForm" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <x-input name="category" label="Category name" required placeholder="e.g. Communication" />

                <div class="md:col-span-2">
                    <label for="description" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                        Description
                    </label>
                    <textarea name="description" id="description" rows="3"
                        class="w-full rounded-2xl border border-white/30 bg-white/60 px-4 py-3 text-sm text-slate-900 shadow-sm shadow-black/5 outline-none transition placeholder:text-slate-400 focus:bg-white/80 focus:ring-2 focus:ring-indigo-500/20 dark:border-slate-800/60 dark:bg-slate-950/40 dark:text-white dark:placeholder:text-slate-500 dark:focus:bg-slate-950/60"
                        placeholder="Optional: describe what this category is about">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="mt-2 text-xs font-medium text-rose-600 dark:text-rose-300">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div>
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="text-sm font-semibold text-slate-900 dark:text-white">Questions</div>
                        <div class="mt-1 text-sm text-slate-600 dark:text-slate-300">Optional. You can add more later.</div>
                    </div>
                    <x-button type="button" onclick="addQuestion()" variant="solid" color="indigo">
                        Add question
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 4.5v15m7.5-7.5h-15" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </x-button>
                </div>

                <div id="questionsContainer" class="mt-4 space-y-3">
                    <div
                        class="question-item flex items-center gap-3 rounded-2xl border border-white/30 bg-white/40 p-3 shadow-sm shadow-black/5 backdrop-blur-xl transition duration-200 ease-in-out dark:border-slate-800/60 dark:bg-slate-950/30">
                        <span class="question-number min-w-[30px] text-sm font-semibold text-slate-500 dark:text-slate-400">1.</span>
                        <input type="text" name="questions[]"
                            class="flex-1 rounded-2xl border border-white/30 bg-white/60 px-4 py-3 text-sm text-slate-900 shadow-sm shadow-black/5 outline-none transition placeholder:text-slate-400 focus:bg-white/80 focus:ring-2 focus:ring-indigo-500/20 dark:border-slate-800/60 dark:bg-slate-950/40 dark:text-white dark:placeholder:text-slate-500 dark:focus:bg-slate-950/60"
                            placeholder="Enter question" />
                        <button type="button" onclick="removeQuestion(this)"
                            class="remove-btn hidden rounded-2xl p-2 text-rose-600 transition hover:bg-rose-500/10 hover:text-rose-700 dark:text-rose-200">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 18 18 6M6 6l12 12" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex flex-col-reverse gap-3 border-t border-white/20 pt-6 sm:flex-row sm:justify-end dark:border-slate-800/60">
                <x-button variant="soft" color="slate" type="button" onclick="window.location.href='{{ route('categories.index') }}'">
                    Cancel
                </x-button>
                <x-button type="submit" color="success">
                    Create category
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="m4.5 12.75 4.5 4.5 10.5-10.5" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </x-button>
            </div>
        </form>
    </x-card>
</x-app>

<script>
    let questionCount = 1;

    function addQuestion() {
        questionCount++;
        const container = document.getElementById('questionsContainer');

        // Create new question item
        const questionItem = document.createElement('div');
        questionItem.className = 'question-item flex items-center gap-3 rounded-2xl border border-white/30 bg-white/40 p-3 shadow-sm shadow-black/5 backdrop-blur-xl transition duration-200 ease-in-out dark:border-slate-800/60 dark:bg-slate-950/30 opacity-0 -translate-y-2';
        questionItem.innerHTML = `
            <span class="question-number min-w-[30px] text-sm font-semibold text-slate-500 dark:text-slate-400">${questionCount}.</span>
            <input type="text" name="questions[]" 
                class="flex-1 rounded-2xl border border-white/30 bg-white/60 px-4 py-3 text-sm text-slate-900 shadow-sm shadow-black/5 outline-none transition placeholder:text-slate-400 focus:bg-white/80 focus:ring-2 focus:ring-indigo-500/20 dark:border-slate-800/60 dark:bg-slate-950/40 dark:text-white dark:placeholder:text-slate-500 dark:focus:bg-slate-950/60"
                placeholder="Enter question">
            <button type="button" onclick="removeQuestion(this)" 
                class="remove-btn rounded-2xl p-2 text-rose-600 transition hover:bg-rose-500/10 hover:text-rose-700 dark:text-rose-200">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 18 18 6M6 6l12 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                </svg>
            </button>
        `;

        container.appendChild(questionItem);

        requestAnimationFrame(() => {
            questionItem.classList.remove('opacity-0', '-translate-y-2');
            questionItem.classList.add('opacity-100', 'translate-y-0');
        });

        // Focus on new input
        questionItem.querySelector('input').focus();

        // Show remove buttons if there's more than one question
        updateRemoveButtons();
    }

    function removeQuestion(button) {
        const questionItem = button.closest('.question-item');

        // Add fade out animation
        questionItem.classList.add('opacity-0', '-translate-x-2');

        setTimeout(() => {
            questionItem.remove();
            updateQuestionNumbers();
            updateRemoveButtons();
        }, 300);
    }

    function updateQuestionNumbers() {
        const questions = document.querySelectorAll('.question-item');
        questions.forEach((item, index) => {
            const numberSpan = item.querySelector('.question-number');
            numberSpan.textContent = `${index + 1}.`;
        });
        questionCount = questions.length;
    }

    function updateRemoveButtons() {
        const questions = document.querySelectorAll('.question-item');
        const removeButtons = document.querySelectorAll('.remove-btn');

        // Show remove buttons only if there's more than one question
        if (questions.length > 1) {
            removeButtons.forEach(btn => btn.classList.remove('hidden'));
        } else {
            removeButtons.forEach(btn => btn.classList.add('hidden'));
        }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateRemoveButtons();
    });
</script>
