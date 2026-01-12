<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Bootcamp') }}</title>

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['Outfit', 'sans-serif'],
                        body: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: '#6366F1',
                        'primary-hover': '#4F46E5',
                        secondary: '#EC4899',
                        dark: '#0B0F19',
                        'dark-lighter': '#111827',
                        surface: '#1F2937',
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased text-gray-200 bg-dark selection:bg-primary selection:text-white">

    <!-- Gradient Background Balls -->
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-50 pointer-events-none">
        <div
            class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-primary/20 rounded-full blur-[100px] animate-pulse">
        </div>
        <div
            class="absolute bottom-[-10%] right-[-10%] w-[500px] h-[500px] bg-secondary/20 rounded-full blur-[100px] animate-pulse">
        </div>
    </div>

    <!-- Navigation -->
    <nav class="fixed w-full z-10 top-0 transition-all duration-300 backdrop-blur-md border-b border-white/10"
        x-data="{ scrolled: false }" :class="{ 'bg-dark/80': scrolled, 'bg-transparent': !scrolled }"
        @scroll.window="scrolled = (window.pageYOffset > 20)">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="text-2xl font-bold font-display tracking-tight text-white italic">
                        <span class="text-primary">Top</span>Coder
                    </a>
                </div>
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="{{ url('/') }}" class="text-gray-300 hover:text-white transition font-medium">Home</a>
                    <a href="{{ route('bootcamp.detail') }}"
                        class="text-gray-300 hover:text-white transition font-medium">Bootcamp</a>

                    @auth('participant')
                        <a href="{{ route('dashboard') }}"
                            class="text-gray-300 hover:text-white transition font-medium">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="px-4 py-2 rounded-lg border border-white/10 text-gray-400 hover:text-red-400 hover:bg-white/5 transition font-medium text-sm">
                                Keluar
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-gray-300 hover:text-white transition font-medium px-4 py-2 rounded-lg hover:bg-white/5">Login</a>
                        <a href="{{ route('register') }}"
                            class="px-6 py-2.5 rounded-full bg-gradient-to-r from-primary to-primary-hover text-white font-bold shadow-lg shadow-primary/25 hover:shadow-primary/40 transition-all transform hover:scale-105">
                            Daftar Sekarang
                        </a>
                    @endauth
                </div>
                <!-- Mobile menu button -->
                <div class="-mr-2 flex md:hidden">
                    <button type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-white/10 focus:outline-none"
                        aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="pt-20 min-h-screen">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-dark-lighter border-t border-white/10 pt-16 pb-8 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div class="col-span-1 md:col-span-2">
                    <span class="text-2xl font-bold font-display text-white mb-4 block">
                        <span class="text-primary">Laravel</span>Bootcamp
                    </span>
                    <p class="text-gray-400 max-w-sm">
                        Master Laravel framework with industry experts. Build real-world applications and kickstart your
                        career.
                    </p>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-primary transition">Home</a></li>
                        <li><a href="#packages" class="hover:text-primary transition">Packages</a></li>
                        <li><a href="#faq" class="hover:text-primary transition">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-4">Contact</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li>support@bootcamp.test</li>
                        <li>+62 812 3456 7890</li>
                        <li>Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
            <div
                class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">
                <p>&copy; {{ date('Y') }} Laravel Bootcamp. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-white transition">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>