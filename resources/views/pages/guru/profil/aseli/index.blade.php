<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/af96158b7b.js" crossorigin="anonymous"></script>
    <title>SIRAGU - Edit Profil</title>
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

        /* Mobile-specific styles */
        @media (max-width: 640px) {
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
    </style>
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 min-h-screen pb-16 font-sans">

    <!-- App Header -->
    <header
        class="bg-white dark:bg-gray-800 shadow-sm py-3 px-4 border-b border-gray-100 dark:border-gray-700 sticky top-0 z-10">
        <div class="flex justify-between items-center max-w-6xl mx-auto">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-bangala rounded-md flex items-center justify-center text-white font-bold">S</div>
                <h1 class="font-semibold text-lg">SIRAGU</h1>
            </div>
            <div class="flex items-center space-x-3">
                <button class="text-gray-500 hover:text-bangala">
                    <i class="far fa-bell"></i>
                </button>
                <div
                    class="w-8 h-8 rounded-full bg-bangala/10 flex items-center justify-center text-bangala font-medium text-sm">
                    AG
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 py-6">
        <!-- Profile Header -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-8">
            <div class="w-full sm:w-auto text-center sm:text-left">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Edit Profil</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Kelola informasi akun dan profil Anda</p>
            </div>
            <div class="w-full sm:w-auto text-center sm:text-right">
                <button onclick="saveProfile()"
                    class="bg-bangala hover:bg-bangala/90 text-white px-6 py-2.5 rounded-lg font-medium transition-all duration-200 w-full sm:w-auto focus:outline-none focus:ring-2 focus:ring-bangala focus:ring-offset-2">
                    Simpan Perubahan
                </button>
            </div>
        </div>

        <!-- Profile Edit Form -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Profile Picture & Password -->
            <div class="space-y-6">
                <!-- Profile Picture Card -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
                    <h2 class="font-semibold text-lg mb-4 text-gray-800 dark:text-white">Foto Profil</h2>

                    <div class="flex flex-col items-center">
                        <!-- Current Profile Picture -->
                        <div class="relative mb-4">
                            <img id="profile-preview"
                                src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=300&q=80"
                                alt="Profile Picture"
                                class="w-32 h-32 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600 shadow-sm">
                        </div>

                        <!-- Upload Button -->
                        <label for="profile-upload" class="cursor-pointer">
                            <input type="file" id="profile-upload" accept="image/*" class="hidden"
                                onchange="previewProfileImage(this)">
                            <span
                                class="text-bangala font-medium flex items-center gap-2 hover:text-bangala/80 transition-colors">
                                <i class="fas fa-upload"></i>
                                Unggah Foto Baru
                            </span>
                        </label>

                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 text-center">
                            Format: JPG, PNG (max. 2MB)<br>
                            Ukuran disarankan: 300x300 px
                        </p>
                    </div>
                </div>

                <!-- Password Card -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
                    <h2 class="font-semibold text-lg mb-4 text-gray-800 dark:text-white">Ubah Password</h2>

                    <div class="space-y-4">
                        <!-- Current Password -->
                        <div>
                            <label for="current-password"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Password Saat
                                Ini</label>
                            <div class="relative">
                                <input type="password" id="current-password"
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
                                <input type="password" id="new-password"
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

            <!-- Right Column - Form -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Personal Information Card -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
                    <h2 class="font-semibold text-lg mb-5 text-gray-800 dark:text-white">Informasi Pribadi</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Nama Lengkap -->
                        <div>
                            <label for="fullname"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Nama
                                Lengkap</label>
                            <input type="text" id="fullname" value="Ahmad Gunawan"
                                class="w-full px-3.5 py-2.5 border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-bangala focus:border-transparent transition-all">
                        </div>

                        <!-- NIP -->
                        <div>
                            <label for="nip"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">NIP</label>
                            <input type="text" id="nip" value="198506102008022001"
                                class="w-full px-3.5 py-2.5 border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-bangala focus:border-transparent transition-all">
                        </div>

                        <!-- Email -->
                        <div class="md:col-span-2">
                            <label for="email"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Email</label>
                            <input type="email" id="email" value="ahmad.gunawan@smpitabubakar.sch.id"
                                class="w-full px-3.5 py-2.5 border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-bangala focus:border-transparent transition-all">
                        </div>

                        <!-- Nomor HP -->
                        <div>
                            <label for="phone"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Nomor
                                HP</label>
                            <input type="tel" id="phone" value="081234567890"
                                class="w-full px-3.5 py-2.5 border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-bangala focus:border-transparent transition-all">
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
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
                        </div>
                    </div>
                </div>

                <!-- Signature Card -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
                    <h2 class="font-semibold text-lg mb-5 text-gray-800 dark:text-white">Tanda Tangan Digital</h2>

                    <!-- Existing Signature -->
                    <div id="existing-signature" class="mb-6">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Tanda tangan saat ini:</p>
                        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                            <img id="signature-preview"
                                src="https://via.placeholder.com/300x100?text=Signature+Not+Found"
                                alt="Current Signature"
                                class="max-w-full h-24 object-contain border border-gray-200 dark:border-gray-700 rounded shadow-sm">
                            <button onclick="showSignaturePad()"
                                class="text-bangala font-medium flex items-center gap-2 hover:text-bangala/80 transition-colors mt-2 sm:mt-0">
                                <i class="fas fa-edit"></i>
                                Ubah Tanda Tangan
                            </button>
                        </div>
                    </div>

                    <!-- Signature Pad (Hidden by default) -->
                    <div id="signature-pad-container" class="hidden">
                        <div class="mb-5">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">Gambar tanda tangan Anda di area
                                berikut:</p>
                            <canvas id="signature-pad"
                                class="signature-pad w-full h-40 border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800"></canvas>
                        </div>
                        <div class="flex flex-wrap gap-3">
                            <button onclick="clearSignature()"
                                class="px-4 py-2.5 border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors flex-1 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                <i class="fas fa-eraser mr-2"></i>Hapus
                            </button>
                            <button onclick="saveSignature()"
                                class="px-4 py-2.5 bg-bangala hover:bg-bangala/90 text-white rounded-lg flex-1 focus:outline-none focus:ring-2 focus:ring-bangala focus:ring-offset-2 transition-colors">
                                <i class="fas fa-save mr-2"></i>Simpan Tanda Tangan
                            </button>
                            <button onclick="cancelSignature()"
                                class="px-4 py-2.5 border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors flex-1 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bottom Navigation -->
    <nav
        class="fixed bottom-0 left-0 right-0 bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700 py-2">
        <div class="flex justify-around max-w-2xl mx-auto">
            <a href="/beranda" class="flex flex-col items-center text-gray-400 hover:text-bangala">
                <i class="fas fa-home"></i>
                <span class="text-xs mt-1">Beranda</span>
            </a>
            <a href="/statistik" class="flex flex-col items-center text-gray-400 hover:text-bangala">
                <i class="fas fa-chart-line"></i>
                <span class="text-xs mt-1">Statistik</span>
            </a>
            <a href="#" class="flex flex-col items-center text-bangala">
                <i class="fas fa-user"></i>
                <span class="text-xs mt-1">Profil</span>
            </a>
        </div>
    </nav>

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

        // Signature Pad functionality
        let signaturePad = null;

        function showSignaturePad() {
            document.getElementById('existing-signature').classList.add('hidden');
            document.getElementById('signature-pad-container').classList.remove('hidden');

            if (!signaturePad) {
                const canvas = document.getElementById('signature-pad');
                signaturePad = new SignaturePad(canvas, {
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    penColor: 'rgb(0, 0, 0)'
                });

                // Adjust canvas size
                function resizeCanvas() {
                    const ratio = Math.max(window.devicePixelRatio || 1, 1);
                    canvas.width = canvas.offsetWidth * ratio;
                    canvas.height = canvas.offsetHeight * ratio;
                    canvas.getContext("2d").scale(ratio, ratio);
                    signaturePad.clear(); // otherwise isEmpty() might return incorrect value
                }

                window.addEventListener('resize', resizeCanvas);
                resizeCanvas();
            }
        }

        function clearSignature() {
            signaturePad.clear();
        }

        function saveSignature() {
            if (signaturePad.isEmpty()) {
                alert('Silakan buat tanda tangan terlebih dahulu.');
                return;
            }

            const dataURL = signaturePad.toDataURL();
            document.getElementById('signature-preview').src = dataURL;
            document.getElementById('existing-signature').classList.remove('hidden');
            document.getElementById('signature-pad-container').classList.add('hidden');

            // Here you would typically send the dataURL to your server
            console.log('Signature saved:', dataURL);
        }

        function cancelSignature() {
            document.getElementById('existing-signature').classList.remove('hidden');
            document.getElementById('signature-pad-container').classList.add('hidden');
        }

        // Save profile
        function saveProfile() {
            // Here you would typically collect all form data and send to server
            alert('Perubahan berhasil disimpan!');
        }
    </script>

    <!-- Include SignaturePad library -->
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
</body>

</html>
