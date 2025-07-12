@extends('layouts.guru')
@section('title', 'Penilaian Guru')
@section('description', 'Form Penilaian Kinerja Guru')
@push('styles')
    <style>
        .signature-pad {
            border: 1px dashed #ccc;
            border-radius: 8px;
            background-color: #f9fafb;
        }

        .dark .signature-pad {
            border-color: #374151;
            background-color: #1f2937;
        }

        /* Enhanced Signature Canvas Styles - Lebih lebar untuk keleluasaan menandatangani */
        .signature-canvas-container {
            max-width: 400px;
            /* Diperbesar dari 280px */
            margin: 0 auto;
        }

        .signature-canvas {
            width: 400px !important;
            /* Diperbesar dari 280px */
            height: 280px !important;
            /* Tetap proporsional, tidak terlalu tinggi */
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            background-color: #ffffff;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            cursor: crosshair;
            transition: all 0.2s ease;
            margin-bottom: 1rem;
        }

        .signature-canvas:hover {
            border-color: #3b82f6;
            box-shadow: 0 8px 25px -5px rgba(59, 130, 246, 0.1);
        }

        .dark .signature-canvas {
            border-color: #4b5563;
            background-color: #ffffff;
        }

        .dark .signature-canvas:hover {
            border-color: #6366f1;
        }

        .signature-preview {
            max-width: 200px;
            max-height: 150px;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Mobile-specific styles - Responsive untuk mobile */
        @media (max-width: 768px) {
            .signature-canvas-container {
                max-width: 350px;
                /* Sedikit lebih kecil di tablet */
            }

            .signature-canvas {
                width: 350px !important;
                height: 250px !important;
            }
        }

        @media (max-width: 640px) {
            .signature-canvas-container {
                max-width: 320px;
                /* Diperbesar dari 240px untuk mobile */
            }

            .signature-canvas {
                width: 320px !important;
                /* Diperbesar dari 240px */
                height: 240px !important;
                /* Proporsional untuk mobile */
            }

            .mobile-stack {
                flex-direction: column;
            }

            .mobile-space-y-2>*+* {
                margin-top: 0.5rem;
            }

            .mobile-full-width {
                width: 100%;
            }

            .mobile-text-center {
                text-align: center;
            }

            .mobile-flex-col {
                flex-direction: column;
            }

            .mobile-gap-2 {
                gap: 0.5rem;
            }

            .mobile-p-4 {
                padding: 1rem;
            }

            .mobile-mb-4 {
                margin-bottom: 1rem;
            }
        }

        /* Tambahan untuk perangkat sangat kecil */
        @media (max-width: 360px) {
            .signature-canvas-container {
                max-width: 280px;
            }

            .signature-canvas {
                width: 280px !important;
                height: 220px !important;
            }
        }
    </style>
@endpush
@section('content')
    <main class="max-w-6xl mx-auto px-4 py-4">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-8">
            <div class="w-full sm:w-auto text-center sm:text-left">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Edit Profil</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Kelola informasi akun dan profil Anda</p>
            </div>
        </div>

        <!-- Profile Edit Form -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Profile Picture & Password -->

            <!-- Right Column - Form -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Signature Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
                    <h2 class="font-semibold text-lg mb-6 text-gray-800 dark:text-white">Tanda Tangan Digital</h2>

                    <!-- Existing Signature -->
                    <div id="existing-signature" class="mb-6">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Tanda tangan saat ini:</p>
                        <div class="flex flex-col items-center gap-4">
                            <div class="border-2 border-gray-200 dark:border-gray-600 rounded-lg p-3 bg-white shadow-sm">
                                <img id="signature-preview"
                                    src="{{ auth()->user()->ttd ? asset('/storage' . '/' . auth()->user()->ttd) : getUiAvatar(auth()->user()->nama) }}"
                                    alt="Current Signature" class="signature-preview">
                            </div>
                            <button onclick="showSignaturePad()"
                                class="inline-flex items-center gap-2 px-4 py-2 text-bangala hover:text-bangala/80 hover:bg-bangala/5 rounded-lg transition-all duration-200 font-medium">
                                <i class="fas fa-edit text-sm"></i>
                                Ubah Tanda Tangan
                            </button>
                        </div>
                    </div>

                    <!-- Signature Pad (Hidden by default) -->
                    <div id="signature-pad-container" class="hidden">
                        <div class="text-center mb-6">
                            <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-2">Buat Tanda Tangan</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Gambar tanda tangan Anda pada area kotak di
                                bawah ini</p>
                        </div>

                        <div class="signature-canvas-container mb-6">
                            <canvas id="signature-pad" class="signature-canvas"></canvas>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <button onclick="clearSignature()"
                                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 font-medium text-gray-700 dark:text-gray-300">
                                <i class="fas fa-eraser text-sm"></i>
                                Hapus
                            </button>
                            <button onclick="saveSignature()"
                                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-bangala hover:bg-bangala/90 text-white rounded-lg font-medium transition-all duration-200 shadow-sm hover:shadow-md">
                                <i class="fas fa-save text-sm"></i>
                                Simpan Tanda Tangan
                            </button>
                            <button onclick="cancelSignature()"
                                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 font-medium text-gray-700 dark:text-gray-300">
                                <i class="fas fa-times text-sm"></i>
                                Batal
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Personal Information Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-8">
                        <h2 class="font-semibold text-lg mb-5 text-gray-800 dark:text-white">Informasi Pribadi</h2>
                        <div class="w-full sm:w-auto text-center sm:text-right">
                            <button type="submit" form="form-profile"
                                class="bg-bangala hover:bg-bangala/90 text-white px-6 py-2.5 rounded-lg font-medium transition-all duration-200 w-full sm:w-auto focus:outline-none focus:ring-2 focus:ring-bangala focus:ring-offset-2">
                                Simpan
                            </button>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <form id="form-profile">
                            <!-- Nama Lengkap -->
                            <div>
                                <label for="nama"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Nama
                                    Lengkap</label>
                                <input type="text" id="nama" value="{{ auth()->user()->nama }}" name="nama"
                                    class="w-full px-3.5 py-2.5 border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-bangala focus:border-transparent transition-all">
                            </div>

                            <!-- NIP -->
                            <div>
                                <label for="nip"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">NIP</label>
                                <input type="text" id="nip" value="{{ auth()->user()->nip }}" name="nip"
                                    class="w-full px-3.5 py-2.5 border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-bangala focus:border-transparent transition-all">
                            </div>

                            <!-- Email -->
                            <div class="md:col-span-2">
                                <label for="email"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Email</label>
                                <input type="email" id="email" value="{{ auth()->user()->email }}" name="email"
                                    class="w-full px-3.5 py-2.5 border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-bangala focus:border-transparent transition-all">
                            </div>

                            <!-- Nomor HP -->
                            <div>
                                <label for="phone"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Nomor
                                    HP</label>
                                <input type="tel" id="phone" value="{{ auth()->user()->no_hp }}" name="no_hp"
                                    class="w-full px-3.5 py-2.5 border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-bangala focus:border-transparent transition-all">
                            </div>

                            <!-- Jenis Kelamin -->
                            {{-- <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Jenis
                            Kelamin</label>
                        <div class="flex gap-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="gender" value="male" checked
                                    class="text-bangala focus:ring-bangala h-4 w-4">
                                <span class="ml-2">Laki-laki</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="gender" value="female"
                                    class="text-bangala focus:ring-bangala h-4 w-4">
                                <span class="ml-2">Perempuan</span>
                            </label>
                        </div>
                    </div> --}}
                        </form>
                    </div>
                </div>

                {{-- {{ dd(auth()->user()) }} --}}
            </div>

            <div class="space-y-6">
                <!-- Profile Picture Card -->

                <!-- Password Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-8">
                        <h2 class="font-semibold text-lg mb-4 text-gray-800 dark:text-white">Ubah Password</h2>
                        <div class="w-full sm:w-auto text-center sm:text-right">
                            <button type="submit" form="form-password"
                                class="bg-bangala hover:bg-bangala/90 text-white px-6 py-2.5 rounded-lg font-medium transition-all duration-200 w-full sm:w-auto focus:outline-none focus:ring-2 focus:ring-bangala focus:ring-offset-2">
                                Simpan
                            </button>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <form id="form-password">
                            <div>
                                <label for="current-password"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Password Saat
                                    Ini</label>
                                <div class="relative">
                                    <input type="password" id="current-password" name="password_lama"
                                        class="w-full px-3.5 py-2.5 border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-bangala focus:border-transparent transition-all">
                                    <button type="button"
                                        class="absolute right-3 top-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
                                        onclick="togglePassword('current-password')">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- New Password -->
                            <div>
                                <label for="new-password"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Password
                                    Baru</label>
                                <div class="relative">
                                    <input type="password" id="new-password" name="password_baru"
                                        class="w-full px-3.5 py-2.5 border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-bangala focus:border-transparent transition-all">
                                    <button type="button"
                                        class="absolute right-3 top-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
                                        onclick="togglePassword('new-password')">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Confirm New Password -->
                            <div>
                                <label for="confirm-password"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Konfirmasi
                                    Password Baru</label>
                                <div class="relative">
                                    <input type="password" id="confirm-password"
                                        class="w-full px-3.5 py-2.5 border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-bangala focus:border-transparent transition-all">
                                    <button type="button"
                                        class="absolute right-3 top-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
                                        onclick="togglePassword('confirm-password')">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="mt-5 text-sm text-gray-500 dark:text-gray-400">
                        <p class="font-medium mb-2">Pastikan password Anda:</p>
                        <ul class="list-disc pl-5 space-y-1">
                            <li>Minimal 8 karakter</li>
                            <li>Mengandung huruf besar dan kecil</li>
                            <li>Mengandung angka atau karakter khusus</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script>
        // Toggle password visibility
        function togglePassword(id) {
            const input = document.getElementById(id);
            const icon = input.nextElementSibling.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        // Preview profile image
        function previewProfileImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-preview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Enhanced Signature Pad Functions dengan ukuran canvas yang lebih lebar
        let signaturePad = null;

        function showSignaturePad() {
            document.getElementById('existing-signature').classList.add('hidden');
            document.getElementById('signature-pad-container').classList.remove('hidden');

            if (!signaturePad) {
                const canvas = document.getElementById('signature-pad');
                signaturePad = new SignaturePad(canvas, {
                    backgroundColor: 'rgba(255, 255, 255, 1)',
                    penColor: 'rgb(0, 0, 0)',
                    velocityFilterWeight: 0.7,
                    minWidth: 1,
                    maxWidth: 2.5,
                    throttle: 16,
                    minPointDistance: 3,
                });

                // Set canvas size dengan ukuran yang lebih lebar
                function resizeCanvas() {
                    const ratio = Math.max(window.devicePixelRatio || 1, 1);
                    let canvasWidth, canvasHeight;

                    // Responsive canvas sizing - lebih lebar untuk keleluasaan
                    if (window.innerWidth <= 360) {
                        canvasWidth = 280;
                        canvasHeight = 220;
                    } else if (window.innerWidth <= 640) {
                        canvasWidth = 320; // Diperbesar dari 240px
                        canvasHeight = 240;
                    } else if (window.innerWidth <= 768) {
                        canvasWidth = 350; // Ukuran tablet
                        canvasHeight = 250;
                    } else {
                        canvasWidth = 400; // Ukuran desktop - lebih lebar
                        canvasHeight = 280;
                    }

                    canvas.width = canvasWidth * ratio;
                    canvas.height = canvasHeight * ratio;
                    canvas.style.width = canvasWidth + 'px';
                    canvas.style.height = canvasHeight + 'px';

                    const context = canvas.getContext("2d");
                    context.scale(ratio, ratio);

                    // Clear and set white background
                    context.fillStyle = 'white';
                    context.fillRect(0, 0, canvasWidth, canvasHeight);

                    if (signaturePad) {
                        signaturePad.clear();
                    }
                }

                // Event listener untuk responsive
                window.addEventListener('resize', resizeCanvas);
                resizeCanvas();
            }
        }

        function clearSignature() {
            if (signaturePad) {
                signaturePad.clear();
            }
        }

        function saveSignature() {
            if (!signaturePad || signaturePad.isEmpty()) {
                errorToast('Silakan buat tanda tangan terlebih dahulu.');
                return;
            }

            const dataURL = signaturePad.toDataURL('image/png', 1.0);
            document.getElementById('signature-preview').src = dataURL;
            document.getElementById('existing-signature').classList.remove('hidden');
            document.getElementById('signature-pad-container').classList.add('hidden');

            // Kirim data ke server
            const url = "{{ route('guru.profile.update.ttd') }}";
            const data = {
                ttd: dataURL
            }

            const successCallback = function(res) {
                successToast(res);
            }

            const errorCallback = function(err) {
                errorToast(err);
            }

            ajaxCall(url, 'PUT', data, successCallback, errorCallback);
        }

        function cancelSignature() {
            document.getElementById('existing-signature').classList.remove('hidden');
            document.getElementById('signature-pad-container').classList.add('hidden');
        }

        function validatePasswordForm() {
            let isValid = true;

            const current = $('#current-password');
            const newPass = $('#new-password');
            const confirmPass = $('#confirm-password');

            // Clear previous errors
            $('.error-text').remove();

            if (!current.val()) {
                current.after('<p class="error-text text-red-500 text-sm mt-1">Password saat ini wajib diisi.</p>');
                isValid = false;
            }

            if (newPass.val().length < 8) {
                newPass.after('<p class="error-text text-red-500 text-sm mt-1">Password baru minimal 8 karakter.</p>');
                isValid = false;
            }

            if (confirmPass.val() !== newPass.val()) {
                confirmPass.after('<p class="error-text text-red-500 text-sm mt-1">Konfirmasi password tidak cocok.</p>');
                isValid = false;
            }

            return isValid;
        }

        $(document).ready(function() {

            function validateCurrentPassword() {
                const current = $('#current-password');
                current.next('.error-text').remove();

                if (!current.val()) {
                    current.after(
                        '<p class="error-text text-red-500 text-sm mt-1">Password saat ini wajib diisi.</p>');
                }
            }

            function validateNewPassword() {
                const newPass = $('#new-password');
                newPass.next('.error-text').remove();

                if (newPass.val().length < 8) {
                    newPass.after('<p class="error-text text-red-500 text-sm mt-1">Minimal 8 karakter.</p>');
                }
            }

            function validateConfirmPassword() {
                const newPass = $('#new-password').val();
                const confirmPass = $('#confirm-password');
                confirmPass.next('.error-text').remove();

                if (confirmPass.val() !== newPass) {
                    confirmPass.after(
                        '<p class="error-text text-red-500 text-sm mt-1">Konfirmasi tidak cocok.</p>');
                }
            }

            $('#current-password').on('input', validateCurrentPassword);
            $('#new-password').on('input', validateNewPassword);
            $('#confirm-password').on('input', validateConfirmPassword);


            $('#form-password').on('submit', function(e) {
                e.preventDefault();
                console.log('form-password disubmit');

                if (typeof validatePasswordForm === 'function' && !validatePasswordForm()) return;

                const url = '{{ route('guru.profile.update.password') }}';
                const data = new FormData(this);
                data.append('_method', 'PUT'); // Laravel expects method override

                ajaxCall(url, 'POST', data, successToast, errorToast);
            });

            $('#form-profile').on('submit', function(e) {
                e.preventDefault();

                const url = '{{ route('guru.profile.update.profile') }}';
                const data = new FormData(this);
                data.append('_method', 'PUT');

                ajaxCall(url, 'POST', data, successToast, errorToast);
            });

        });
    </script>
@endpush
