@extends('layouts.guru')
@section('title', 'Penilaian')
@push('styles')
    <style>
        @media (max-width: 640px) {
            .mobile-stack {
                flex-direction: column !important;
                align-items: flex-start !important;
            }

            .mobile-text-center {
                text-align: center !important;
            }

            .mobile-full-width {
                width: 100% !important;
            }

            .mobile-mt-2 {
                margin-top: 0.5rem !important;
            }

            .mobile-p-3 {
                padding: 0.75rem !important;
            }

            .mobile-flex-col {
                flex-direction: column !important;
            }

            .mobile-space-y-2>*+* {
                margin-top: 0.5rem !important;
            }

            .teacher-card {
                padding: 0.75rem !important;
            }

            .teacher-info {
                flex-direction: column !important;
                gap: 0.25rem !important;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 py-4">
        <!-- Kepsek Profile Header -->
        <div class="flex items-center justify-between mb-6 mobile-stack mobile-space-y-2">
            <div class="mobile-full-width mobile-text-center sm:text-left">
                <h1 class="text-xl font-semibold">Daftar Guru</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">SMPIT Abu Bakar - Tahun Ajaran 2023/2024</p>
            </div>
            <div class="text-right mobile-full-width mobile-text-center sm:text-right">
                <div class="text-2xl font-bold text-bangala">21</div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Total Guru</p>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="mb-6 flex items-center gap-3 mobile-flex-col">
            <div class="relative flex-grow mobile-full-width">
                <input type="text" placeholder="Cari guru..."
                    class="w-full pl-10 pr-4 py-2 border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-bangala focus:border-transparent">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
            <button
                class="flex items-center gap-2 px-4 py-2 border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 mobile-full-width justify-center">
                <i class="fas fa-filter text-gray-400"></i>
                <span>Filter</span>
            </button>
        </div>
        <!-- Teacher List -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Teacher Card 1 -->
            <div
                class="bg-white dark:bg-gray-800 rounded-lg border border-gray-100 dark:border-gray-700 p-4 transition-all duration-200 hover:shadow-md dark:hover:shadow-gray-700/50">
                <div class="flex flex-col h-full">
                    <div class="flex-grow">
                        <div class="flex items-start justify-between">
                            <div
                                class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/20 flex items-center justify-center mr-3 flex-shrink-0">
                                <i class="fas fa-user-tie text-blue-600 dark:text-blue-400"></i>
                            </div>
                            <div class="flex-grow">
                                <h3 class="font-semibold text-lg">Dr. Andi Setiawan, M.Pd</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">NIP: 197003041992031002</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 truncate">
                                    andi.setiawan@smpitabubakar.sch.id</p>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span
                                class="inline-block px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-400">
                                Fisika
                            </span>
                        </div>
                    </div>
                    <button onclick="navigateToAssessment('1')"
                        class="mt-4 w-full flex items-center justify-center gap-2 px-4 py-2 bg-bangala hover:bg-bangala/90 text-white rounded-lg font-medium transition-all duration-200">
                        <i class="fas fa-pen"></i>
                        <span>Isi Nilai</span>
                    </button>
                </div>
            </div>

            <!-- Teacher Card 2 -->
            <div
                class="bg-white dark:bg-gray-800 rounded-lg border border-gray-100 dark:border-gray-700 p-4 transition-all duration-200 hover:shadow-md dark:hover:shadow-gray-700/50">
                <div class="flex flex-col h-full">
                    <div class="flex-grow">
                        <div class="flex items-start justify-between">
                            <div
                                class="w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900/20 flex items-center justify-center mr-3 flex-shrink-0">
                                <i class="fas fa-user-tie text-purple-600 dark:text-purple-400"></i>
                            </div>
                            <div class="flex-grow">
                                <h3 class="font-semibold text-lg">Sari Wulandari, S.Pd</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">NIP: 198506102008022001</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 truncate">
                                    sari.wulandari@smpitabubakar.sch.id</p>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span
                                class="inline-block px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900/20 dark:text-purple-400">
                                Bahasa Inggris
                            </span>
                        </div>
                    </div>
                    <button onclick="navigateToAssessment('2')"
                        class="mt-4 w-full flex items-center justify-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-all duration-200">
                        <i class="fas fa-eye"></i>
                        <span>Lihat Nilai</span>
                    </button>
                </div>
            </div>

            <!-- Teacher Card 3 -->
            <div
                class="bg-white dark:bg-gray-800 rounded-lg border border-gray-100 dark:border-gray-700 p-4 transition-all duration-200 hover:shadow-md dark:hover:shadow-gray-700/50">
                <div class="flex flex-col h-full">
                    <div class="flex-grow">
                        <div class="flex items-start justify-between">
                            <div
                                class="w-10 h-10 rounded-full bg-orange-100 dark:bg-orange-900/20 flex items-center justify-center mr-3 flex-shrink-0">
                                <i class="fas fa-user-tie text-orange-600 dark:text-orange-400"></i>
                            </div>
                            <div class="flex-grow">
                                <h3 class="font-semibold text-lg">Muhammad Rizki, S.Kom</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">NIP: 199010152015021001</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 truncate">
                                    m.rizki@smpitabubakar.sch.id</p>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span
                                class="inline-block px-2 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-900/20 dark:text-orange-400">
                                TIK
                            </span>
                        </div>
                    </div>
                    <button onclick="navigateToAssessment('3')"
                        class="mt-4 w-full flex items-center justify-center gap-2 px-4 py-2 bg-bangala hover:bg-bangala/90 text-white rounded-lg font-medium transition-all duration-200">
                        <i class="fas fa-pen"></i>
                        <span>Isi Nilai</span>
                    </button>
                </div>
            </div>

            <!-- Teacher Card 4 -->
            <div
                class="bg-white dark:bg-gray-800 rounded-lg border border-gray-100 dark:border-gray-700 p-4 transition-all duration-200 hover:shadow-md dark:hover:shadow-gray-700/50">
                <div class="flex flex-col h-full">
                    <div class="flex-grow">
                        <div class="flex items-start justify-between">
                            <div
                                class="w-10 h-10 rounded-full bg-green-100 dark:bg-green-900/20 flex items-center justify-center mr-3 flex-shrink-0">
                                <i class="fas fa-user-tie text-green-600 dark:text-green-400"></i>
                            </div>
                            <div class="flex-grow">
                                <h3 class="font-semibold text-lg">Nurul Hidayah, S.Ag</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">NIP: 198812202010122002</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 truncate">
                                    nurul.hidayah@smpitabubakar.sch.id</p>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span
                                class="inline-block px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400">
                                PAI
                            </span>
                        </div>
                    </div>
                    <button onclick="navigateToAssessment('4')"
                        class="mt-4 w-full flex items-center justify-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-all duration-200">
                        <i class="fas fa-eye"></i>
                        <span>Lihat Nilai</span>
                    </button>
                </div>
            </div>

            <!-- Teacher Card 5 -->
            <div
                class="bg-white dark:bg-gray-800 rounded-lg border border-gray-100 dark:border-gray-700 p-4 transition-all duration-200 hover:shadow-md dark:hover:shadow-gray-700/50">
                <div class="flex flex-col h-full">
                    <div class="flex-grow">
                        <div class="flex items-start justify-between">
                            <div
                                class="w-10 h-10 rounded-full bg-red-100 dark:bg-red-900/20 flex items-center justify-center mr-3 flex-shrink-0">
                                <i class="fas fa-user-tie text-red-600 dark:text-red-400"></i>
                            </div>
                            <div class="flex-grow">
                                <h3 class="font-semibold text-lg">Budi Santoso, S.Pd</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">NIP: 198203152006041002</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 truncate">
                                    budi.santoso@smpitabubakar.sch.id</p>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span
                                class="inline-block px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400">
                                Matematika
                            </span>
                        </div>
                    </div>
                    <button onclick="navigateToAssessment('5')"
                        class="mt-4 w-full flex items-center justify-center gap-2 px-4 py-2 bg-bangala hover:bg-bangala/90 text-white rounded-lg font-medium transition-all duration-200">
                        <i class="fas fa-pen"></i>
                        <span>Isi Nilai</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-center">
            <nav class="flex items-center gap-1">
                <button
                    class="px-3 py-1 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="px-3 py-1 rounded-lg bg-bangala text-white">1</button>
                <button
                    class="px-3 py-1 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">2</button>
                <button
                    class="px-3 py-1 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">3</button>
                <button
                    class="px-3 py-1 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </nav>
        </div>
    </main>
@endsection
