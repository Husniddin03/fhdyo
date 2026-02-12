<div class="flex items-center justify-center min-h-screen bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500">
    <div class="bg-white p-8 rounded-2xl shadow-2xl transform transition duration-500 hover:scale-105">
        <div class="flex flex-col items-center">
            <!-- Icon -->
            <div class="flex items-center justify-center w-16 h-16 rounded-full bg-green-100 mb-4">
                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>


            <!-- Subtext -->
            <p class="mt-4 text-center text-gray-600 text-lg">
                🎉 Thank you for completing the quiz!
            </p>

            <!-- Button -->
            <a href="{{ route('quiz.index') }}"
                class="mt-6 inline-block px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold rounded-lg shadow-md hover:from-blue-600 hover:to-indigo-700 transition duration-300">
                Start Another Quiz
            </a>
        </div>
    </div>
</div>
