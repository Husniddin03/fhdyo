<x-user-app>
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <a href="#" class="inline-flex items-center gap-2 text-slate-800 dark:text-slate-100">
                <span class="text-xl font-semibold">Kalit kiriting</span>
            </a>
            <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">Agar sizda kalit bo'lmasa adminstratorga
                murojat qiling</p>
        </div>

        <x-card class="p-6 sm:p-8">
            <form action="{{ route('quiz.check') }}" method="POST" class="space-y-6" novalidate>
                @csrf

                <x-input name="key" label="Kalit" placeholder="8h1jjdj3" />

                <div class="flex items-center justify-center">
                    <x-button type="submit" class="w-full sm:w-auto">
                        Tekshirish
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.75 12H3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M12.75 9 15.75 12l-3 3" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </x-button>
                </div>
            </form>
        </x-card>

    </div>
</x-user-app>
