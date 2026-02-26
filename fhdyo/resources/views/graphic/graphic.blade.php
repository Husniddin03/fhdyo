@extends('layouts.app')

@section('title', 'graphic')
@section('nav', 'graphic')

@section('content')
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-white">Graphics</h1>
            <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Nikoh va ajrashish statistikasi (oylik).</p>
        </div>

        <div class="w-full sm:w-auto">
            <label for="provinceSelect" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Province</label>
            <select id="provinceSelect"
                class="w-full sm:w-72 rounded-2xl border border-white/30 bg-white/60 px-4 py-3 text-sm text-slate-900 shadow-sm shadow-black/5 outline-none transition focus:bg-white/80 focus:ring-2 focus:ring-indigo-500/20 dark:border-slate-800/60 dark:bg-slate-950/40 dark:text-white dark:focus:bg-slate-950/60">
                <option value="toshkentsh">Toshkent sh</option>
                <option value="toshkent">Toshkent</option>
                <option value="samarqand">Samarqand</option>
                <option value="buxoro">Buxoro</option>
                <option value="fargona">Farg'ona</option>
                <option value="andijon">Andijon</option>
                <option value="sirdaryo">Sirdaryo</option>
                <option value="jizzax">Jizzax</option>
                <option value="qashqadaryo">Qashqadaryo</option>
                <option value="surxandaryo">Surxandaryo</option>
                <option value="navoiy">Navoiy</option>
                <option value="xorazm">Xorazm</option>
                <option value="qoraqalpogistonr">Qoraqalpog'stoon R</option>
            </select>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
        <x-card class="p-6">
            <div class="text-sm font-semibold text-slate-600 dark:text-slate-300">Jami Nikohlar</div>
            <div class="mt-2 text-3xl font-semibold tracking-tight text-indigo-700 dark:text-indigo-200" id="totalMarried">0</div>
            <div class="mt-2 text-sm text-slate-500 dark:text-slate-400" id="provinceInfo1">Toshkent viloyati</div>
        </x-card>

        <x-card class="p-6">
            <div class="text-sm font-semibold text-slate-600 dark:text-slate-300">Jami Ajrashishlar</div>
            <div class="mt-2 text-3xl font-semibold tracking-tight text-slate-900 dark:text-white" id="totalDivorced">0</div>
            <div class="mt-2 text-sm text-slate-500 dark:text-slate-400" id="provinceInfo2">Toshkent viloyati</div>
        </x-card>

        <x-card class="p-6">
            <div class="text-sm font-semibold text-slate-600 dark:text-slate-300">Farq</div>
            <div class="mt-2 text-3xl font-semibold tracking-tight text-emerald-700 dark:text-emerald-200" id="percentageDiff">0%</div>
            <div class="mt-2 text-sm text-slate-500 dark:text-slate-400">Nikohlar ajrashishlardan ko'p</div>
        </x-card>
    </div>

    <x-card class="p-6 sm:p-8">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h2 class="text-lg font-semibold tracking-tight text-slate-900 dark:text-white">Oylik Statistika</h2>
                <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Nikoh va ajrashishlar soni oylar bo'yicha — <span class="font-semibold" id="chartProvince">Toshkent</span></p>
            </div>
            <div class="flex items-center gap-3">
                <x-badge variant="soft" color="indigo">
                    <span class="inline-block h-2 w-2 rounded-full bg-indigo-600"></span>
                    Nikohlar
                </x-badge>
                <x-badge variant="soft" color="slate">
                    <span class="inline-block h-2 w-2 rounded-full bg-slate-700 dark:bg-slate-300"></span>
                    Ajrashishlar
                </x-badge>
            </div>
        </div>

        <div class="mt-6">
            <div class="w-full overflow-hidden rounded-2xl border border-white/20 bg-white/20 p-4 shadow-sm shadow-black/5 dark:border-slate-800/60 dark:bg-slate-950/10">
                <canvas id="lineChart" class="w-full"></canvas>
            </div>
        </div>
    </x-card>

    <x-card class="p-0 overflow-hidden">
        <div class="border-b border-white/20 px-6 py-4 dark:border-slate-800/60">
            <h2 class="text-sm font-semibold text-slate-900 dark:text-white">Batafsil Ma'lumotlar</h2>
            <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Oyma-oy ko'rsatkichlar.</p>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-left">
                <thead class="bg-white/40 dark:bg-slate-950/30">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-300">Oy</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-300">Nikohlar</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-300">Ajrashishlar</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-300">Farq</th>
                    </tr>
                </thead>
                <tbody id="dataTable" class="divide-y divide-white/20 bg-white/20 dark:divide-slate-800/60 dark:bg-slate-950/10">
                </tbody>
            </table>
        </div>
    </x-card>

    <script>
        // Data for different provinces
        const provinceData = @json($provinceData);

        const provinceNames = {
            toshkentsh: 'Toshkent sh',
            toshkent: 'Toshkent',
            samarqand: 'Samarqand',
            buxoro: 'Buxoro',
            fargona: "Farg'ona",
            andijon: 'Andijon',
            sirdaryo: 'Sirdaryo',
            jizzax: 'Jizzax',
            qashqadaryo: 'Qashqadaryo',
            surxondaryo: 'Surxondaryo',
            navoiy: 'Navoiy',
            xorazm: 'Xorazm',
            qoraqalpogistonr: "Qoraqalpog'iston R",
        };

        let currentProvince = 'toshkent';
        let chart = null;

        // Initialize chart
        function initChart() {
            const canvas = document.getElementById('lineChart');
            const ctx = canvas.getContext('2d');

            canvas.width = canvas.offsetWidth;
            canvas.height = 400;

            updateChart();
        }

        // Update chart with current province data
        function updateChart() {
            const canvas = document.getElementById('lineChart');
            const ctx = canvas.getContext('2d');
            const data = provinceData[currentProvince];

            // Clear canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Chart dimensions
            const padding = 60;
            const chartWidth = canvas.width - padding * 2;
            const chartHeight = canvas.height - padding * 2;

            // Find max value for scaling
            const maxValue = Math.max(
                ...data.map(d => Math.max(d.married, d.divorced))
            );
            const scale = chartHeight / (maxValue * 1.1);

            // Draw grid lines
            ctx.strokeStyle = '#e5e7eb';
            ctx.lineWidth = 1;
            for (let i = 0; i <= 5; i++) {
                const y = padding + (chartHeight / 5) * i;
                ctx.beginPath();
                ctx.moveTo(padding, y);
                ctx.lineTo(canvas.width - padding, y);
                ctx.stroke();

                // Y-axis labels
                ctx.fillStyle = '#6b7280';
                ctx.font = '12px Arial';
                ctx.textAlign = 'right';
                const value = Math.round(maxValue * (1 - i / 5));
                ctx.fillText(value.toString(), padding - 10, y + 4);
            }

            // Draw X-axis labels
            const stepX = chartWidth / (data.length - 1);
            data.forEach((item, index) => {
                const x = padding + stepX * index;
                ctx.fillStyle = '#6b7280';
                ctx.font = '12px Arial';
                ctx.textAlign = 'center';
                ctx.fillText(item.month, x, canvas.height - padding + 20);
            });

            // Draw married line
            ctx.strokeStyle = '#8b5cf6';
            ctx.lineWidth = 3;
            ctx.beginPath();
            data.forEach((item, index) => {
                const x = padding + stepX * index;
                const y = canvas.height - padding - item.married * scale;
                if (index === 0) {
                    ctx.moveTo(x, y);
                } else {
                    ctx.lineTo(x, y);
                }
            });
            ctx.stroke();

            // Draw married points
            ctx.fillStyle = '#8b5cf6';
            data.forEach((item, index) => {
                const x = padding + stepX * index;
                const y = canvas.height - padding - item.married * scale;
                ctx.beginPath();
                ctx.arc(x, y, 4, 0, Math.PI * 2);
                ctx.fill();
            });

            // Draw divorced line
            ctx.strokeStyle = '#3b4252';
            ctx.lineWidth = 3;
            ctx.beginPath();
            data.forEach((item, index) => {
                const x = padding + stepX * index;
                const y = canvas.height - padding - item.divorced * scale;
                if (index === 0) {
                    ctx.moveTo(x, y);
                } else {
                    ctx.lineTo(x, y);
                }
            });
            ctx.stroke();

            // Draw divorced points
            ctx.fillStyle = '#3b4252';
            data.forEach((item, index) => {
                const x = padding + stepX * index;
                const y = canvas.height - padding - item.divorced * scale;
                ctx.beginPath();
                ctx.arc(x, y, 4, 0, Math.PI * 2);
                ctx.fill();
            });

            // Update statistics
            updateStatistics();
            updateTable();
        }

        // Update statistics cards
        function updateStatistics() {
            const data = provinceData[currentProvince];
            const totalMarried = data.reduce((sum, item) => sum + item.married, 0);
            const totalDivorced = data.reduce((sum, item) => sum + item.divorced, 0);
            const percentage = ((totalMarried - totalDivorced) / totalDivorced * 100).toFixed(1);

            document.getElementById('totalMarried').textContent = totalMarried.toLocaleString();
            document.getElementById('totalDivorced').textContent = totalDivorced.toLocaleString();
            document.getElementById('percentageDiff').textContent = percentage + '%';

            const provinceName = provinceNames[currentProvince];
            document.getElementById('provinceInfo1').textContent = provinceName + ' viloyati';
            document.getElementById('provinceInfo2').textContent = provinceName + ' viloyati';
            document.getElementById('chartProvince').textContent = provinceName;
        }

        // Update data table
        function updateTable() {
            const data = provinceData[currentProvince];
            const tbody = document.getElementById('dataTable');
            tbody.innerHTML = '';

            data.forEach(row => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td class="px-6 py-4 text-sm font-semibold text-slate-900 dark:text-white">${row.month}</td>
                    <td class="px-6 py-4 text-right text-sm font-semibold text-indigo-700 dark:text-indigo-200">${row.married}</td>
                    <td class="px-6 py-4 text-right text-sm font-semibold text-slate-900 dark:text-white">${row.divorced}</td>
                    <td class="px-6 py-4 text-right text-sm font-semibold text-emerald-700 dark:text-emerald-200">+${row.married - row.divorced}</td>
                `;
                tr.className = 'transition hover:bg-white/30 dark:hover:bg-white/5';
                tbody.appendChild(tr);
            });
        }

        // Province selector change handler
        document.getElementById('provinceSelect').addEventListener('change', (e) => {
            currentProvince = e.target.value;
            updateChart();
        });

        // Initialize on page load
        window.addEventListener('load', () => {
            initChart();
        });

        // Redraw chart on window resize
        window.addEventListener('resize', () => {
            const canvas = document.getElementById('lineChart');
            canvas.width = canvas.offsetWidth;
            updateChart();
        });
    </script>

@endsection
