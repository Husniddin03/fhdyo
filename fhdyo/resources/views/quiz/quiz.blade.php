<x-user-app>

    <form action="{{ route('quiz.answers') }}" method="POST" class="w-full max-w-2xl">
        @csrf
        @php $count = 0; @endphp
        @foreach ($quizes as $quiz)
            <div id="quiz_{{ $count }}" class="px-4 text-center"
                style="display: {{ $count === 0 ? 'block' : 'none' }}">
                <h1 class="text-4xl font-bold text-[#6366f1] mb-2">Quiz Test</h1>
                <p class="text-gray-500 mb-8">Savollarga javob bering</p>

                <div class="w-full max-w-lg mx-auto mb-6">
                    <div class="flex justify-between text-xs text-gray-400 mb-1">
                        <span>Savol {{ $count + 1 }}/{{ count($quizes) }}</span>
                        <span>{{ (($count + 1) / count($quizes)) * 100 }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 h-2 rounded-full overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-full"
                            style="width: {{ (($count + 1) / count($quizes)) * 100 }}%;">
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-8 shadow-2xl shadow-indigo-100 border border-gray-100">
                    <div class="inline-block bg-[#7c3aed] text-white text-[10px] font-bold px-3 py-1 rounded-full mb-6">
                        Savol {{ $count + 1 }}
                    </div>

                    <h2 class="text-2xl font-bold text-[#1e293b] mb-8">{{ $quiz['question'] }}</h2>

                    <div
                        class="bg-orange-50 border border-orange-100 rounded-xl py-4 flex items-center justify-center gap-2 mb-8">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-red-500 font-bold">60s</span>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <label
                            class="bg-[#22c55e] hover:bg-green-600 text-white font-semibold py-4 rounded-xl flex items-center justify-center gap-2 transition-all">
                            <input type="radio" name="answers[{{ $count }}][answer]"
                                value="1"><span>✓</span> Ha
                        </label>
                        <label
                            class="bg-[#f43f5e] hover:bg-rose-600 text-white font-semibold py-4 rounded-xl flex items-center justify-center gap-2 transition-all shadow-md">
                            <input type="radio" name="answers[{{ $count }}][answer]"
                                value="0"><span>✕</span> Yo'q
                        </label>
                        <input type="hidden" name="answers[{{ $count }}][question_id]"
                            value="{{ $quiz['question_id'] }}">
                    </div>

                    <button type="button" onclick="show({{ $count + 1 }})"
                        class="bg-gradient-to-r from-blue-500 to-purple-500 hover:opacity-90 text-white px-8 py-3 rounded-xl font-medium flex items-center gap-2 mx-auto transition-all">
                        Keyingisi
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>

                </div>
            </div>
            @php $count++; @endphp
        @endforeach


        <button type="submit" id="submit"
            class="bg-gradient-to-r hidden from-blue-500 to-purple-500 hover:opacity-90 text-white px-8 py-3 rounded-xl font-medium flex items-center gap-2 mx-auto transition-all mt-4">
            Javoblarni yuborish
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                </path>
            </svg>
        </button>
    </form>

</x-user-app>
