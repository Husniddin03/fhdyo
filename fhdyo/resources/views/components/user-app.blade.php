<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? 'FHDYO' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        (function() {
            const storageKey = 'theme';
            const preferred = localStorage.getItem(storageKey);
            const systemDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
            const shouldDark = preferred ? preferred === 'dark' : systemDark;
            document.documentElement.classList.toggle('dark', shouldDark);
        })();
    </script>
</head>

<body
    class="h-full bg-gradient-to-br from-slate-50 via-white to-indigo-50 text-slate-900 antialiased dark:from-slate-950 dark:via-slate-950 dark:to-indigo-950 dark:text-slate-100">
    <div
        class="pointer-events-none fixed inset-0 -z-10 bg-[radial-gradient(ellipse_at_top,rgba(99,102,241,0.22),transparent_55%),radial-gradient(ellipse_at_bottom,rgba(236,72,153,0.16),transparent_45%)] dark:bg-[radial-gradient(ellipse_at_top,rgba(99,102,241,0.18),transparent_55%),radial-gradient(ellipse_at_bottom,rgba(236,72,153,0.12),transparent_45%)]">
    </div>

    <header class="absolute left-0 right-0 top-0 z-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="flex h-16 items-center justify-between">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                    <span
                        class="grid h-10 w-10 place-items-center rounded-2xl bg-gradient-to-br from-indigo-500 to-fuchsia-500 shadow-lg shadow-indigo-500/25">
                        <svg class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.5 3.75h3A2.25 2.25 0 0 1 15.75 6v12A2.25 2.25 0 0 1 13.5 20.25h-3A2.25 2.25 0 0 1 8.25 18V6A2.25 2.25 0 0 1 10.5 3.75Z"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" class="text-white" />
                            <path d="M12 7.5v9" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" class="text-white" />
                        </svg>
                    </span>
                    <div class="leading-tight">
                        <div class="text-sm font-semibold tracking-tight text-slate-900 dark:text-white">FHDYO</div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">Quiz</div>
                    </div>
                </a>

                <button type="button" id="themeToggle"
                    class="inline-flex items-center gap-2 rounded-2xl border border-white/25 bg-white/40 px-3 py-2 text-sm font-semibold text-slate-800 shadow-sm shadow-black/5 transition hover:bg-white/60 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 dark:border-slate-800/60 dark:bg-slate-900/40 dark:text-slate-200 dark:hover:bg-slate-900/60"
                    aria-label="Toggle dark mode">
                    <span class="hidden sm:inline">Theme</span>
                    <span class="grid h-8 w-8 place-items-center rounded-xl bg-slate-900/5 dark:bg-white/5">
                        <svg id="themeIconSun" class="hidden h-5 w-5" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 18a6 6 0 1 0 0-12 6 6 0 0 0 0 12Z" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 2v2.5M12 19.5V22M4.22 4.22 6 6M18 18l1.78 1.78M2 12h2.5M19.5 12H22M4.22 19.78 6 18M18 6l1.78-1.78"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                        <svg id="themeIconMoon" class="hidden h-5 w-5" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 14.25A8.25 8.25 0 0 1 9.75 3a6.75 6.75 0 1 0 11.25 11.25Z"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
                </button>
            </div>
        </div>
    </header>

    <main class="min-h-full px-4 pt-24 sm:px-6">
        <div class="mx-auto max-w-7xl">
            <div class="min-h-[70vh] grid place-items-center">
                {{ $slot }}
            </div>
        </div>
    </main>

    <x-toast />

    <script>
        (function() {
            const storageKey = 'theme';
            const root = document.documentElement;
            const btn = document.getElementById('themeToggle');
            const sun = document.getElementById('themeIconSun');
            const moon = document.getElementById('themeIconMoon');

            function applyIcons() {
                const isDark = root.classList.contains('dark');
                if (sun) sun.classList.toggle('hidden', isDark);
                if (moon) moon.classList.toggle('hidden', !isDark);
            }

            function toggleTheme() {
                const isDark = root.classList.contains('dark');
                const next = !isDark;
                root.classList.toggle('dark', next);
                localStorage.setItem(storageKey, next ? 'dark' : 'light');
                applyIcons();
            }

            applyIcons();
            if (btn) btn.addEventListener('click', toggleTheme);
        })();
    </script>
</body>

</html>
