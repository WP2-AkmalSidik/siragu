<header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 px-6 py-4">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <button id="sidebarToggle" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                <i class="fas fa-bars text-gray-600 dark:text-gray-300"></i>
            </button>
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">@yield('title')</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400">@yield('description')</p>
            </div>
        </div>

        <div class="flex items-center space-x-4">
            <div class="relative">
                <button class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 relative">
                    <i class="fas fa-bell text-gray-600 dark:text-gray-300"></i>
                    <span
                        class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
                </button>
            </div>

            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-bangala rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-white text-sm"></i>
                </div>
                <div class="hidden md:block">
                    <p class="font-medium text-sm">Admin SIRAGU</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Kepala Sekolah</p>
                </div>
            </div>
        </div>
    </div>
</header>
