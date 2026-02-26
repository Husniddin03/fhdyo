<x-user-app>

    <form action="{{ route('quiz.answers') }}" method="POST" class="w-full max-w-2xl">
        @csrf
        @php $count = 0; @endphp
        @foreach ($quizes as $quiz)
            <div id="quiz_{{ $count }}" @class([
                'px-4 text-center transition duration-200 ease-in-out',
                'hidden' => $count !== 0,
            ])>
                <h1 class="text-3xl sm:text-4xl font-semibold tracking-tight text-slate-900 dark:text-white mb-2">Quiz</h1>
                <p class="text-sm text-slate-600 dark:text-slate-300 mb-8">Savollarga javob bering</p>

                <div class="w-full max-w-lg mx-auto mb-6">
                    <div class="flex justify-between text-xs text-slate-500 dark:text-slate-400 mb-1">
                        <span>Savol {{ $count + 1 }}/{{ count($quizes) }}</span>
                        <span>{{ (($count + 1) / count($quizes)) * 100 }}%</span>
                    </div>
                    <div class="w-full bg-slate-900/10 dark:bg-white/10 h-2 rounded-full overflow-hidden">
                        <div id="progress_{{ $count }}" data-width="{{ (($count + 1) / count($quizes)) * 100 }}"
                            class="h-full w-0 bg-gradient-to-r from-indigo-500 to-fuchsia-500 transition-all duration-300">
                        </div>
                    </div>
                </div>

                <x-card class="p-6 sm:p-8">
                    <div class="inline-flex items-center gap-2 rounded-full bg-indigo-500/10 px-3 py-1 text-[10px] font-semibold text-indigo-700 dark:text-indigo-200 mb-6">
                        Savol {{ $count + 1 }}
                    </div>

                    <h2 class="text-xl sm:text-2xl font-semibold tracking-tight text-slate-900 dark:text-white mb-8">{{ $quiz['question'] }}</h2>

                    <div
                        class="bg-amber-500/10 border border-amber-500/20 rounded-2xl py-4 flex items-center justify-center gap-2 mb-8 text-amber-800 dark:text-amber-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-semibold">60s</span>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <label
                            class="cursor-pointer rounded-2xl border border-white/20 bg-emerald-600 px-4 py-4 text-white font-semibold shadow-sm transition duration-200 ease-in-out hover:bg-emerald-500 focus-within:ring-2 focus-within:ring-emerald-400/40">
                            <span class="flex items-center justify-center gap-2">
                                <input class="sr-only" type="radio" name="answers[{{ $count }}][answer]" value="1">
                                <span class="grid h-8 w-8 place-items-center rounded-xl bg-white/15">✓</span>
                                <span>Ha</span>
                            </span>
                        </label>
                        <label
                            class="cursor-pointer rounded-2xl border border-white/20 bg-rose-600 px-4 py-4 text-white font-semibold shadow-sm transition duration-200 ease-in-out hover:bg-rose-500 focus-within:ring-2 focus-within:ring-rose-400/40">
                            <span class="flex items-center justify-center gap-2">
                                <input class="sr-only" type="radio" name="answers[{{ $count }}][answer]" value="0">
                                <span class="grid h-8 w-8 place-items-center rounded-xl bg-white/15">✕</span>
                                <span>Yo'q</span>
                            </span>
                        </label>
                        <input type="hidden" name="answers[{{ $count }}][question_id]"
                            value="{{ $quiz['question_id'] }}">
                    </div>

                    <button type="button" onclick="show({{ $count + 1 }})"
                        class="inline-flex items-center gap-2 mx-auto rounded-2xl bg-gradient-to-r from-indigo-500 to-fuchsia-500 px-8 py-3 text-sm font-semibold text-white shadow-sm transition duration-200 ease-in-out hover:opacity-95 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/30">
                        Keyingisi
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>

                </x-card>
            </div>
            @php $count++; @endphp
        @endforeach


        <button type="submit" id="submit"
            class="hidden mt-4 inline-flex items-center gap-2 mx-auto rounded-2xl bg-gradient-to-r from-indigo-500 to-fuchsia-500 px-8 py-3 text-sm font-semibold text-white shadow-sm transition duration-200 ease-in-out hover:opacity-95 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/30">
            Javoblarni yuborish
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                </path>
            </svg>
        </button>
    </form>

    <script>
        (function() {
            const total = {{ count($quizes) }};
            const submit = document.getElementById('submit');

            document.querySelectorAll('[id^="progress_"]').forEach((el) => {
                const w = el.getAttribute('data-width');
                if (w) el.style.width = `${w}%`;
            });

            window.show = function(nextIndex) {
                for (let i = 0; i < total; i++) {
                    const el = document.getElementById(`quiz_${i}`);
                    if (!el) continue;
                    el.classList.toggle('hidden', i !== nextIndex);
                }

                if (submit) {
                    submit.classList.toggle('hidden', nextIndex < total - 1);
                }
            };
        })();
    </script>

</x-user-app>
