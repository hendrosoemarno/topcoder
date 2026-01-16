<x-admin-layout>
    <div class="mb-6 max-w-3xl mx-auto">
        <a href="{{ route('admin.users.index') }}"
            class="text-primary hover:text-white transition flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to List
        </a>
    </div>

    <div class="bg-surface shadow-md rounded-2xl overflow-hidden border border-white/5 max-w-3xl mx-auto">
        <div class="p-8 border-b border-white/5 bg-white/5">
            <h3 class="text-white text-2xl font-bold">Edit Admin: {{ $user->name }}</h3>
            <p class="text-gray-400 text-sm">Update administrator details. Leave password blank to keep current
                password.</p>
        </div>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label for="name" class="block text-sm font-bold text-gray-300">Full Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                    class="w-full bg-dark border border-white/10 rounded-xl px-4 py-3 text-white focus:border-primary focus:ring-1 focus:ring-primary transition shadow-inner">
                @error('name')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="email" class="block text-sm font-bold text-gray-300">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                    class="w-full bg-dark border border-white/10 rounded-xl px-4 py-3 text-white focus:border-primary focus:ring-1 focus:ring-primary transition shadow-inner">
                @error('email')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="bg-white/5 p-6 rounded-2xl border border-white/5 space-y-6 mt-8">
                <h4 class="text-white font-bold text-sm uppercase tracking-widest opacity-50">Change Password (Optional)
                </h4>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-bold text-gray-300">New Password</label>
                        <input type="password" name="password" id="password"
                            class="w-full bg-dark border border-white/10 rounded-xl px-4 py-3 text-white focus:border-primary focus:ring-1 focus:ring-primary transition shadow-inner">
                        @error('password')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="password_confirmation" class="block text-sm font-bold text-gray-300">Confirm New
                            Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="w-full bg-dark border border-white/10 rounded-xl px-4 py-3 text-white focus:border-primary focus:ring-1 focus:ring-primary transition shadow-inner">
                    </div>
                </div>
            </div>

            <div class="pt-4 flex justify-end">
                <button type="submit"
                    class="bg-primary hover:bg-primary-hover text-white px-8 py-3 rounded-xl font-bold transition shadow-lg shadow-primary/20 transform hover:scale-[1.02]">
                    Update Admin
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>