<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @vite('resources/css/app.css')
  <script src="https://kit.fontawesome.com/af96158b7b.js" crossorigin="anonymous"></script>
  <title>SIRAGU - Dashboard Guru</title>
  <style>
    .dashboard-card {
      transition: all 0.2s ease;
    }
    .dashboard-card:hover {
      transform: translateY(-2px);
    }
  </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 min-h-screen pb-16 font-sans">

  <!-- App Header -->
  <header class="bg-white dark:bg-gray-800 shadow-sm py-3 px-4 border-b border-gray-100 dark:border-gray-700">
    <div class="flex justify-between items-center max-w-6xl mx-auto">
      <div class="flex items-center space-x-2">
        <div class="w-8 h-8 bg-bangala rounded-md flex items-center justify-center text-white font-bold">S</div>
        <h1 class="font-semibold text-lg">SIRAGU</h1>
      </div>
      <div class="flex items-center space-x-3">
        <button class="text-gray-500 hover:text-bangala">
          <i class="far fa-bell"></i>
        </button>
        <div class="w-8 h-8 rounded-full bg-bangala/10 flex items-center justify-center text-bangala font-medium text-sm">
          AG
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="max-w-6xl mx-auto px-4 py-4">
    <!-- Teacher Profile Header -->
    <div class="flex items-center justify-between mb-6">
      <div>
        <h1 class="text-xl font-semibold">Halo, Ahmad Gunawan</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">Guru Kelas 4A | Semester Genap 2024/2025</p>
      </div>
      <div class="text-right">
        <div class="text-2xl font-bold text-bangala">80%</div>
        <p class="text-xs text-gray-500 dark:text-gray-400">Progress Penilaian</p>
      </div>
    </div>

    <!-- Quick Actions Grid -->
    <div class="grid grid-cols-4 gap-3 mb-6">
      <a href="#" class="dashboard-card bg-white dark:bg-gray-800 rounded-lg p-3 text-center shadow-xs border border-gray-100 dark:border-gray-700">
        <div class="w-10 h-10 bg-bangala/10 rounded-full flex items-center justify-center text-bangala mx-auto mb-2">
          <i class="fas fa-edit"></i>
        </div>
        <span class="text-xs font-medium">Isi Nilai</span>
      </a>
      <a href="#" class="dashboard-card bg-white dark:bg-gray-800 rounded-lg p-3 text-center shadow-xs border border-gray-100 dark:border-gray-700">
        <div class="w-10 h-10 bg-green-100 dark:bg-green-900/20 rounded-full flex items-center justify-center text-green-600 dark:text-green-400 mx-auto mb-2">
          <i class="fas fa-file-alt"></i>
        </div>
        <span class="text-xs font-medium">Rapor</span>
      </a>
      <a href="#" class="dashboard-card bg-white dark:bg-gray-800 rounded-lg p-3 text-center shadow-xs border border-gray-100 dark:border-gray-700">
        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/20 rounded-full flex items-center justify-center text-blue-600 dark:text-blue-400 mx-auto mb-2">
          <i class="fas fa-users"></i>
        </div>
        <span class="text-xs font-medium">Siswa</span>
      </a>
      <a href="#" class="dashboard-card bg-white dark:bg-gray-800 rounded-lg p-3 text-center shadow-xs border border-gray-100 dark:border-gray-700">
        <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/20 rounded-full flex items-center justify-center text-purple-600 dark:text-purple-400 mx-auto mb-2">
          <i class="fas fa-calendar"></i>
        </div>
        <span class="text-xs font-medium">Jadwal</span>
      </a>
    </div>

    <!-- Report Card Preview -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 mb-6 overflow-hidden">
      <div class="border-b border-gray-100 dark:border-gray-700 px-4 py-3">
        <h2 class="font-semibold flex items-center">
          <i class="fas fa-file-contract text-bangala mr-2"></i>
          Raport Terakhir
        </h2>
      </div>
      <div class="p-4">
        <div class="flex items-center justify-between mb-3">
          <div>
            <h3 class="font-medium">Semester Genap 2023/2024</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400">30 Siswa | Selesai 28 Mei 2024</p>
          </div>
          <a href="#" class="text-xs text-bangala font-medium flex items-center">
            Lihat Detail <i class="fas fa-chevron-right ml-1 text-xs"></i>
          </a>
        </div>
        
        <!-- Mini Report Table -->
        <div class="overflow-x-auto">
          <table class="w-full text-sm">
            <thead>
              <tr class="text-left border-b border-gray-100 dark:border-gray-700">
                <th class="pb-2 font-medium">Aspek</th>
                <th class="pb-2 font-medium text-right">Rata²</th>
                <th class="pb-2 font-medium text-right">Selesai</th>
              </tr>
            </thead>
            <tbody>
              <tr class="border-b border-gray-100 dark:border-gray-700">
                <td class="py-2">Kedisiplinan</td>
                <td class="py-2 text-right font-medium">85</td>
                <td class="py-2 text-right">
                  <span class="inline-block w-3 h-3 bg-green-500 rounded-full"></span>
                </td>
              </tr>
              <tr class="border-b border-gray-100 dark:border-gray-700">
                <td class="py-2">Pengajaran</td>
                <td class="py-2 text-right font-medium">88</td>
                <td class="py-2 text-right">
                  <span class="inline-block w-3 h-3 bg-green-500 rounded-full"></span>
                </td>
              </tr>
              <tr>
                <td class="py-2">Administrasi</td>
                <td class="py-2 text-right font-medium">76</td>
                <td class="py-2 text-right">
                  <span class="inline-block w-3 h-3 bg-yellow-500 rounded-full"></span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>

  <!-- Bottom Navigation -->
  <nav class="fixed bottom-0 left-0 right-0 bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700 py-2">
    <div class="flex justify-around max-w-2xl mx-auto">
      <a href="#" class="flex flex-col items-center text-bangala">
        <i class="fas fa-home"></i>
        <span class="text-xs mt-1">Beranda</span>
      </a>
      <a href="#" class="flex flex-col items-center text-gray-400 hover:text-bangala">
        <i class="fas fa-clipboard-list"></i>
        <span class="text-xs mt-1">Nilai</span>
      </a>
      <a href="#" class="flex flex-col items-center text-gray-400 hover:text-bangala">
        <i class="fas fa-chart-pie"></i>
        <span class="text-xs mt-1">Analisis</span>
      </a>
      <a href="#" class="flex flex-col items-center text-gray-400 hover:text-bangala">
        <i class="fas fa-cog"></i>
        <span class="text-xs mt-1">Pengaturan</span>
      </a>
    </div>
  </nav>
</body>
</html>