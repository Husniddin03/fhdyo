<!DOCTYPE html>
<html lang="uz">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - Test Platformasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.6;
            }
        }

        .pulse-slow {
            animation: pulse 2s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 min-h-screen">
    <!-- Container -->
    <div class="container mx-auto px-4 py-6 md:py-12 max-w-3xl">
        <!-- Header -->
        <div class="text-center mb-8 fade-in">
            <h1
                class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-2">
                Quiz Test
            </h1>
            <p class="text-gray-600 text-sm md:text-base">Bilimingizni sinab ko'ring</p>
        </div>

        <!-- Progress Bar -->
        <div id="progressBar" class="mb-8 fade-in">
            <div class="flex justify-between text-sm text-gray-600 mb-2">
                <span id="progressText">Savol 1 / 3</span>
                <span id="progressPercent">33%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                <div id="progressFill"
                    class="bg-gradient-to-r from-blue-500 to-purple-500 h-3 rounded-full transition-all duration-500 ease-out"
                    style="width: 33%"></div>
            </div>
        </div>

        <!-- Quiz Card -->
        <div id="quiz" class="bg-white rounded-2xl shadow-2xl p-6 md:p-10 fade-in">
            <!-- JavaScript yuklaydi -->
        </div>
    </div>

    <script>
        const questions = [
            "Dasturlashni yoqtirasizmi?",
            "JavaScript qiziqarli tilmi?",
            "Laravel bilan ishlaysizmi?"
        ];

        let current = 0;
        let answers = [];
        let timer;
        let timeLeft = 60;

        const quizDiv = document.getElementById("quiz");
        const progressText = document.getElementById("progressText");
        const progressPercent = document.getElementById("progressPercent");
        const progressFill = document.getElementById("progressFill");

        function updateProgress() {
            const progress = ((current + 1) / questions.length) * 100;
            progressText.textContent = `Savol ${current + 1} / ${questions.length}`;
            progressPercent.textContent = Math.round(progress) + "%";
            progressFill.style.width = progress + "%";
        }

        function showQuestion(index) {
            quizDiv.innerHTML = "";
            quizDiv.className = "bg-white rounded-2xl shadow-2xl p-6 md:p-10 fade-in";

            updateProgress();

            // Question number badge
            const badge = document.createElement("div");
            badge.className =
                "inline-block bg-gradient-to-r from-blue-500 to-purple-500 text-white px-4 py-1 rounded-full text-sm font-semibold mb-6";
            badge.textContent = `Savol ${index + 1}`;
            quizDiv.appendChild(badge);

            // Question text
            const qDiv = document.createElement("div");
            qDiv.className = "mb-8";
            const qText = document.createElement("h2");
            qText.className = "text-2xl md:text-3xl font-bold text-gray-800 leading-relaxed";
            qText.textContent = questions[index];
            qDiv.appendChild(qText);
            quizDiv.appendChild(qDiv);

            // Timer
            const timerDiv = document.createElement("div");
            timerDiv.className =
                "flex items-center justify-center mb-8 p-4 bg-gradient-to-r from-red-50 to-orange-50 rounded-xl border-2 border-red-200";
            timerDiv.innerHTML = `
                <svg class="w-6 h-6 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-lg font-bold text-red-600" id="timerText">60s</span>
            `;
            quizDiv.appendChild(timerDiv);

            timeLeft = 60;
            const timerText = document.getElementById("timerText");

            clearInterval(timer);
            timer = setInterval(() => {
                timeLeft--;
                timerText.textContent = timeLeft + "s";

                if (timeLeft <= 10) {
                    timerText.className = "text-lg font-bold text-red-600 pulse-slow";
                }

                if (timeLeft <= 0) {
                    clearInterval(timer);
                    answers[index] = -1;
                    showTimeoutMessage();
                }
            }, 1000);

            // Options
            const optionsDiv = document.createElement("div");
            optionsDiv.className = "grid grid-cols-1 md:grid-cols-2 gap-4";

            const yesBtn = document.createElement("button");
            yesBtn.className =
                "group relative overflow-hidden bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white font-bold py-4 md:py-6 px-8 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300";
            yesBtn.innerHTML = `
                <span class="relative z-10 flex items-center justify-center text-lg">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Ha
                </span>
            `;
            yesBtn.onclick = () => handleAnswer(index, 1);

            const noBtn = document.createElement("button");
            noBtn.className =
                "group relative overflow-hidden bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white font-bold py-4 md:py-6 px-8 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300";
            noBtn.innerHTML = `
                <span class="relative z-10 flex items-center justify-center text-lg">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Yo'q
                </span>
            `;
            noBtn.onclick = () => handleAnswer(index, 0);

            optionsDiv.appendChild(yesBtn);
            optionsDiv.appendChild(noBtn);
            quizDiv.appendChild(optionsDiv);
        }

        function handleAnswer(index, value) {
            clearInterval(timer);
            answers[index] = value;
            showFeedback(value);
        }

        function showFeedback(value) {
            quizDiv.innerHTML = "";

            const feedbackDiv = document.createElement("div");
            feedbackDiv.className = "text-center py-12";

            if (value === 1) {
                feedbackDiv.innerHTML = `
                    <div class="mb-6">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-4">
                            <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">Ajoyib!</h3>
                        <p class="text-gray-600 mt-2">Javobingiz qabul qilindi</p>
                    </div>
                `;
            } else if (value === 0) {
                feedbackDiv.innerHTML = `
                    <div class="mb-6">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-100 rounded-full mb-4">
                            <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">Tushunarli</h3>
                        <p class="text-gray-600 mt-2">Javobingiz qabul qilindi</p>
                    </div>
                `;
            }

            quizDiv.appendChild(feedbackDiv);

            setTimeout(() => {
                if (current === questions.length - 1) {
                    finishQuiz();
                } else {
                    current++;
                    showQuestion(current);
                }
            }, 1500);
        }

        function showTimeoutMessage() {
            quizDiv.innerHTML = `
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-red-100 rounded-full mb-4">
                        <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800">Vaqt tugadi!</h3>
                    <p class="text-gray-600 mt-2">Keyingi savolga o'tamiz</p>
                </div>
            `;

            setTimeout(() => {
                if (current === questions.length - 1) {
                    finishQuiz();
                } else {
                    current++;
                    showQuestion(current);
                }
            }, 2000);
        }

        function finishQuiz() {
            document.getElementById("progressBar").style.display = "none";

            quizDiv.innerHTML = `
                <div class="text-center py-8">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full mb-6">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Quiz Tugadi!</h2>
                    <p class="text-gray-600 mb-8">Barcha savollar yakunlandi. Natijalar ko'rib chiqilmoqda...</p>
                    
                    <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-6 mb-8">
                        <p class="text-sm text-gray-600 mb-2">Sizning javoblaringiz:</p>
                        <p class="text-lg font-mono font-bold text-gray-800">${answers.join(", ")}</p>
                    </div>
                    
                    <div class="flex justify-center">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-purple-600"></div>
                    </div>
                </div>
            `;

            // Backend ga yuborish
            fetch("/quiz/answers", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.content || ""
                    },
                    body: JSON.stringify({
                        answers
                    })
                })
                .then(res => res.json())
                .then(data => {
                    console.log("Server javobi:", data);
                    quizDiv.innerHTML += `
                    <div class="mt-6">
                        <button onclick="location.reload()" class="bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                            Qaytadan boshlash
                        </button>
                    </div>
                `;
                })
                .catch(err => {
                    console.error("Xatolik:", err);
                });
        }

        // Boshlash
        showQuestion(current);
    </script>
</body>

</html>
