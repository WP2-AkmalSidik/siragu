<aside id="sidebar"
    class="fixed left-0 top-0 h-full w-64 bg-white dark:bg-gray-800 shadow-xl transform -translate-x-full lg:translate-x-0 transition-all duration-300 z-50 border-r border-gray-100 dark:border-gray-700 flex flex-col">
    <div
        class="p-3 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-white/70 dark:from-gray-800/70 to-transparent">
        <div class="flex items-center space-x-4">
            <div class="w-14 h-14 rounded-xl overflow-hidden flex-shrink-0 shadow-lg">
                <img src="{{ asset('img/logo-yayasan.png') }}" alt="Logo SIRAGU"
                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-200"
                    onerror="this.onerror=null; this.src='/path/fallback-logo.png'; this.alt='Logo tidak tersedia'">
            </div>
            <div>
                <h2 class="text-xl font-bold text-bangala dark:text-goldspel tracking-tight">SIRAGU</h2>
                <p class="text-xs text-gray-500 dark:text-gray-400">SDIT Abu Bakar</p>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 p-4 space-y-2 overflow-y-auto custom-scrollbar">
        <a href="/"
            class="group relative flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->is('/') ? 'text-white bg-gradient-to-r from-bangala to-bangala/90 shadow-lg hover:shadow-bangala/30' : 'text-gray-700 dark:text-gray-300 hover:text-bangala dark:hover:text-goldspel hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:shadow-sm' }}">
            <div
                class="absolute inset-0 bg-gradient-to-r from-goldspel/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl">
            </div>
            <i
                class="fas fa-tachometer-alt w-5 {{ request()->is('/') ? 'text-goldspel group-hover:text-white' : 'group-hover:text-bangala dark:group-hover:text-goldspel' }} transition-colors"></i>
            <span class="relative">Dashboard</span>
        </a>

        <a href="/guru"
            class="group relative flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->is('guru*') ? 'text-white bg-gradient-to-r from-bangala to-bangala/90 shadow-lg hover:shadow-bangala/30' : 'text-gray-700 dark:text-gray-300 hover:text-bangala dark:hover:text-goldspel hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:shadow-sm' }}">
            <div
                class="absolute inset-0 bg-gradient-to-r from-goldspel/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl">
            </div>
            <i
                class="fas fa-users w-5 {{ request()->is('guru*') ? 'text-goldspel group-hover:text-white' : 'group-hover:text-bangala dark:group-hover:text-goldspel' }} transition-colors"></i>
            <span>Data Guru</span>
        </a>

        <a href="/penilaian"
            class="group relative flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->is('penilaian*') ? 'text-white bg-gradient-to-r from-bangala to-bangala/90 shadow-lg hover:shadow-bangala/30' : 'text-gray-700 dark:text-gray-300 hover:text-bangala dark:hover:text-goldspel hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:shadow-sm' }}">
            <i
                class="fas fa-chart-bar w-5 {{ request()->is('penilaian*') ? 'text-goldspel group-hover:text-white' : 'group-hover:text-bangala dark:group-hover:text-goldspel' }} transition-colors"></i>
            <span>Penilaian</span>
        </a>

        <a href="/rapor"
            class="group relative flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->is('rapor*') ? 'text-white bg-gradient-to-r from-bangala to-bangala/90 shadow-lg hover:shadow-bangala/30' : 'text-gray-700 dark:text-gray-300 hover:text-bangala dark:hover:text-goldspel hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:shadow-sm' }}">
            <i
                class="fas fa-file-alt w-5 {{ request()->is('rapor*') ? 'text-goldspel group-hover:text-white' : 'group-hover:text-bangala dark:group-hover:text-goldspel' }} transition-colors"></i>
            <span>Rapor</span>
        </a>

        <a href="#"
            class="group relative flex items-center space-x-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:text-bangala dark:hover:text-goldspel rounded-xl transition-all duration-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:shadow-sm">
            <i class="fas fa-cog w-5 group-hover:text-bangala dark:group-hover:text-goldspel transition-colors"></i>
            <span>Pengaturan</span>
        </a>
    </nav>
    <!-- User Profile Section -->
    <div
        class="p-4 border-t border-gray-200 dark:border-gray-700 bg-gradient-to-t from-white/50 dark:from-gray-800/50 to-transparent">
        <div
            class="flex justify-between items-center bg-white dark:bg-gray-700 rounded-xl p-3 shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-100 dark:border-gray-600">

            <a href="/profile" class="flex items-center space-x-3 group hover:opacity-80 transition">
                <div
                    class="w-10 h-10 bg-gradient-to-br from-bangala to-goldspel rounded-full flex items-center justify-center shadow-inner group-hover:rotate-6 transition-transform duration-300">
                    <i class="fas fa-user text-white text-sm group-hover:text-goldspel transition-colors"></i>
                </div>
                <div>
                    <p class="truncate font-medium text-sm text-gray-800 dark:text-gray-100 group-hover:text-bangala dark:group-hover:text-goldspel transition-colors"
                        style="max-width: 14ch;" title="Admin SIRAGU">
                        Admin SIRAGU
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">administrator</p>
                </div>
            </a>

            <div class="h-10 w-px bg-gray-300 dark:bg-gray-600 mx-4"></div>

            <a href="/logout"
                class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 transition">
                <i class="fas fa-sign-out-alt text-base"></i>
            </a>

        </div>
    </div>
</aside>
