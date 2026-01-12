<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - Laravel Bootcamp</title>
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
</head>

<body class="bg-dark font-sans text-gray-200 antialiased min-h-screen flex flex-col justify-center items-center">

    <div class="sm:max-w-md w-full px-6 py-4 bg-surface shadow-md overflow-hidden sm:rounded-lg border border-white/10">
        <div class="mb-6 text-center">
            <h1 class="text-2xl font-bold text-white">Admin Login</h1>
            <p class="text-gray-400">Please sign in to access the panel.</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 bg-red-500/10 border border-red-500/20 text-red-500 px-4 py-2 rounded-lg text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.store') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block font-medium text-sm text-gray-300">Email</label>
                <input id="email"
                    class="block mt-1 w-full bg-dark-lighter border-white/10 rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 text-white"
                    type="email" name="email" value="{{ old('email') }}" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block font-medium text-sm text-gray-300">Password</label>
                <input id="password"
                    class="block mt-1 w-full bg-dark-lighter border-white/10 rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 text-white"
                    type="password" name="password" required />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded bg-dark-lighter border-white/10 text-primary shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit"
                    class="ml-3 px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-hover active:bg-primary-hover focus:outline-none focus:border-primary-hover focus:ring ring-primary disabled:opacity-25 transition ease-in-out duration-150">
                    Log in
                </button>
            </div>
        </form>
    </div>
</body>

</html>