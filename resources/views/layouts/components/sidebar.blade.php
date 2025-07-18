<aside id="sidebar"
    class="fixed left-0 top-0 h-full w-64 bg-white dark:bg-gray-800 shadow-xl transform -translate-x-full lg:translate-x-0 transition-all duration-300 z-50 border-r border-gray-100 dark:border-gray-700 flex flex-col">
    <div
        class="p-3 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-white/70 dark:from-gray-800/70 to-transparent">
        <div class="flex items-center space-x-4">
            <div class="w-14 h-14 rounded-xl overflow-hidden flex-shrink-0 shadow-lg">
                <img src="{{ Str::endsWith(getPengaturan()->logo, ['logo.png', 'logo.jpg', 'logo.jpeg']) ? asset(getPengaturan()->logo) : asset(getPengaturan()->logo) }}"
                    alt="Logo SIRAGU" class="w-full h-full object-cover hover:scale-105 transition-transform duration-200"
                    onerror="this.onerror=null; this.src='/path/fallback-logo.png'; this.alt='Logo tidak tersedia'">
            </div>
            <div>
                <h2 class="text-xl font-bold text-bangala dark:text-goldspel tracking-tight">
                    {{ getPengaturan()->nama_aplikasi }}</h2>
                <p class="text-xs text-gray-500 dark:text-gray-400">{{ getPengaturan()->nama_sekolah }}</p>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 p-4 space-y-2 overflow-y-auto custom-scrollbar">
        <a href="{{ route('admin.dashboard') }}"
            class="group relative flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->is('admin') ? 'text-white bg-gradient-to-r from-bangala to-bangala/90 shadow-lg hover:shadow-bangala/30' : 'text-gray-700 dark:text-gray-300 hover:text-bangala dark:hover:text-goldspel hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:shadow-sm' }}">
            <div
                class="absolute inset-0 bg-gradient-to-r from-goldspel/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl">
            </div>
            <i
                class="fas fa-tachometer-alt w-5 {{ request()->is('admin') ? 'text-goldspel group-hover:text-white' : 'group-hover:text-bangala dark:group-hover:text-goldspel' }} transition-colors"></i>
            <span class="relative">Dashboard</span>
        </a>

        <a href="{{ route('admin.pengguna.index') }}"
            class="group relative flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->is('admin/pengguna*') ? 'text-white bg-gradient-to-r from-bangala to-bangala/90 shadow-lg hover:shadow-bangala/30' : 'text-gray-700 dark:text-gray-300 hover:text-bangala dark:hover:text-goldspel hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:shadow-sm' }}">
            <div
                class="absolute inset-0 bg-gradient-to-r from-goldspel/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl">
            </div>
            <i
                class="fas fa-users w-5 {{ request()->is('admin/pengguna*') ? 'text-goldspel group-hover:text-white' : 'group-hover:text-bangala dark:group-hover:text-goldspel' }} transition-colors"></i>
            <span>Data Pengguna</span>
        </a>
        <a href="{{ route('admin.guru.index') }}"
            class="group relative flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->is('admin/guru*') ? 'text-white bg-gradient-to-r from-bangala to-bangala/90 shadow-lg hover:shadow-bangala/30' : 'text-gray-700 dark:text-gray-300 hover:text-bangala dark:hover:text-goldspel hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:shadow-sm' }}">
            <div
                class="absolute inset-0 bg-gradient-to-r from-goldspel/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl">
            </div>
            <i
                class="fas fa-users w-5 {{ request()->is('admin/guru*') ? 'text-goldspel group-hover:text-white' : 'group-hover:text-bangala dark:group-hover:text-goldspel' }} transition-colors"></i>
            <span>Data Guru</span>
        </a>

        <a href="{{ route('admin.tipe-penilaian.index') }}"
            class="group relative flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->is('admin/tipe-penilaian*') ? 'text-white bg-gradient-to-r from-bangala to-bangala/90 shadow-lg hover:shadow-bangala/30' : 'text-gray-700 dark:text-gray-300 hover:text-bangala dark:hover:text-goldspel hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:shadow-sm' }}">
            <i
                class="fas fa-keyboard w-5 {{ request()->is('admin/penilaian*') ? 'text-goldspel group-hover:text-white' : 'group-hover:text-bangala dark:group-hover:text-goldspel' }} transition-colors"></i>
            <span>Tipe Nilai</span>
        </a>
        <a href="{{ route('admin.pengisi.index') }}"
            class="group relative flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->is('admin/pengisi*') ? 'text-white bg-gradient-to-r from-bangala to-bangala/90 shadow-lg hover:shadow-bangala/30' : 'text-gray-700 dark:text-gray-300 hover:text-bangala dark:hover:text-goldspel hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:shadow-sm' }}">
            <i
                class="fas fa-chart-bar w-5 {{ request()->is('admin/pengisi*') ? 'text-goldspel group-hover:text-white' : 'group-hover:text-bangala dark:group-hover:text-goldspel' }} transition-colors"></i>
            <span>Penilaian</span>
        </a>

        <a href="{{ route('admin.rapor.index') }}"
            class="group relative flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->is('admin/rapor*') ? 'text-white bg-gradient-to-r from-bangala to-bangala/90 shadow-lg hover:shadow-bangala/30' : 'text-gray-700 dark:text-gray-300 hover:text-bangala dark:hover:text-goldspel hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:shadow-sm' }}">
            <i
                class="fas fa-file-alt w-5 {{ request()->is('admin/rapor*') ? 'text-goldspel group-hover:text-white' : 'group-hover:text-bangala dark:group-hover:text-goldspel' }} transition-colors"></i>
            <span>Rapor</span>
        </a>

        <!-- Menu Template Formulir -->
        <a href="{{ route('admin.formulir.index') }}"
            class="group relative flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->is('admin/formulir*') ? 'text-white bg-gradient-to-r from-bangala to-bangala/90 shadow-lg hover:shadow-bangala/30' : 'text-gray-700 dark:text-gray-300 hover:text-bangala dark:hover:text-goldspel hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:shadow-sm' }}">
            <div
                class="absolute inset-0 bg-gradient-to-r from-goldspel/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl">
            </div>
            <i
                class="fas fa-clipboard-list w-5 {{ request()->is('admin/form*') ? 'text-goldspel group-hover:text-white' : 'group-hover:text-bangala dark:group-hover:text-goldspel' }} transition-colors"></i>
            <span>Template Formulir</span>
        </a>

        {{-- <a href="{{ route('admin.icons.index') }}"
            class="group relative flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->is('admin/icons*') ? 'text-white bg-gradient-to-r from-bangala to-bangala/90 shadow-lg hover:shadow-bangala/30' : 'text-gray-700 dark:text-gray-300 hover:text-bangala dark:hover:text-goldspel hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:shadow-sm' }}">
            <div
                class="absolute inset-0 bg-gradient-to-r from-goldspel/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl">
            </div>
            <i
                class="fas fa-icons w-5 {{ request()->is('admin/icons*') ? 'text-goldspel group-hover:text-white' : 'group-hover:text-bangala dark:group-hover:text-goldspel' }} transition-colors"></i>
            <span>Icons</span>
        </a> --}}

        <a href="{{ route('admin.pengaturan.index') }}"
            class="group relative flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->is('admin/pengaturan*') ? 'text-white bg-gradient-to-r from-bangala to-bangala/90 shadow-lg hover:shadow-bangala/30' : 'text-gray-700 dark:text-gray-300 hover:text-bangala dark:hover:text-goldspel hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:shadow-sm' }}">
            <i class="fas fa-cog w-5 group-hover:text-bangala dark:group-hover:text-goldspel transition-colors"></i>
            <span>Pengaturan</span>
        </a>
    </nav>
    <!-- User Profile Section -->
    <div
        class="p-4 border-t border-gray-200 dark:border-gray-700 bg-gradient-to-t from-white/50 dark:from-gray-800/50 to-transparent">
        <div
            class="flex justify-between items-center bg-white dark:bg-gray-700 rounded-xl p-3 shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-100 dark:border-gray-600">

            <a href="{{ route('admin.profile') }}"
                class="flex items-center space-x-3 group hover:opacity-80 transition">
                <div
                    class="w-10 h-10 bg-gradient-to-br from-bangala to-goldspel rounded-full flex items-center justify-center shadow-inner group-hover:rotate-6 transition-transform duration-300">
                    <p class="text-white text-sm group-hover:text-goldspel transition-colors">
                        {{ Str::upper(Str::substr(auth()->user()->nama, 0, 2)) }}</p>
                </div>
                <div>
                    <p class="truncate font-medium text-sm text-gray-800 dark:text-gray-100 group-hover:text-bangala dark:group-hover:text-goldspel transition-colors"
                        style="max-width: 14ch;" title="Admin SIRAGU">
                        {{ auth()->user()->nama }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</p>
                </div>
            </a>

            <div class="h-10 w-px bg-gray-300 dark:bg-gray-600 mx-4"></div>

            <button onclick="confirmLogout('{{ route('logout') }}','{{ route('login') }}')"
                class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 transition">
                <i class="fas fa-sign-out-alt text-base"></i>
            </button>

        </div>
    </div>
</aside>
