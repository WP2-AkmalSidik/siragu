<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @vite('resources/css/app.css')
  <script src="https://kit.fontawesome.com/af96158b7b.js" crossorigin="anonymous"></script>
  <!-- Google Fonts - Instrument Sans -->
  <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <title>SIRAGU - Dashboard Guru</title>
</head>
<body class="bg-slate-50 dark:bg-gray-900 text-slate-900 dark:text-white font-sans min-h-screen pb-16">

  <!-- App Header -->
  <div class="bg-bangala text-white py-4 px-4 shadow-md">
    <div class="flex justify-between items-center">
      <div class="flex items-center space-x-3">
        <div class="flex items-center space-x-2">
          <div>
            <h1 class="text-lg font-bold">SIRAGU</h1>
            <p class="text-xs text-goldspel">SDIT Abu Bakar</p>
          </div>
        </div>
      </div>
      <div class="flex items-center space-x-3">
        <button class="text-goldspel hover:text-white transition-colors">
          <i class="fas fa-bell"></i>
        </button>
        <div class="w-8 h-8 rounded-full bg-goldspel flex items-center justify-center text-bangala font-bold text-sm">
          AG
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="container px-4 pt-4 pb-16 mx-auto">
    <!-- Welcome Section -->
    <div class="mb-6">
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-4 border-l-4 border-bangala">
        <h2 class="text-lg font-semibold text-bangala dark:text-goldspel mb-1">Selamat Datang!</h2>
        <p class="text-slate-600 dark:text-gray-300 text-sm">Ahmad Gunawan - Guru Kelas 4A</p>
        <p class="text-xs text-slate-500 dark:text-gray-400 mt-1">Semester Genap 2024/2025</p>
      </div>
    </div>

    <!-- Progress Overview -->
    <div class="mb-6">
      <h2 class="text-lg font-semibold mb-3 text-bangala dark:text-goldspel">Progress Penilaian</h2>
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-4 mb-4">
        <div class="grid grid-cols-2 gap-3">
          <div class="p-3 bg-gradient-to-br from-bangala to-red-800 rounded-lg text-white">
            <div class="flex items-center justify-between mb-2">
              <i class="fas fa-tasks text-goldspel"></i>
              <span class="text-2xl font-bold">80%</span>
            </div>
            <p class="text-xs opacity-90">Penilaian Selesai</p>
          </div>
          <div class="p-3 bg-gradient-to-br from-goldspel to-yellow-600 rounded-lg text-white">
            <div class="flex items-center justify-between mb-2">
              <i class="fas fa-clock text-white"></i>
              <span class="text-2xl font-bold">5</span>
            </div>
            <p class="text-xs opacity-90">Siswa Tertunda</p>
          </div>
        </div>
        
        <!-- Progress Bar -->
        <div class="mt-4">
          <div class="flex justify-between items-center mb-2">
            <span class="text-sm font-medium">Progress Keseluruhan</span>
            <span class="text-sm text-bangala font-semibold">24/30 Siswa</span>
          </div>
          <div class="w-full bg-slate-200 dark:bg-gray-700 rounded-full h-2">
            <div class="bg-gradient-to-r from-bangala to-goldspel h-2 rounded-full transition-all duration-300" style="width: 80%"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Quick Actions -->
    <div class="mb-6">
      <h2 class="text-lg font-semibold mb-3 text-bangala dark:text-goldspel">Menu Utama</h2>
      <div class="grid grid-cols-2 gap-4">
        <button class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-4 hover:shadow-md transition-all duration-200 border border-transparent hover:border-bangala">
          <div class="flex flex-col items-center space-y-2">
            <div class="w-12 h-12 rounded-full bg-bangala flex items-center justify-center text-white">
              <i class="fas fa-edit text-lg"></i>
            </div>
            <span class="font-medium text-sm text-center">Isi Penilaian</span>
          </div>
        </button>
        
        <button class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-4 hover:shadow-md transition-all duration-200 border border-transparent hover:border-goldspel">
          <div class="flex flex-col items-center space-y-2">
            <div class="w-12 h-12 rounded-full bg-goldspel flex items-center justify-center text-white">
              <i class="fas fa-chart-bar text-lg"></i>
            </div>
            <span class="font-medium text-sm text-center">Lihat Rapor</span>
          </div>
        </button>
        
        <button class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-4 hover:shadow-md transition-all duration-200 border border-transparent hover:border-bangala">
          <div class="flex flex-col items-center space-y-2">
            <div class="w-12 h-12 rounded-full bg-bangala flex items-center justify-center text-white">
              <i class="fas fa-users text-lg"></i>
            </div>
            <span class="font-medium text-sm text-center">Data Siswa</span>
          </div>
        </button>
        
        <button class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-4 hover:shadow-md transition-all duration-200 border border-transparent hover:border-goldspel">
          <div class="flex flex-col items-center space-y-2">
            <div class="w-12 h-12 rounded-full bg-goldspel flex items-center justify-center text-white">
              <i class="fas fa-calendar-alt text-lg"></i>
            </div>
            <span class="font-medium text-sm text-center">Jadwal</span>
          </div>
        </button>
      </div>
    </div>

    <!-- Reminder Section -->
    <div class="mb-6">
      <h2 class="text-lg font-semibold mb-3 text-bangala dark:text-goldspel">Pengingat</h2>
      <div class="space-y-3">
        <!-- Urgent Reminder -->
        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
          <div class="flex items-start space-x-3">
            <div class="w-8 h-8 rounded-full bg-red-500 flex items-center justify-center text-white flex-shrink-0">
              <i class="fas fa-exclamation text-sm"></i>
            </div>
            <div class="flex-1">
              <h3 class="font-medium text-red-800 dark:text-red-200 text-sm">Deadline Penilaian</h3>
              <p class="text-red-600 dark:text-red-300 text-xs mt-1">5 siswa belum dinilai - Batas waktu: 15 Juni 2025</p>
            </div>
          </div>
        </div>
        
        <!-- Info Reminder -->
        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
          <div class="flex items-start space-x-3">
            <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white flex-shrink-0">
              <i class="fas fa-info text-sm"></i>
            </div>
            <div class="flex-1">
              <h3 class="font-medium text-blue-800 dark:text-blue-200 text-sm">Rapat Koordinasi</h3>
              <p class="text-blue-600 dark:text-blue-300 text-xs mt-1">Besok, 10 Juni 2025 - Pukul 08:00 WIB</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Recent Activity -->
    <div class="mb-4">
      <div class="flex justify-between items-center mb-3">
        <h2 class="text-lg font-semibold text-bangala dark:text-goldspel">Aktivitas Terbaru</h2>
        <button class="text-goldspel text-sm font-medium hover:text-bangala transition-colors">
          Lihat Semua
        </button>
      </div>
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
        <!-- Activity 1 -->
        <div class="p-4 border-b border-slate-100 dark:border-gray-700">
          <div class="flex items-center space-x-3">
            <div class="w-10 h-10 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-600 dark:text-green-400">
              <i class="fas fa-check"></i>
            </div>
            <div class="flex-1">
              <h3 class="font-medium text-sm">Penilaian Ahmad Rizki selesai</h3>
              <p class="text-xs text-slate-500 dark:text-gray-400">Hari ini, 14:30</p>
            </div>
            <div class="text-xs text-green-600 dark:text-green-400 font-medium">
              Selesai
            </div>
          </div>
        </div>
        
        <!-- Activity 2 -->
        <div class="p-4 border-b border-slate-100 dark:border-gray-700">
          <div class="flex items-center space-x-3">
            <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400">
              <i class="fas fa-edit"></i>
            </div>
            <div class="flex-1">
              <h3 class="font-medium text-sm">Penilaian Siti Nurhaliza diperbarui</h3>
              <p class="text-xs text-slate-500 dark:text-gray-400">Hari ini, 11:15</p>
            </div>
            <div class="text-xs text-blue-600 dark:text-blue-400 font-medium">
              Update
            </div>
          </div>
        </div>
        
        <!-- Activity 3 -->
        <div class="p-4">
          <div class="flex items-center space-x-3">
            <div class="w-10 h-10 rounded-full bg-goldspel flex items-center justify-center text-white">
              <i class="fas fa-download"></i>
            </div>
            <div class="flex-1">
              <h3 class="font-medium text-sm">Rapor semester diunduh</h3>
              <p class="text-xs text-slate-500 dark:text-gray-400">Kemarin, 16:45</p>
            </div>
            <div class="text-xs text-goldspel font-medium">
              Download
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Floating Action Button -->
  <div class="fixed bottom-20 right-4">
    <button class="w-14 h-14 rounded-full bg-gradient-to-r from-bangala to-red-800 text-white shadow-lg flex items-center justify-center hover:shadow-xl transition-all duration-200 hover:scale-105">
      <i class="fas fa-plus text-xl"></i>
    </button>
  </div>

  <!-- Bottom Navigation -->
  <div class="fixed bottom-0 left-0 right-0 bg-white dark:bg-gray-800 border-t border-slate-200 dark:border-gray-700 py-2 px-6">
    <div class="flex justify-around items-center">
      <a href="#" class="flex flex-col items-center text-bangala">
        <i class="fas fa-home text-xl"></i>
        <span class="text-xs mt-1 font-medium">Beranda</span>
      </a>
      <a href="/formulir" class="flex flex-col items-center text-slate-400 dark:text-gray-400 hover:text-goldspel transition-colors">
        <i class="fas fa-edit text-xl"></i>
        <span class="text-xs mt-1">Penilaian</span>
      </a>
      <a href="#" class="flex flex-col items-center text-slate-400 dark:text-gray-400 hover:text-goldspel transition-colors">
        <i class="fas fa-chart-line text-xl"></i>
        <span class="text-xs mt-1">Laporan</span>
      </a>
      <a href="#" class="flex flex-col items-center text-slate-400 dark:text-gray-400 hover:text-goldspel transition-colors">
        <i class="fas fa-user text-xl"></i>
        <span class="text-xs mt-1">Profil</span>
      </a>
    </div>
  </div>
</body>
</html>