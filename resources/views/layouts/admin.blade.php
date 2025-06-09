<!DOCTYPE html>
<html lang="id" class="bg-white text-gray-900 dark:bg-gray-900 dark:text-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIRAGU Dashboard - SD IT Abu Bakar</title>
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/af96158b7b.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="min-h-screen bg-gray-50 dark:bg-gray-900 font-sans">
    <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden sidebar-overlay"></div>

    <!-- Sidebar -->
    @include('layouts.components.sidebar')

    <div class="lg:ml-64 min-h-screen">
        <!-- Header -->
        @include('layouts.components.header')

        <!-- Dashboard Content -->
        <main class="p-6 space-y-6">
            @yield('content')
        </main>
    </div>

    <script>
        // Sidebar Toggle Functionality
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
        }

        sidebarToggle.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', toggleSidebar);

        // Chart.js Configuration
        const ctx = document.getElementById('performanceChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Rata-rata Nilai',
                    data: [82, 85, 83, 87, 89, 87.5],
                    borderColor: '#913013',
                    backgroundColor: 'rgba(145, 48, 19, 0.1)',
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Target',
                    data: [85, 85, 85, 85, 85, 85],
                    borderColor: '#c19e5e',
                    backgroundColor: 'rgba(193, 158, 94, 0.1)',
                    borderDash: [5, 5],
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        min: 75,
                        max: 95
                    }
                }
            }
        });

        // Responsive handling
        function handleResize() {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            }
        }

        window.addEventListener('resize', handleResize);
        handleResize(); // Call on load
    </script>
</body>

</html>
