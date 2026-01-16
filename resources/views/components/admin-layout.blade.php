<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Laravel Bootcamp</title>
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

<body class="bg-dark font-sans text-gray-200 antialiased" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
            class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-surface border-r border-white/10 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
            <div class="flex items-center justify-center mt-8">
                <div class="flex items-center">
                    <span class="text-white text-2xl font-semibold font-display">Admin<span
                            class="text-primary">Panel</span></span>
                </div>
            </div>

            <nav class="mt-10 px-6 space-y-3">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-6 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-primary/10 text-primary border-r-4 border-primary' : 'text-gray-400 hover:bg-white/5 hover:text-white' }} transition-colors duration-200 transform rounded-lg">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    <span class="mx-3 font-medium">Dashboard</span>
                </a>

                <a href="{{ route('admin.participants.index') }}"
                    class="flex items-center px-6 py-3 {{ request()->routeIs('admin.participants*') ? 'bg-primary/10 text-primary border-r-4 border-primary' : 'text-gray-400 hover:bg-white/5 hover:text-white' }} transition-colors duration-200 transform rounded-lg">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span class="mx-3 font-medium">Participants</span>
                </a>

                <a href="{{ route('admin.packages.index') }}"
                    class="flex items-center px-6 py-3 {{ request()->routeIs('admin.packages*') ? 'bg-primary/10 text-primary border-r-4 border-primary' : 'text-gray-400 hover:bg-white/5 hover:text-white' }} transition-colors duration-200 transform rounded-lg">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <span class="mx-3 font-medium">Packages</span>
                </a>

                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center px-6 py-3 {{ request()->routeIs('admin.users*') ? 'bg-primary/10 text-primary border-r-4 border-primary' : 'text-gray-400 hover:bg-white/5 hover:text-white' }} transition-colors duration-200 transform rounded-lg">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span class="mx-3 font-medium">Admin Users</span>
                </a>

                <form action="{{ route('admin.logout') }}" method="POST" class="mt-10">
                    @csrf
                    <button type="submit"
                        class="flex items-center px-6 py-3 w-full text-gray-400 hover:bg-red-500/10 hover:text-red-500 transition-colors duration-200 transform rounded-lg">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span class="mx-3 font-medium">Logout</span>
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="flex justify-between items-center py-4 px-6 bg-surface border-b border-white/10">
                <div class="flex items-center">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-gray-400 focus:outline-none lg:hidden">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>

                <div class="flex items-center">
                    <div class="relative">
                        <button class="flex items-center space-x-2 relative focus:outline-none">
                            <div
                                class="w-8 h-8 rounded-full bg-primary/20 flex items-center justify-center text-primary font-bold">
                                A
                            </div>
                        </button>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-dark p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>