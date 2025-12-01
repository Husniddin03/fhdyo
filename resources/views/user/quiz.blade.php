<x-user.main>
    <div class="max-w-xl mx-auto py-10">
        <div class="shadow-lg rounded-xl p-6">

            <!-- User name -->
            <h2 class="text-2xl font-bold text-center mb-4">
                {{ $user->name }}, savollarga javob bering
            </h2>

            <!-- Timer -->
            <div class="text-center mb-6">
                <span class="text-lg font-semibold">Qolgan vaqt: </span>
                <span id="timer" class="text-xl font-bold text-red-600">60</span> sekund
            </div>

            <!-- Question text -->
            <h3 id="questionText" class="text-xl font-semibold text-center mb-4">
                {{ $questions[0]->question }}
            </h3>

            <!-- Buttons -->
            <div class="flex justify-center gap-4">
                <button onclick="answer(1)" class="px-6 py-3 bg-green-500 rounded-lg hover:bg-green-600 shadow">
                    Ha
                </button>
                <button onclick="answer(0)" class="px-6 py-3 bg-red-500 rounded-lg hover:bg-red-600 shadow">
                    Yo‘q
                </button>
            </div>

        </div>

        <!-- Hidden form to submit results -->
        <form id="resultForm" action="{{ route('user.result') }}" method="POST">
            @csrf
            <input type="hidden" name="answers" id="answersInput">
            <input type="hidden" name="user_id" value="{{ $user->id }}">
        </form>
    </div>

    <script>
        // Savollarni JSON sifatida oling
        let questions = @json($questions);
        let currentIndex = 0;

        // Har bir javob {id: , answer: } shaklida saqlanadi
        let answers = [];

        let timeLeft = 60;
        let timer = document.getElementById("timer");

        // Start countdown
        let countdown = setInterval(() => {
            timeLeft--;
            timer.textContent = timeLeft;

            if (timeLeft <= 0) {
                recordAnswer(null); // vaqt tugasa null
            }
        }, 1000);

        function answer(val) {
            recordAnswer(val);
        }

        function recordAnswer(val) {
            // Javobni id bilan saqlash
            answers.push({
                id: questions[currentIndex].id,
                answer: val
            });

            currentIndex++;

            // Agar barcha savollar tugagan bo‘lsa — natija jo‘natiladi
            if (currentIndex >= questions.length) {
                finishQuiz();
                return;
            }

            // Yangi savolga o'tish
            document.getElementById("questionText").textContent =
                questions[currentIndex].question;

            // Timer reset
            timeLeft = 60;
        }

        function finishQuiz() {
            clearInterval(countdown);

            // JSON shaklida yuborish
            document.getElementById("answersInput").value = JSON.stringify(answers);
            document.getElementById("resultForm").submit();
        }
    </script>
</x-user.main>
