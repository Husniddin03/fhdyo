<x-user-app>
    <div class="w-full max-w-md">
        <div class="text-center">
            <div class="mx-auto grid h-14 w-14 place-items-center rounded-2xl bg-emerald-500/10 text-emerald-700 dark:text-emerald-200">
                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 4.5 4.5 10.5-10.5" />
                </svg>
            </div>
            <h1 class="mt-5 text-2xl font-semibold tracking-tight text-slate-900 dark:text-white">Result</h1>
            <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Thank you for completing the quiz.</p>
        </div>

        <x-card class="mt-8 p-6 sm:p-8">
            <div class="text-center">
                <div class="text-3xl font-semibold text-indigo-700 dark:text-indigo-200">{{ $answer }}</div>
                <div class="mt-3 text-sm text-slate-600 dark:text-slate-300">Your submission has been recorded.</div>

                <div class="mt-6">
                    <x-button type="button" onclick="window.location.href='{{ route('quiz.index') }}'" class="w-full">
                        Start another quiz
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </x-button>
                </div>
            </div>
        </x-card>
    </div>
</x-user-app>
