<div class="flex items-center justify-center min-h-screen bg-red-100">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center text-green-600">
            {{ $answer }}
        </h2>
        <p class="mt-4 text-center text-gray-600">
            Thank you for completing the quiz!
        </p>
        <a href="{{ route('quiz.index') }}"
            class="mt-6 inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Start Another Quiz
        </a>
    </div>
</div>
