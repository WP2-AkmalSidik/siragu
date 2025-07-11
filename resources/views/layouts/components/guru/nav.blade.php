    <nav
        class="fixed bottom-0 left-0 right-0 bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700 py-2">
        <div class="flex justify-around max-w-2xl mx-auto">
            <a href="{{ route('guru.dashboard.index') }}"
                class="flex flex-col items-center {{ request()->is('guru') ? 'text-bangala' : 'hover:text-bangala' }}">
                <i class="fas fa-home"></i>
                <span class="text-xs mt-1">Beranda</span>
            </a>
            <a href="{{ route('guru.statistik') }}"
                class="flex flex-col items-center {{ request()->is('guru/statistik*') ? 'text-bangala' : 'hover:text-bangala' }}">
                <i class="fas fa-chart-line text-sm sm:text-base"></i>
                <span class="text-xs mt-1">Statistik</span>
            </a>
            <a href="{{ route('guru.penilaian.index') }}"
                class="flex flex-col items-center text-gray-400 {{ request()->is('guru/penilaian*') ? 'text-bangala' : 'hover:text-bangala' }}">
                <i class="fas fa-chart-line text-sm sm:text-base"></i>
                <span class="text-xs mt-1">Penilaian</span>
            </a>
            <a href="{{ route('guru.profile') }}"
                class="flex flex-col items-center text-gray-400 {{ request()->is('guru/profil*') ? 'text-bangala' : 'hover:text-bangala' }}">
                <i class="fas fa-user"></i>
                <span class="text-xs mt-1">Profil</span>
            </a>
            <button onclick="confirmLogout('{{ route('logout') }}','{{ route('login') }}')"
                class="flex flex-col items-center text-gray-400 hover:text-bangala">
                <i class="fas fa-sign-out-alt text-base"></i>
                <span class="text-xs mt-1">Logout</span>
            </button>

        </div>
    </nav>
