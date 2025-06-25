@extends('layouts.admin')
@section('title', 'Login')
@section('description', 'Login Pengguna')
@section('content')
    <!-- Header Section -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-md mb-6">

        <div class="form-section bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4 mb-6">
            <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-4">Login</h4>
            <form id="form-login">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                        <input type="email" id="email" name="email"
                            class="w-full px-4 py-2 bg-white dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala border border-gray-200 dark:border-gray-600">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
                        <input type="password" id="password" name="password"
                            class="w-full px-4 py-2 bg-white dark:bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-bangala border border-gray-200 dark:border-gray-600">
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="w-full px-4 py-2 bg-bangala hover:bg-bangala-dark text-white rounded-lg">
                        Masuk
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
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
                    successToast(response, '{{ route('dashboard.index') }}')
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
@endpush
