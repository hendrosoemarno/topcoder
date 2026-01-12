<x-app-layout>
    <div class="min-h-screen flex items-center justify-center p-4">
        <div
            class="max-w-md w-full bg-surface rounded-3xl shadow-2xl overflow-hidden border border-white/5 p-8 md:p-12">

            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-white mb-2">Selamat Datang Kembali</h2>
                <p class="text-gray-400">Masuk untuk melihat dashboard bootcamp Anda.</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 bg-red-500/10 border border-red-500/20 text-red-400 p-4 rounded-xl text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full bg-dark-lighter border border-white/10 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                        placeholder="nama@email.com" required autofocus>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Password</label>
                    <input type="password" name="password"
                        class="w-full bg-dark-lighter border border-white/10 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                        placeholder="••••••••" required>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember"
                            class="rounded bg-dark-lighter border-white/10 text-primary focus:ring-primary">
                        <span class="ml-2 text-sm text-gray-400">Ingat Saya</span>
                    </label>
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-primary to-secondary hover:from-primary-hover hover:to-pink-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-primary/20 transform transition hover:scale-[1.02] active:scale-95">
                    Masuk Sekarang
                </button>

                <p class="text-center text-gray-500 text-sm mt-8">
                    Belum punya akun? <a href="{{ route('register') }}"
                        class="text-primary hover:text-white transition">Daftar sekarang</a>
                </p>

            </form>
        </div>
    </div>
</x-app-layout>