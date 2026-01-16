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
                        <li>
                            <a href="https://www.instagram.com/topcoder.id/" target="_blank"
                                class="hover:text-primary transition flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.151945-.07 4.849-.07zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                                @topcoder.id
                            </a>
                        </li>
                        <li>
                            <a href="https://wa.me/6282221734040" target="_blank"
                                class="hover:text-primary transition flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.412 0 6.556-5.338 11.892-11.893 11.892-1.997-.001-3.951-.5-5.688-1.448l-6.309 1.656zm6.29-4.139l.363.216c1.552.922 3.33 1.409 5.14 1.41h.001c5.454 0 9.893-4.438 9.893-9.891 0-2.641-1.029-5.123-2.895-6.99s-4.35-2.896-6.993-2.897c-5.451 0-9.89 4.438-9.89 9.891 0 1.914.537 3.774 1.553 5.385l.237.375-1.11 4.056 4.156-1.091zm8.846-5.421c-.301-.15-1.777-.878-2.053-.977-.275-.1-.476-.151-.676.15-.2.301-.776.977-.951 1.176-.176.201-.351.226-.653.076-.301-.15-1.272-.469-2.422-1.495-.895-.798-1.499-1.784-1.674-2.085-.176-.301-.019-.463.132-.612.135-.133.301-.351.451-.526.15-.176.201-.301.301-.502.1-.201.05-.376-.025-.526-.075-.15-.676-1.629-.926-2.232-.244-.588-.493-.508-.676-.517-.174-.01-.373-.012-.573-.012-.2 0-.526.075-.802.376-.275.301-1.052 1.028-1.052 2.508 0 1.48 1.077 2.91 1.227 3.111.15.201 2.12 3.237 5.136 4.537.717.309 1.277.495 1.714.634.721.229 1.376.196 1.894.12.576-.085 1.777-.726 2.028-1.43.25-.702.25-1.303.175-1.43-.075-.126-.275-.201-.576-.351z" />
                                </svg>
                                +62 8222 173 4040
                            </a>
                        </li>
                        <li>Malang, Indonesia</li>
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