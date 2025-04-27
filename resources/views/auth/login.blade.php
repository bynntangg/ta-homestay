<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="w-full max-w-4xl bg-white rounded-3xl shadow-2xl flex flex-col md:flex-row overflow-hidden">
        <!-- Left Section -->
        <div class="w-full md:w-1/2 bg-gradient-to-br from-blue-700 to-indigo-800 text-white p-12 flex flex-col justify-center">
            <div class="text-center">
                <a href="/" class="inline-flex items-center space-x-3 justify-center mb-8">
                    <i class="fas fa-home text-4xl"></i>
                    <span class="text-4xl font-bold tracking-wide">WatHome</span>
                </a>
                <h2 class="text-3xl font-semibold mb-2">Selamat Datang!</h2>
                <p class="text-lg text-indigo-100">Silakan masuk ke akun Anda dan temukan homestay terbaik.</p>
            </div>
        </div>

        <!-- Right Section (Form Login) -->
        <div class="w-full md:w-1/2 px-12 py-14">
            <h3 class="text-2xl font-semibold text-gray-800 mb-8 text-center">Masuk ke Akun Anda</h3>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="hidden" name="redirect" value="{{ $redirect ?? '' }}">

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input id="email" name="email" type="email" required autocomplete="email"
                               class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-base"
                               placeholder="email@contoh.com" value="{{ old('email') }}">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Phone -->
                <div class="mb-4">
                    <label for="no_telepon" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-phone text-gray-400"></i>
                        </div>
                        <input id="no_telepon" name="no_telepon" type="tel" autocomplete="tel"
                               class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-base"
                               placeholder="0812-3456-7890" value="{{ old('no_telepon') }}">
                    </div>
                    <x-input-error :messages="$errors->get('no_telepon')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input id="password" name="password" type="password" required autocomplete="current-password"
                               class="w-full pl-12 pr-10 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-base"
                               placeholder="••••••••">
                        <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center toggle-password">
                            <i class="fas fa-eye text-gray-400 hover:text-gray-600 cursor-pointer"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Remember & Forgot -->
                <div class="mb-6 flex justify-between items-center text-sm">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                        <span class="ml-2 text-gray-700">Ingat saya</span>
                    </label>
                    @if (Route::has('forgot-password'))
                        <a href="{{ route('forgot-password') }}" class="text-blue-600 hover:underline">Lupa password?</a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit"
                        class="w-full py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition text-lg">
                    <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                </button>
            </form>

            <!-- Register Link -->
            <div class="mt-8 text-center text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-blue-600 font-medium hover:underline">Daftar sekarang</a>
            </div>
        </div>
    </div>

    <!-- Toggle Password Script -->
    <script>
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function () {
                const input = this.parentElement.querySelector('input');
                const icon = this.querySelector('i');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.replace('fa-eye', 'fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.replace('fa-eye-slash', 'fa-eye');
                }
            });
        });
    </script>
</x-guest-layout>
