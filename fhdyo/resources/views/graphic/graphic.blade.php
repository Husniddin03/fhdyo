<x-app title="graphic">
    <div class="flex justify-between">
        <h1 class="text-2xl font-semibold text-gray-900">Graphic</h1>
    </div>
    <div class="mt-4 p-6 bg-white rounded-lg shadow-md">
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-700">Nikohlar ko'rinishi</h2>
            <div class="flex items-center mt-2">
                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                        clip-rule="evenodd" />
                </svg>
                <span class="ml-2 text-gray-600">{{ $percentageChange }}% ko'proq 2021 yilda</span>
            </div>
        </div>

        <div class="relative">
            <canvas id="salesChart" class="w-full" style="height: 400px;"></canvas>
        </div>

        <div class="flex items-center justify-center mt-4 space-x-6">
            <div class="flex items-center">
                <div class="w-4 h-4 bg-pink-500 rounded-full mr-2"></div>
                <span class="text-sm text-gray-600">Nikohlanganlar</span>
            </div>
            <div class="flex items-center">
                <div class="w-4 h-4 bg-purple-900 rounded-full mr-2"></div>
                <span class="text-sm text-gray-600">Ajrashganlar</span>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');

        const labels = @json($labels);
        const marriedData = @json($marriedData);
        const divorcedData = @json($divorcedData);

        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Nikohlanganlar',
                        data: marriedData,
                        borderColor: 'rgb(236, 72, 153)',
                        backgroundColor: 'rgba(236, 72, 153, 0.1)',
                        tension: 0.4,
                        fill: true,
                        borderWidth: 3,
                        pointRadius: 0,
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: 'rgb(236, 72, 153)',
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 2
                    },
                    {
                        label: 'Ajrashganlar',
                        data: divorcedData,
                        borderColor: 'rgb(88, 28, 135)',
                        backgroundColor: 'rgba(88, 28, 135, 0.1)',
                        tension: 0.4,
                        fill: true,
                        borderWidth: 3,
                        pointRadius: 0,
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: 'rgb(88, 28, 135)',
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 2
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        titleFont: {
                            size: 14
                        },
                        bodyFont: {
                            size: 13
                        },
                        cornerRadius: 8
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            },
                            color: '#9CA3AF'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            },
                            color: '#9CA3AF',
                            padding: 10
                        }
                    }
                }
            }
        });
    </script>
</x-app>
