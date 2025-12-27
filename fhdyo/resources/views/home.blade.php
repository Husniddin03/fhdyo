<x-app title="home">
    <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
    <div class="mt-4 p-6 bg-white rounded-lg shadow-md flex justify-center space-x-4 contents-center">
                    <a href="{{ route('home') }}">
                        <button
                            class="w-full p-3 flex cursor-pointer justify-center rounded-lg text-gray-500 hover:bg-gray-50">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </button>
                    </a>

                    <a href="{{ route('humans.index') }}">
                        <button
                            class="w-full p-3 flex cursor-pointer justify-center rounded-lg text-gray-500 hover:bg-gray-50">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </button>
                    </a>

                    <a href="{{ route('couples.index') }}">
                        <button
                            class="w-full p-3 flex cursor-pointer justify-center rounded-lg text-gray-500 hover:bg-gray-50">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1zM15 14a4 4 0 100-8 4 4 0 000 8zm6 6a6 6 0 00-12 0v1h12v-1z" />
                            </svg>
                        </button>
                    </a>

                    <a href="{{ route('categories.index') }}">
                        <button
                            class="w-full p-3 flex cursor-pointer justify-center rounded-lg text-gray-500 hover:bg-gray-50">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                            </svg>
                        </button>
                    </a>

                    <a href="{{route('graphic')}}">
                        <button
                            class="w-full p-3 flex cursor-pointer justify-center rounded-lg text-gray-500 hover:bg-gray-50">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </button>
                    </a>

                    {{-- admins --}}

                    @if (Auth::user()->role == 'super_admin')
                        <a href="{{ route('users.index') }}">
                            <button
                                class="w-full p-3 flex cursor-pointer justify-center rounded-lg text-gray-500 hover:bg-gray-50">
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </button>
                        </a>
                    @endif

                    {{-- logout --}}
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to logout?');">
                        @csrf
                        <button type="submit"
                            class="w-full p-3 flex cursor-pointer justify-center rounded-lg text-red-500 hover:bg-gray-50">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
    </div>

    <div class="flex justify-between mt-5">
        <h1 class="text-2xl font-semibold text-gray-900">Province Graphic</h1>
    </div>
    <div class="mt-4 p-6 bg-white rounded-lg shadow-md">
        <canvas id="provinceChart" class="w-full"></canvas>
    </div>

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
                        borderColor: '#ec4899', // pink-500
                        backgroundColor: 'transparent',
                        tension: 0.4,
                        pointBackgroundColor: '#ec4899',
                        pointRadius: 5
                    },
                    {
                        label: 'Divorced',
                        data: @json($divorcedCounts->values()),
                        borderColor: '#1e3a8a', // blue-900
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
                            color: '#374151' // gray-700
                        }
                    },
                    title: {
                        display: true,
                        text: 'Viloyatlar bo‘yicha nikoh holati',
                        color: '#111827', // gray-900
                        font: {
                            size: 18
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#4b5563' // gray-600
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

</x-app>
