<!doctype html>
<html lang="en" class="h-full">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Optional: Tailwind config for custom colors
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f0f7ff',
                            500: '#1e76ff',
                            600: '#165fcb',
                        },
                    },
                },
            },
        };
    </script>
</head>

<body class="h-full bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-900 dark:to-slate-950">
    <main class="min-h-full grid place-items-center px-4">
        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                <a href="#" class="inline-flex items-center gap-2 text-slate-800 dark:text-slate-100">
                    <span class="text-xl font-semibold">Kalit kiriting</span>
                </a>
                <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">Agar sizda kalit bo'lmasa adminstratorga
                    murojat qiling</p>
            </div>

            <div
                class="rounded-2xl bg-white/70 backdrop-blur-sm shadow-xl border border-slate-200 dark:bg-slate-900/60 dark:border-slate-800">
                <div class="p-6 sm:p-8">
                    <form action="{{ route('quiz.check') }}" method="POST" class="space-y-6" novalidate>
                        @csrf
                        <div>
                            <label for="kalit"
                                class="block text-sm font-medium text-slate-700 dark:text-slate-300">Kalit</label>
                            <div class="mt-2 relative">
                                <input type="text" id="kalit" name="kalit" required autocomplete="kalit"
                                    class="w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-slate-900 shadow-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100"
                                    placeholder="8h1jjdj3" />
                            </div>
                        </div>

                        <div class="flex items-center justify-center">
                            <button type="submit"
                                class="inline-flex justify-center rounded-lg bg-brand-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-slate-900">
                                Tekshirish
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </main>
</body>

</html>
