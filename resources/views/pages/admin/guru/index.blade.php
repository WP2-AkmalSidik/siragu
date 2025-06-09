@extends('layouts.admin')
@section('title', 'Guru')
@section('description', 'List Guru Mengajar')
@section('content')
    <!-- Search & Filter -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 space-y-4 md:space-y-0">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Daftar Guru</h3>
            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" placeholder="Cari nama guru..."
                        class="pl-10 pr-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg w-full sm:w-64 focus:outline-none focus:ring-2 focus:ring-bangala">
                </div>
                <select
                    class="px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala">
                    <option>Semua Mata Pelajaran</option>
                    <option>Matematika</option>
                    <option>Bahasa Indonesia</option>
                    <option>IPA</option>
                    <option>IPS</option>
                </select>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Nama
                            Guru</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Mata
                            Pelajaran</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Nilai
                        </th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Status
                        </th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="py-4 px-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-bangala rounded-full flex items-center justify-center">
                                    <span class="text-white font-medium">SA</span>
                                </div>
                                <div>
                                    <p class="font-medium">Siti Aminah, S.Pd</p>
                                    <p class="text-sm text-gray-500">NIP: 123456789</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-4">Matematika</td>
                        <td class="py-4 px-4">
                            <span
                                class="px-3 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full text-sm font-medium">95.2</span>
                        </td>
                        <td class="py-4 px-4">
                            <span
                                class="px-3 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full text-sm">Aktif</span>
                        </td>
                        <td class="py-4 px-4">
                            <div class="flex space-x-2">
                                <button class="p-2 text-blue-600 hover:bg-blue-100 dark:hover:bg-blue-900 rounded-lg">
                                    <i class="fas fa-eye text-sm"></i>
                                </button>
                                <button class="p-2 text-green-600 hover:bg-green-100 dark:hover:bg-green-900 rounded-lg">
                                    <i class="fas fa-edit text-sm"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="py-4 px-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-goldspel rounded-full flex items-center justify-center">
                                    <span class="text-white font-medium">AF</span>
                                </div>
                                <div>
                                    <p class="font-medium">Ahmad Fauzi, S.Pd</p>
                                    <p class="text-sm text-gray-500">NIP: 123456790</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-4">Bahasa Indonesia</td>
                        <td class="py-4 px-4">
                            <span
                                class="px-3 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full text-sm font-medium">92.8</span>
                        </td>
                        <td class="py-4 px-4">
                            <span
                                class="px-3 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full text-sm">Aktif</span>
                        </td>
                        <td class="py-4 px-4">
                            <div class="flex space-x-2">
                                <button class="p-2 text-blue-600 hover:bg-blue-100 dark:hover:bg-blue-900 rounded-lg">
                                    <i class="fas fa-eye text-sm"></i>
                                </button>
                                <button class="p-2 text-green-600 hover:bg-green-100 dark:hover:bg-green-900 rounded-lg">
                                    <i class="fas fa-edit text-sm"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="py-4 px-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-medium">F</span>
                                </div>
                                <div>
                                    <p class="font-medium">Fatimah, S.Pd</p>
                                    <p class="text-sm text-gray-500">NIP: 123456791</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-4">IPA</td>
                        <td class="py-4 px-4">
                            <span
                                class="px-3 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full text-sm font-medium">91.5</span>
                        </td>
                        <td class="py-4 px-4">
                            <span
                                class="px-3 py-1 bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 rounded-full text-sm">Cuti</span>
                        </td>
                        <td class="py-4 px-4">
                            <div class="flex space-x-2">
                                <button class="p-2 text-blue-600 hover:bg-blue-100 dark:hover:bg-blue-900 rounded-lg">
                                    <i class="fas fa-eye text-sm"></i>
                                </button>
                                <button class="p-2 text-green-600 hover:bg-green-100 dark:hover:bg-green-900 rounded-lg">
                                    <i class="fas fa-edit text-sm"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="py-4 px-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-medium">RH</span>
                                </div>
                                <div>
                                    <p class="font-medium">Rahmat Hidayat, S.Pd</p>
                                    <p class="text-sm text-gray-500">NIP: 123456792</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-4">IPS</td>
                        <td class="py-4 px-4">
                            <span
                                class="px-3 py-1 bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 rounded-full text-sm font-medium">88.3</span>
                        </td>
                        <td class="py-4 px-4">
                            <span
                                class="px-3 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full text-sm">Aktif</span>
                        </td>
                        <td class="py-4 px-4">
                            <div class="flex space-x-2">
                                <button class="p-2 text-blue-600 hover:bg-blue-100 dark:hover:bg-blue-900 rounded-lg">
                                    <i class="fas fa-eye text-sm"></i>
                                </button>
                                <button class="p-2 text-green-600 hover:bg-green-100 dark:hover:bg-green-900 rounded-lg">
                                    <i class="fas fa-edit text-sm"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex items-center justify-between mt-6">
            <p class="text-sm text-gray-500 dark:text-gray-400">Menampilkan 1-4 dari 24 guru</p>
            <div class="flex space-x-2">
                <button
                    class="px-3 py-2 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="px-3 py-2 bg-bangala text-white rounded-lg">1</button>
                <button
                    class="px-3 py-2 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600">2</button>
                <button
                    class="px-3 py-2 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600">3</button>
                <button
                    class="px-3 py-2 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
@endsection
