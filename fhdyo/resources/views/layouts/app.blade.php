<!DOCTYPE html>
<html lang="uz" class="h-full">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? trim($__env->yieldContent('title')) ?: 'FHDYO' }}</title>
    <script>
        (function () {
            const theme = localStorage.getItem('theme')

            if (theme === 'dark') {
                document.documentElement.classList.add('dark')
            } else if (theme === 'light') {
                document.documentElement.classList.remove('dark')
            }
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="h-full bg-gradient-to-br from-slate-50 via-white to-indigo-50 text-slate-900 antialiased dark:from-slate-950 dark:via-slate-950 dark:to-indigo-950 dark:text-slate-100">
    @php
        $current = trim($__env->yieldContent('nav')) ?: ($nav ?? '');
        $navItems = [
            [
                'key' => 'home',
                'label' => 'Dashboard',
                'href' => route('home'),
                'icon' => 'home',
            ],
            [
                'key' => 'human',
                'label' => 'Humans',
                'href' => route('humans.index'),
                'icon' => 'users',
            ],
            [
                'key' => 'couple',
                'label' => 'Couples',
                'href' => route('couples.index'),
                'icon' => 'heart',
            ],
            [
                'key' => 'category',
                'label' => 'Categories',
                'href' => route('categories.index'),
                'icon' => 'folder',
            ],
            [
                'key' => 'graphic',
                'label' => 'Graphics',
                'href' => route('graphic'),
                'icon' => 'chart',
            ],
        ];
    @endphp

    <div class="min-h-full">
        <div
            class="pointer-events-none fixed inset-0 -z-10 bg-[radial-gradient(ellipse_at_top,rgba(99,102,241,0.22),transparent_55%),radial-gradient(ellipse_at_bottom,rgba(236,72,153,0.16),transparent_45%)] dark:bg-[radial-gradient(ellipse_at_top,rgba(99,102,241,0.18),transparent_55%),radial-gradient(ellipse_at_bottom,rgba(236,72,153,0.12),transparent_45%)]">
        </div>

        <header class="sticky top-0 z-40">
            <div
                class="border-b border-white/20 bg-white/55 backdrop-blur-xl shadow-sm dark:border-slate-800/60 dark:bg-slate-950/55">
                <div class="mx-auto max-w-7xl px-4 sm:px-6">
                    <div class="flex h-16 items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <button type="button" id="mobileDrawerButton"
                                class="inline-flex items-center justify-center rounded-xl p-2 text-slate-700 transition hover:bg-slate-900/5 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 dark:text-slate-200 dark:hover:bg-white/5 lg:hidden"
                                aria-label="Open navigation">
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" />
                                </svg>
                            </button>

                            <a href="{{ route('home') }}" class="group inline-flex items-center gap-3">
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
                                    <div class="text-sm font-semibold tracking-tight text-slate-900 dark:text-white">
                                        FHDYO
                                    </div>
                                    <div class="text-xs text-slate-500 dark:text-slate-400">Admin panel</div>
                                </div>
                            </a>
                        </div>

                        <div class="flex items-center gap-2">
                            <button id="theme-toggle"
                                class="rounded-xl p-2 hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" viewBox="0 0 24 24"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M21 14.25A8.25 8.25 0 0 1 9.75 3a6.75 6.75 0 1 0 11.25 11.25Z"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" viewBox="0 0 24 24"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 18a6 6 0 1 0 0-12 6 6 0 0 0 0 12Z"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M12 2v2.5M12 19.5V22M4.22 4.22 6 6M18 18l1.78 1.78M2 12h2.5M19.5 12H22M4.22 19.78 6 18M18 6l1.78-1.78"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            </button>

                            <div class="hidden sm:block">
                                <x-badge variant="soft" color="indigo">
                                    {{ Auth::user()->name ?? 'User' }}
                                </x-badge>
                            </div>

                            <form action="{{ route('logout') }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to logout?');" class="hidden sm:block">
                                @csrf
                                <x-button variant="ghost" color="danger" type="submit">
                                    <span class="hidden md:inline">Logout</span>
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M12 9l3 3-3 3M15 12H3" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </x-button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex gap-6 lg:gap-8">
                <aside class="hidden lg:block w-64 shrink-0">
                    <div
                        class="sticky top-20 rounded-2xl border border-white/30 bg-white/45 p-3 shadow-xl shadow-black/5 backdrop-blur-xl dark:border-slate-800/60 dark:bg-slate-950/40 w-full">
                        <nav class="space-y-1">
                            @foreach ($navItems as $item)
                                <a href="{{ $item['href'] }}"
                                    @class([
                                        'group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition duration-200 ease-in-out',
                                        'bg-gradient-to-r from-indigo-500/15 to-fuchsia-500/10 text-indigo-900 dark:text-white' => $current === $item['key'],
                                        'text-slate-700 hover:bg-slate-900/5 dark:text-slate-200 dark:hover:bg-white/5' => $current !== $item['key'],
                                    ])>
                                    <span
                                        @class([
                                            'grid h-10 w-10 place-items-center rounded-2xl border shadow-sm transition',
                                            'border-indigo-500/20 bg-white/60 text-indigo-700 shadow-indigo-500/10 dark:border-indigo-400/20 dark:bg-slate-900/40 dark:text-indigo-200' => $current === $item['key'],
                                            'border-white/40 bg-white/40 text-slate-700 shadow-black/5 dark:border-slate-800/50 dark:bg-slate-900/30 dark:text-slate-200' => $current !== $item['key'],
                                        ])>
                                        @switch($item['icon'])
                                            @case('home')
                                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M2.25 12 11.204 3.045a1.5 1.5 0 0 1 2.121 0L22.25 12"
                                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M4.5 10.5V20.25A1.5 1.5 0 0 0 6 21.75h4.5V16.5A1.5 1.5 0 0 1 12 15h0a1.5 1.5 0 0 1 1.5 1.5v5.25H18a1.5 1.5 0 0 0 1.5-1.5V10.5"
                                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            @break

                                            @case('users')
                                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M15 19.128c.851.196 1.67.476 2.448.835A8.967 8.967 0 0 0 21 12.75C21 7.78 16.97 3.75 12 3.75S3 7.78 3 12.75c0 3.146 1.618 5.914 4.065 7.5.777-.36 1.596-.64 2.448-.835"
                                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M12 12.75a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M7.5 20.25a4.5 4.5 0 0 1 9 0"
                                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            @break

                                            @case('heart')
                                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M21 8.25c0-2.485-2.099-4.5-4.687-4.5-1.844 0-3.438 1.023-4.313 2.52-.875-1.497-2.469-2.52-4.313-2.52C5.1 3.75 3 5.765 3 8.25c0 7.5 9 12 9 12s9-4.5 9-12Z"
                                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            @break

                                            @case('folder')
                                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M2.25 6.75A2.25 2.25 0 0 1 4.5 4.5h5.379c.597 0 1.17.237 1.591.659l1.871 1.871c.422.422.994.659 1.591.659H19.5a2.25 2.25 0 0 1 2.25 2.25v8.25A2.25 2.25 0 0 1 19.5 20.25h-15A2.25 2.25 0 0 1 2.25 18V6.75Z"
                                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            @break

                                            @case('chart')
                                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M3 3v18h18" stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" />
                                                    <path d="M7 14v4M12 10v8M17 6v12" stroke="currentColor"
                                                        stroke-width="1.5" stroke-linecap="round" />
                                                </svg>
                                            @break
                                        @endswitch
                                    </span>
                                    <div class="flex-1">
                                        <div>{{ $item['label'] }}</div>
                                        <div class="text-xs font-medium text-slate-500 dark:text-slate-400">
                                            {{ $item['key'] === 'graphic' ? 'Insights & trends' : 'Manage ' . strtolower($item['label']) }}
                                        </div>
                                    </div>
                                </a>
                            @endforeach

                            @if (Auth::user()->role === 'super_admin')
                                <a href="{{ route('users.index') }}"
                                    @class([
                                        'group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition duration-200 ease-in-out',
                                        'bg-gradient-to-r from-indigo-500/15 to-fuchsia-500/10 text-indigo-900 dark:text-white' => $current === 'admin',
                                        'text-slate-700 hover:bg-slate-900/5 dark:text-slate-200 dark:hover:bg-white/5' => $current !== 'admin',
                                    ])>
                                    <span
                                        @class([
                                            'grid h-10 w-10 place-items-center rounded-2xl border shadow-sm transition',
                                            'border-indigo-500/20 bg-white/60 text-indigo-700 shadow-indigo-500/10 dark:border-indigo-400/20 dark:bg-slate-900/40 dark:text-indigo-200' => $current === 'admin',
                                            'border-white/40 bg-white/40 text-slate-700 shadow-black/5 dark:border-slate-800/50 dark:bg-slate-900/30 dark:text-slate-200' => $current !== 'admin',
                                        ])>
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 3 4.5 6.75V12c0 6.075 3.6 9.75 7.5 9.75s7.5-3.675 7.5-9.75V6.75L12 3Z"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M12 11.25v4.5" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" />
                                            <path d="M9.75 9.75h4.5" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" />
                                        </svg>
                                    </span>
                                    <div class="flex-1">
                                        <div>Admins</div>
                                        <div class="text-xs font-medium text-slate-500 dark:text-slate-400">User access</div>
                                    </div>
                                </a>
                            @endif
                        </nav>
                    </div>
                </aside>

                <main class="flex-1 min-w-0 pb-24 lg:pb-10">
                    <div class="space-y-6 w-full">
                        @if (isset($slot))
                            {{ $slot }}
                        @else
                            @yield('content')
                        @endif
                    </div>
                </main>
            </div>
        </div>

        <nav
            class="fixed inset-x-0 bottom-0 z-40 border-t border-white/20 bg-white/60 backdrop-blur-xl shadow-[0_-10px_30px_-20px_rgba(0,0,0,0.4)] dark:border-slate-800/60 dark:bg-slate-950/60 lg:hidden">
            <div class="mx-auto max-w-7xl px-4 sm:px-6">
                <div class="grid grid-cols-5 gap-2 py-2">
                    @foreach ($navItems as $item)
                        <a href="{{ $item['href'] }}"
                            @class([
                                'flex flex-col items-center justify-center gap-1 rounded-2xl px-2 py-2 text-xs font-semibold transition',
                                'bg-indigo-500/10 text-indigo-700 dark:text-indigo-200' => $current === $item['key'],
                                'text-slate-600 hover:bg-slate-900/5 dark:text-slate-300 dark:hover:bg-white/5' => $current !== $item['key'],
                            ])>
                            <span class="grid h-9 w-9 place-items-center rounded-2xl bg-white/40 dark:bg-slate-900/40">
                                @switch($item['icon'])
                                    @case('home')
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.25 12 11.204 3.045a1.5 1.5 0 0 1 2.121 0L22.25 12"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M4.5 10.5V20.25A1.5 1.5 0 0 0 6 21.75h4.5V16.5A1.5 1.5 0 0 1 12 15h0a1.5 1.5 0 0 1 1.5 1.5v5.25H18a1.5 1.5 0 0 0 1.5-1.5V10.5"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    @break
                                    @case('users')
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15 19.128c.851.196 1.67.476 2.448.835A8.967 8.967 0 0 0 21 12.75C21 7.78 16.97 3.75 12 3.75S3 7.78 3 12.75c0 3.146 1.618 5.914 4.065 7.5.777-.36 1.596-.64 2.448-.835"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M12 12.75a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    @break
                                    @case('heart')
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21 8.25c0-2.485-2.099-4.5-4.687-4.5-1.844 0-3.438 1.023-4.313 2.52-.875-1.497-2.469-2.52-4.313-2.52C5.1 3.75 3 5.765 3 8.25c0 7.5 9 12 9 12s9-4.5 9-12Z"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    @break
                                    @case('folder')
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.25 6.75A2.25 2.25 0 0 1 4.5 4.5h5.379c.597 0 1.17.237 1.591.659l1.871 1.871c.422.422.994.659 1.591.659H19.5a2.25 2.25 0 0 1 2.25 2.25v8.25A2.25 2.25 0 0 1 19.5 20.25h-15A2.25 2.25 0 0 1 2.25 18V6.75Z"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    @break
                                    @case('chart')
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3 3v18h18" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" />
                                            <path d="M7 14v4M12 10v8M17 6v12" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" />
                                        </svg>
                                    @break
                                @endswitch
                            </span>
                            <span class="truncate">{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </nav>

        <div id="mobileDrawer"
            class="fixed inset-0 z-50 hidden lg:hidden"
            aria-hidden="true">
            <div class="absolute inset-0 bg-slate-950/40 backdrop-blur-sm" data-close></div>
            <div
                class="absolute left-0 top-0 h-full w-[19rem] max-w-[85vw] border-r border-white/20 bg-white/70 p-4 shadow-2xl backdrop-blur-xl dark:border-slate-800/60 dark:bg-slate-950/70">
                <div class="flex items-center justify-between">
                    <div class="text-sm font-semibold text-slate-900 dark:text-white">Navigation</div>
                    <button type="button" data-close
                        class="rounded-xl p-2 text-slate-700 transition hover:bg-slate-900/5 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 dark:text-slate-200 dark:hover:bg-white/5"
                        aria-label="Close navigation">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 6l12 12M18 6 6 18" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" />
                        </svg>
                    </button>
                </div>

                <div class="mt-4 space-y-2">
                    @foreach ($navItems as $item)
                        <a href="{{ $item['href'] }}"
                            @class([
                                'flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition',
                                'bg-indigo-500/10 text-indigo-700 dark:text-indigo-200' => $current === $item['key'],
                                'text-slate-700 hover:bg-slate-900/5 dark:text-slate-200 dark:hover:bg-white/5' => $current !== $item['key'],
                            ])>
                            <span class="grid h-10 w-10 place-items-center rounded-2xl bg-white/40 dark:bg-slate-900/40">
                                @switch($item['icon'])
                                    @case('home')
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.25 12 11.204 3.045a1.5 1.5 0 0 1 2.121 0L22.25 12"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M4.5 10.5V20.25A1.5 1.5 0 0 0 6 21.75h4.5V16.5A1.5 1.5 0 0 1 12 15h0a1.5 1.5 0 0 1 1.5 1.5v5.25H18a1.5 1.5 0 0 0 1.5-1.5V10.5"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    @break
                                    @case('users')
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15 19.128c.851.196 1.67.476 2.448.835A8.967 8.967 0 0 0 21 12.75C21 7.78 16.97 3.75 12 3.75S3 7.78 3 12.75c0 3.146 1.618 5.914 4.065 7.5.777-.36 1.596-.64 2.448-.835"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M12 12.75a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    @break
                                    @case('heart')
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21 8.25c0-2.485-2.099-4.5-4.687-4.5-1.844 0-3.438 1.023-4.313 2.52-.875-1.497-2.469-2.52-4.313-2.52C5.1 3.75 3 5.765 3 8.25c0 7.5 9 12 9 12s9-4.5 9-12Z"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    @break
                                    @case('folder')
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.25 6.75A2.25 2.25 0 0 1 4.5 4.5h5.379c.597 0 1.17.237 1.591.659l1.871 1.871c.422.422.994.659 1.591.659H19.5a2.25 2.25 0 0 1 2.25 2.25v8.25A2.25 2.25 0 0 1 19.5 20.25h-15A2.25 2.25 0 0 1 2.25 18V6.75Z"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    @break
                                    @case('chart')
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3 3v18h18" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" />
                                            <path d="M7 14v4M12 10v8M17 6v12" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" />
                                        </svg>
                                    @break
                                @endswitch
                            </span>
                            <span class="truncate">{{ $item['label'] }}</span>
                        </a>
                    @endforeach

                    @if (Auth::user()->role === 'super_admin')
                        <a href="{{ route('users.index') }}"
                            @class([
                                'flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition',
                                'bg-indigo-500/10 text-indigo-700 dark:text-indigo-200' => $current === 'admin',
                                'text-slate-700 hover:bg-slate-900/5 dark:text-slate-200 dark:hover:bg-white/5' => $current !== 'admin',
                            ])>
                            <span class="grid h-10 w-10 place-items-center rounded-2xl bg-white/40 dark:bg-slate-900/40">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 3 4.5 6.75V12c0 6.075 3.6 9.75 7.5 9.75s7.5-3.675 7.5-9.75V6.75L12 3Z"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            <span class="truncate">Admins</span>
                        </a>
                    @endif

                    <form action="{{ route('logout') }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to logout?');" class="pt-2">
                        @csrf
                        <x-button variant="soft" color="danger" type="submit" class="w-full justify-center">
                            Logout
                        </x-button>
                    </form>
                </div>
            </div>
        </div>

        <x-toast />
    </div>

    <script>
        (function() {
            const drawer = document.getElementById('mobileDrawer');
            const openBtn = document.getElementById('mobileDrawerButton');

            function openDrawer() {
                if (!drawer) return;
                drawer.classList.remove('hidden');
                drawer.setAttribute('aria-hidden', 'false');
            }

            function closeDrawer() {
                if (!drawer) return;
                drawer.classList.add('hidden');
                drawer.setAttribute('aria-hidden', 'true');
            }

            if (openBtn) openBtn.addEventListener('click', openDrawer);
            if (drawer) {
                drawer.addEventListener('click', (e) => {
                    const t = e.target;
                    if (t && t.hasAttribute && t.hasAttribute('data-close')) closeDrawer();
                    if (t && t.dataset && t.dataset.close !== undefined) closeDrawer();
                });
                drawer.querySelectorAll('[data-close]').forEach((el) => el.addEventListener('click', closeDrawer));
            }

            window.toast = function(message, options) {
                const opts = options || {};
                const type = opts.type || 'info';
                const title = opts.title || null;

                const container = document.getElementById('toast-container');
                if (!container) return;

                const el = document.createElement('div');
                el.className = 'pointer-events-auto w-full max-w-sm overflow-hidden rounded-2xl border border-white/20 bg-white/70 shadow-xl shadow-black/10 backdrop-blur-xl transition dark:border-slate-800/60 dark:bg-slate-950/70';

                const colors = {
                    info: 'text-indigo-700 dark:text-indigo-200',
                    success: 'text-emerald-700 dark:text-emerald-200',
                    warning: 'text-amber-700 dark:text-amber-200',
                    danger: 'text-rose-700 dark:text-rose-200',
                };

                const icon = {
                    info: '<path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25h1.5v4.5h-1.5v-4.5Zm0-3h1.5v1.5h-1.5V8.25Z" />',
                    success: '<path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 4.5 4.5 10.5-10.5" />',
                    warning: '<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3h.008v.008H12v-.008Z" />',
                    danger: '<path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />',
                };

                el.innerHTML = `
                    <div class="flex gap-3 p-4">
                        <div class="mt-0.5 grid h-10 w-10 place-items-center rounded-2xl bg-slate-900/5 dark:bg-white/5 ${colors[type] || colors.info}">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                ${icon[type] || icon.info}
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            ${title ? `<div class="text-sm font-semibold text-slate-900 dark:text-white">${title}</div>` : ''}
                            <div class="text-sm text-slate-700 dark:text-slate-300">${message}</div>
                        </div>
                        <button type="button" class="-m-1 rounded-xl p-1 text-slate-500 hover:bg-slate-900/5 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-white/5 dark:hover:text-white" aria-label="Dismiss">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 18 18 6M6 6l12 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </button>
                    </div>
                `;

                const closeBtn = el.querySelector('button');
                const remove = () => {
                    el.style.opacity = '0';
                    el.style.transform = 'translateY(-6px)';
                    setTimeout(() => el.remove(), 200);
                };

                el.style.opacity = '0';
                el.style.transform = 'translateY(-6px)';
                container.appendChild(el);
                requestAnimationFrame(() => {
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                });

                if (closeBtn) closeBtn.addEventListener('click', remove);
                setTimeout(remove, opts.duration || 3500);
            };
        })();
    </script>

   <script>
        document.addEventListener('DOMContentLoaded', function () {

            const btn = document.getElementById('theme-toggle')
            const darkIcon = document.getElementById('theme-toggle-dark-icon')
            const lightIcon = document.getElementById('theme-toggle-light-icon')

            if (!btn) return

            function updateIcons() {
                if (document.documentElement.classList.contains('dark')) {
                    lightIcon.classList.remove('hidden')
                    darkIcon.classList.add('hidden')
                } else {
                    darkIcon.classList.remove('hidden')
                    lightIcon.classList.add('hidden')
                }
            }

            // INIT
            updateIcons()

            btn.addEventListener('click', function () {
                const isDark = document.documentElement.classList.contains('dark')

                if (isDark) {
                    document.documentElement.classList.remove('dark')
                    localStorage.setItem('theme', 'light')
                } else {
                    document.documentElement.classList.add('dark')
                    localStorage.setItem('theme', 'dark')
                }

                updateIcons()
            })
        })
    </script>
</body>

</html>
