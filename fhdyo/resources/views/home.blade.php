@extends('layouts.app')

@section('title', 'FHDYO')
@section('nav', 'home')

@section('content')
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-white">Dashboard</h1>
            <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Quick access and province overview.</p>
        </div>

        <div class="flex items-center gap-2">
            @if (Auth::user()->role == 'super_admin')
                <x-button variant="soft" color="indigo" :href="route('users.index')">
                    Admins
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 3 4.5 6.75V12c0 6.075 3.6 9.75 7.5 9.75s7.5-3.675 7.5-9.75V6.75L12 3Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </x-button>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6">
        @php
            $actions = [
                ['label' => 'Home', 'href' => route('home'), 'icon' => 'home'],
                ['label' => 'Humans', 'href' => route('humans.index'), 'icon' => 'users'],
                ['label' => 'Couples', 'href' => route('couples.index'), 'icon' => 'heart'],
                ['label' => 'Categories', 'href' => route('categories.index'), 'icon' => 'folder'],
                ['label' => 'Graphics', 'href' => route('graphic'), 'icon' => 'chart'],
            ];
        @endphp

        @foreach ($actions as $a)
            <a href="{{ $a['href'] }}"
                class="group rounded-2xl border border-white/30 bg-white/45 p-4 shadow-xl shadow-black/5 backdrop-blur-xl transition hover:bg-white/60 dark:border-slate-800/60 dark:bg-slate-950/40 dark:hover:bg-slate-950/55">
                <div class="flex items-center gap-3">
                    <span
                        class="grid h-11 w-11 place-items-center rounded-2xl bg-slate-900/5 text-slate-700 transition group-hover:bg-indigo-500/10 group-hover:text-indigo-700 dark:bg-white/5 dark:text-slate-200 dark:group-hover:text-indigo-200">
                        @switch($a['icon'])
                            @case('home')
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.25 12 11.204 3.045a1.5 1.5 0 0 1 2.121 0L22.25 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M4.5 10.5V20.25A1.5 1.5 0 0 0 6 21.75h4.5V16.5A1.5 1.5 0 0 1 12 15h0a1.5 1.5 0 0 1 1.5 1.5v5.25H18a1.5 1.5 0 0 0 1.5-1.5V10.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            @break
                            @case('users')
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15 19.128c.851.196 1.67.476 2.448.835A8.967 8.967 0 0 0 21 12.75C21 7.78 16.97 3.75 12 3.75S3 7.78 3 12.75c0 3.146 1.618 5.914 4.065 7.5.777-.36 1.596-.64 2.448-.835" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M12 12.75a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            @break
                            @case('heart')
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21 8.25c0-2.485-2.099-4.5-4.687-4.5-1.844 0-3.438 1.023-4.313 2.52-.875-1.497-2.469-2.52-4.313-2.52C5.1 3.75 3 5.765 3 8.25c0 7.5 9 12 9 12s9-4.5 9-12Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            @break
                            @case('folder')
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.25 6.75A2.25 2.25 0 0 1 4.5 4.5h5.379c.597 0 1.17.237 1.591.659l1.871 1.871c.422.422.994.659 1.591.659H19.5a2.25 2.25 0 0 1 2.25 2.25v8.25A2.25 2.25 0 0 1 19.5 20.25h-15A2.25 2.25 0 0 1 2.25 18V6.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            @break
                            @case('chart')
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 3v18h18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    <path d="M7 14v4M12 10v8M17 6v12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            @break
                        @endswitch
                    </span>
                    <div class="min-w-0">
                        <div class="text-sm font-semibold text-slate-900 dark:text-white">{{ $a['label'] }}</div>
                        <div class="mt-0.5 text-xs text-slate-600 dark:text-slate-300">Open</div>
                    </div>
                </div>
            </a>
        @endforeach

        <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Are you sure you want to logout?');"
            class="col-span-2 sm:col-span-1">
            @csrf
            <button type="submit"
                class="w-full rounded-2xl border border-white/30 bg-white/45 p-4 text-left shadow-xl shadow-black/5 backdrop-blur-xl transition hover:bg-white/60 dark:border-slate-800/60 dark:bg-slate-950/40 dark:hover:bg-slate-950/55">
                <div class="flex items-center gap-3">
                    <span
                        class="grid h-11 w-11 place-items-center rounded-2xl bg-rose-500/10 text-rose-700 dark:text-rose-200">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 9l3 3-3 3M15 12H3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    <div class="min-w-0">
                        <div class="text-sm font-semibold text-slate-900 dark:text-white">Logout</div>
                        <div class="mt-0.5 text-xs text-slate-600 dark:text-slate-300">End session</div>
                    </div>
                </div>
            </button>
        </form>
    </div>

    <x-card class="p-6 sm:p-8">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h2 class="text-lg font-semibold tracking-tight text-slate-900 dark:text-white">Province Graphic</h2>
                <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Viloyatlar bo‘yicha nikoh holati.</p>
            </div>
            <div class="flex items-center gap-2">
                <x-badge variant="soft" color="rose">Married</x-badge>
                <x-badge variant="soft" color="indigo">Divorced</x-badge>
            </div>
        </div>

        <div class="mt-6 overflow-hidden rounded-2xl border border-white/20 bg-white/20 p-4 shadow-sm shadow-black/5 dark:border-slate-800/60 dark:bg-slate-950/10">
            <canvas id="provinceChart" class="w-full"></canvas>
        </div>
    </x-card>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('provinceChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($provinces),
                datasets: [{
                        label: 'Married',
                        data: @json($marriedCounts->values()),
                        borderColor: '#ec4899',
                        backgroundColor: 'transparent',
                        tension: 0.4,
                        pointBackgroundColor: '#ec4899',
                        pointRadius: 5
                    },
                    {
                        label: 'Divorced',
                        data: @json($divorcedCounts->values()),
                        borderColor: '#1e3a8a',
                        backgroundColor: 'transparent',
                        tension: 0.4,
                        pointBackgroundColor: '#1e3a8a',
                        pointRadius: 5
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: '#374151'
                        }
                    },
                    title: {
                        display: true,
                        text: 'Viloyatlar bo‘yicha nikoh holati',
                        color: '#111827',
                        font: {
                            size: 18
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#4b5563'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#4b5563'
                        }
                    }
                }
            }
        });
    </script>
@endsection
