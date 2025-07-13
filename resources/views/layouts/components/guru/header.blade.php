<!-- App Header -->
<header class="bg-white dark:bg-gray-800 shadow-sm py-3 px-4 border-b border-gray-100 dark:border-gray-700">
    <div class="flex justify-between items-center max-w-6xl mx-auto">
        <!-- Logo & App Name -->
        <div class="flex items-center space-x-2">
            <div class="w-8 h-8 bg-bangala rounded-md flex items-center justify-center text-white font-bold">
                {{ strtoupper(substr(getPengaturan()->nama_aplikasi, 0, 1)) }}
            </div>
            <h1 class="font-semibold text-lg">{{ getPengaturan()->nama_aplikasi }}</h1>
        </div>

        <!-- User Profile Dropdown -->
        <div class="relative">
            <button id="user-menu-button" class="flex items-center focus:outline-none">
                <div
                    class="w-9 h-9 rounded-full bg-bangala/10 flex items-center justify-center text-bangala font-medium text-sm hover:bg-bangala/20 transition-colors duration-200">
                    @php
                        $name = auth()->user()->nama ?? '';
                        $parts = explode(' ', $name);
                        $initials = $name ? strtoupper(substr($parts[0], 0, 1)) : '?';

                        if (count($parts) > 1) {
                            $initials .= strtoupper(substr($parts[1], 0, 1));
                        }
                    @endphp
                    {{ $initials }}
                </div>
            </button>
            <!-- Dropdown Menu -->
            <div id="user-dropdown"
                class="hidden absolute right-0 mt-2 w-40 bg-white dark:bg-gray-800 rounded-lg shadow-md z-50 overflow-hidden">
                <div class="px-3 py-2.5">
                    <p class="text-sm font-medium text-gray-800 dark:text-gray-100 truncate">{{ auth()->user()->name }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5 truncate">{{ auth()->user()->email }}</p>
                </div>

                <div class="border-t border-gray-100 dark:border-gray-700"></div>

                <button onclick="confirmLogout('{{ route('logout') }}','{{ route('login') }}')"
                    class="flex items-center w-full px-3 py-2 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    Keluar
                </button>
            </div>
        </div>
    </div>
</header>

<script>
    // Toggle dropdown
    document.getElementById('user-menu-button').addEventListener('click', function() {
        document.getElementById('user-dropdown').classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('user-dropdown');
        const button = document.getElementById('user-menu-button');

        if (!button.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>
