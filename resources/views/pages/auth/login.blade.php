<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/af96158b7b.js" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIRAGU - Login</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.1/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.1/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50 dark:bg-gray-900 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md md:max-w-lg lg:max-w-xl xl:max-w-xl">
        <!-- Login Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-8 animate-fade-in-up">
            <!-- Logo & Title -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 mb-4 mx-auto">
                    @if (file_exists(public_path('img/logo-yayasan.png')))
                        <img src="{{ asset('img/logo-yayasan.png') }}" alt="SIRAGU Logo"
                            class="w-full h-full object-contain">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-bangala rounded-full shadow-lg">
                            <i class="fas fa-graduation-cap text-white text-3xl"></i>
                        </div>
                    @endif
                </div>
                <h1 class="text-3xl font-bold text-bangala dark:text-goldspel mb-2">SIRAGU</h1>
                <p class="text-gray-600 dark:text-gray-400">Sistem Informasi Rapor Guru</p>
            </div>

            <!-- Login Form -->
            <form id="form-login" class="space-y-6">
                <!-- Email Input -->
                <div class="animate-slide-in">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400 dark:text-gray-500"></i>
                        </div>
                        <input type="email" id="email" name="email" placeholder="guru@siragu.com"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-bangala dark:focus:ring-goldspel focus:border-bangala dark:focus:border-goldspel transition-all duration-300"
                            required>
                    </div>
                </div>

                <!-- Password Input -->
                <div class="animate-slide-in">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400 dark:text-gray-500"></i>
                        </div>
                        <input type="password" id="password" name="password" placeholder="Masukkan password Anda"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-bangala dark:focus:ring-goldspel focus:border-bangala dark:focus:border-goldspel transition-all duration-300"
                            required>
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember"
                            class="h-4 w-4 text-bangala border-gray-300 dark:border-gray-600 rounded focus:ring-bangala dark:focus:ring-goldspel focus:ring-2 bg-white dark:bg-gray-700">
                        <label for="remember" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                            Ingat saya
                        </label>
                    </div>
                    <a href="#"
                        class="text-sm text-bangala dark:text-goldspel hover:text-goldspel dark:hover:text-bangala transition-colors duration-300 font-medium">
                        Lupa Password?
                    </a>
                </div>

                <!-- Login Button -->
                <button type="submit"
                    class="w-full bg-bangala hover:bg-goldspel dark:bg-goldspel dark:hover:bg-bangala py-3 px-4 text-white font-semibold rounded-lg flex items-center justify-center space-x-2 transition-all duration-300 hover-shadow-bangala transform hover:-translate-y-1">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Masuk</span>
                </button>
            </form>

            <!-- Divider -->
            <div class="mt-8 relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">atau</span>
                </div>
            </div>

            <!-- Footer -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Belum punya akun?
                    <a href="#"
                        class="text-bangala dark:text-goldspel hover:text-goldspel dark:hover:text-bangala font-medium transition-colors duration-300">
                        Hubungi Administrator
                    </a>
                </p>
            </div>
        </div>

        <!-- Copyright -->
        <div class="text-center mt-6">
            <p class="text-gray-600 dark:text-gray-400 text-sm">
                © 2025 SIRAGU - Sistem Informasi Rapor Guru
            </p>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script>
        $(document).ready(function() {

            console.log('ready')

            $(document).on('submit', '#form-login', function(e) {
                e.preventDefault();

                console.log('submit')

                const url = '{{ route('login.store') }}';

                const method = 'POST';

                const data = new FormData(this);

                const successCallback = function(response) {
                    successToast(response, '/')
                    console.log(response)
                }

                const errorCallback = function(error) {
                    errorToast(error)
                    console.log(error)
                }

                console.log(url, method, data, successCallback, errorCallback)

                ajaxCall(url, method, data, successCallback, errorCallback);

            })
        })
    </script>
</body>

</html>
