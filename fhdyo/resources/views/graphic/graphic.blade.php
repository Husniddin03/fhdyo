<x-app title="graphic">
    <div class="flex justify-between">
        <h1 class="text-2xl font-semibold text-gray-900">Graphic</h1>
    </div>

    <style>
        .main-body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .header h1 {
            font-size: 28px;
            color: #1f2937;
        }

        .header p {
            color: #6b7280;
            margin-top: 5px;
        }

        .province-selector {
            padding: 12px 20px;
            font-size: 16px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            background: white;
            cursor: pointer;
            transition: all 0.3s;
        }

        .province-selector:hover {
            border-color: #8b5cf6;
        }

        .province-selector:focus {
            outline: none;
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-label {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .stat-value {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .stat-value.married {
            color: #8b5cf6;
        }

        .stat-value.divorced {
            color: #3b4252;
        }

        .stat-value.difference {
            color: #10b981;
        }

        .stat-info {
            color: #9ca3af;
            font-size: 13px;
        }

        .chart-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 22px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 10px;
        }

        .chart-subtitle {
            color: #6b7280;
            margin-bottom: 30px;
        }

        canvas {
            max-width: 100%;
            height: auto !important;
        }

        .legend {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 20px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .legend-color {
            width: 20px;
            height: 4px;
            border-radius: 2px;
        }

        .legend-color.married {
            background: #8b5cf6;
        }

        .legend-color.divorced {
            background: #3b4252;
        }

        .table-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 15px;
            border-bottom: 2px solid #e5e7eb;
            color: #374151;
            font-weight: 600;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #f3f4f6;
        }

        tr:hover {
            background: #f9fafb;
        }

        .value-married {
            color: #8b5cf6;
            font-weight: 600;
        }

        .value-divorced {
            color: #3b4252;
            font-weight: 600;
        }

        .value-difference {
            color: #10b981;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header h1 {
                font-size: 22px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .chart-container {
                padding: 20px;
            }

            .table-container {
                padding: 20px;
            }
        }
    </style>
    </head>

    <div class="main-body">
        <div class="container">
            <!-- Header -->
            <div class="header">
                <div>
                    <h1>Nikoh va Ajrashish Statistikasi</h1>
                    <p>Oylik ma'lumotlar bo'yicha tahlil</p>
                </div>
                <select class="province-selector" id="provinceSelect">
                    <option value="Toshkent sh">Toshkent sh</option>
                    <option value="Toshkent">Toshkent</option>
                    <option value="Samarqand">Samarqand</option>
                    <option value="Buxoro">Buxoro</option>
                    <option value="Fargona">Farg'ona</option>
                    <option value="Andijon">Andijon</option>
                    <option value="Sirdaryo">Sirdaryo</option>
                    <option value="Jizzax">Jizzax</option>
                    <option value="Qashqadaryo">Qashqadaryo</option>
                    <option value="Surxandaryo">Surxandaryo</option>
                    <option value="Navoiy">Navoiy</option>
                    <option value="Buxoro">Buxoro</option>
                    <option value="Xorazm">Xorazm</option>
                    <option value="Qoraqalpog'stoon R">Qoraqalpog'stoon R</option>
                </select>
            </div>

            <!-- Statistics Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">Jami Nikohlar</div>
                    <div class="stat-value married" id="totalMarried">0</div>
                    <div class="stat-info" id="provinceInfo1">Toshkent viloyati</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Jami Ajrashishlar</div>
                    <div class="stat-value divorced" id="totalDivorced">0</div>
                    <div class="stat-info" id="provinceInfo2">Toshkent viloyati</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Farq</div>
                    <div class="stat-value difference" id="percentageDiff">0%</div>
                    <div class="stat-info">Nikohlar ajrashishlardan ko'p</div>
                </div>
            </div>

            <!-- Chart -->
            <div class="chart-container">
                <h2 class="chart-title w-full">Oylik Statistika - <span id="chartProvince">Toshkent</span></h2>
                <p class="chart-subtitle w-full">Nikoh va ajrashishlar soni oylar bo'yicha</p>
                <canvas id="lineChart" class="w-full"></canvas>
                <div class="legend w-full">
                    <div class="legend-item">
                        <div class="legend-color married"></div>
                        <span>Nikohlar</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color divorced"></div>
                        <span>Ajrashishlar</span>
                    </div>
                </div>
            </div>

            <!-- Data Table -->
            <div class="table-container">
                <h2 class="chart-title">Batafsil Ma'lumotlar</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Oy</th>
                            <th style="text-align: right;">Nikohlar</th>
                            <th style="text-align: right;">Ajrashishlar</th>
                            <th style="text-align: right;">Farq</th>
                        </tr>
                    </thead>
                    <tbody id="dataTable">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Data for different provinces
        const provinceData = {
            toshkent: [{
                    month: 'Yan',
                    married: 45,
                    divorced: 12
                },
                {
                    month: 'Fev',
                    married: 89,
                    divorced: 18
                },
                {
                    month: 'Mar',
                    married: 156,
                    divorced: 25
                },
                {
                    month: 'Apr',
                    married: 234,
                    divorced: 32
                },
                {
                    month: 'May',
                    married: 298,
                    divorced: 45
                },
                {
                    month: 'Iyun',
                    married: 267,
                    divorced: 52
                },
                {
                    month: 'Iyul',
                    married: 312,
                    divorced: 48
                },
                {
                    month: 'Avg',
                    married: 489,
                    divorced: 65
                },
                {
                    month: 'Sen',
                    married: 378,
                    divorced: 58
                },
                {
                    month: 'Okt',
                    married: 423,
                    divorced: 71
                },
                {
                    month: 'Noy',
                    married: 289,
                    divorced: 54
                },
                {
                    month: 'Dek',
                    married: 512,
                    divorced: 78
                },
            ],
            samarqand: [{
                    month: 'Yan',
                    married: 38,
                    divorced: 8
                },
                {
                    month: 'Fev',
                    married: 72,
                    divorced: 14
                },
                {
                    month: 'Mar',
                    married: 134,
                    divorced: 21
                },
                {
                    month: 'Apr',
                    married: 198,
                    divorced: 28
                },
                {
                    month: 'May',
                    married: 256,
                    divorced: 38
                },
                {
                    month: 'Iyun',
                    married: 223,
                    divorced: 42
                },
                {
                    month: 'Iyul',
                    married: 267,
                    divorced: 39
                },
                {
                    month: 'Avg',
                    married: 412,
                    divorced: 52
                },
                {
                    month: 'Sen',
                    married: 321,
                    divorced: 47
                },
                {
                    month: 'Okt',
                    married: 356,
                    divorced: 58
                },
                {
                    month: 'Noy',
                    married: 245,
                    divorced: 44
                },
                {
                    month: 'Dek',
                    married: 434,
                    divorced: 63
                },
            ],
            buxoro: [{
                    month: 'Yan',
                    married: 28,
                    divorced: 6
                },
                {
                    month: 'Fev',
                    married: 54,
                    divorced: 11
                },
                {
                    month: 'Mar',
                    married: 98,
                    divorced: 16
                },
                {
                    month: 'Apr',
                    married: 145,
                    divorced: 22
                },
                {
                    month: 'May',
                    married: 189,
                    divorced: 29
                },
                {
                    month: 'Iyun',
                    married: 167,
                    divorced: 32
                },
                {
                    month: 'Iyul',
                    married: 198,
                    divorced: 30
                },
                {
                    month: 'Avg',
                    married: 305,
                    divorced: 40
                },
                {
                    month: 'Sen',
                    married: 238,
                    divorced: 36
                },
                {
                    month: 'Okt',
                    married: 267,
                    divorced: 44
                },
                {
                    month: 'Noy',
                    married: 182,
                    divorced: 34
                },
                {
                    month: 'Dek',
                    married: 321,
                    divorced: 48
                },
            ],
            fargona: [{
                    month: 'Yan',
                    married: 52,
                    divorced: 14
                },
                {
                    month: 'Fev',
                    married: 98,
                    divorced: 21
                },
                {
                    month: 'Mar',
                    married: 178,
                    divorced: 29
                },
                {
                    month: 'Apr',
                    married: 267,
                    divorced: 38
                },
                {
                    month: 'May',
                    married: 334,
                    divorced: 52
                },
                {
                    month: 'Iyun',
                    married: 298,
                    divorced: 58
                },
                {
                    month: 'Iyul',
                    married: 356,
                    divorced: 54
                },
                {
                    month: 'Avg',
                    married: 545,
                    divorced: 72
                },
                {
                    month: 'Sen',
                    married: 423,
                    divorced: 65
                },
                {
                    month: 'Okt',
                    married: 478,
                    divorced: 79
                },
                {
                    month: 'Noy',
                    married: 334,
                    divorced: 61
                },
                {
                    month: 'Dek',
                    married: 578,
                    divorced: 86
                },
            ],
            andijon: [{
                    month: 'Yan',
                    married: 41,
                    divorced: 11
                },
                {
                    month: 'Fev',
                    married: 78,
                    divorced: 17
                },
                {
                    month: 'Mar',
                    married: 142,
                    divorced: 23
                },
                {
                    month: 'Apr',
                    married: 213,
                    divorced: 31
                },
                {
                    month: 'May',
                    married: 267,
                    divorced: 42
                },
                {
                    month: 'Iyun',
                    married: 238,
                    divorced: 47
                },
                {
                    month: 'Iyul',
                    married: 284,
                    divorced: 44
                },
                {
                    month: 'Avg',
                    married: 436,
                    divorced: 58
                },
                {
                    month: 'Sen',
                    married: 338,
                    divorced: 52
                },
                {
                    month: 'Okt',
                    married: 382,
                    divorced: 63
                },
                {
                    month: 'Noy',
                    married: 267,
                    divorced: 49
                },
                {
                    month: 'Dek',
                    married: 462,
                    divorced: 69
                },
            ],
        };

        const provinceNames = {
            toshkent: 'Toshkent',
            samarqand: 'Samarqand',
            buxoro: 'Buxoro',
            fargona: "Farg'ona",
            andijon: 'Andijon',
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
                    <td>${row.month}</td>
                    <td style="text-align: right;" class="value-married">${row.married}</td>
                    <td style="text-align: right;" class="value-divorced">${row.divorced}</td>
                    <td style="text-align: right;" class="value-difference">+${row.married - row.divorced}</td>
                `;
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

</x-app>
