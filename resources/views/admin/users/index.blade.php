<x-admin-layout>
    <div class="flex justify-between items-center mb-6 max-w-7xl mx-auto">
        <h3 class="text-white text-3xl font-medium">Admin Users</h3>
        <a href="{{ route('admin.users.create') }}"
            class="bg-primary hover:bg-primary-hover text-white px-4 py-2 rounded-lg font-medium transition">
            + New Admin
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/20 text-green-500 px-4 py-3 rounded-xl mb-6 max-w-7xl mx-auto">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-500/10 border border-red-500/20 text-red-500 px-4 py-3 rounded-xl mb-6 max-w-7xl mx-auto">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-surface shadow-md rounded-xl overflow-hidden border border-white/5 max-w-7xl mx-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 border-b border-white/10 bg-dark-lighter text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Name</th>
                    <th
                        class="px-5 py-3 border-b border-white/10 bg-dark-lighter text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Email</th>
                    <th
                        class="px-5 py-3 border-b border-white/10 bg-dark-lighter text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Created At</th>
                    <th
                        class="px-5 py-3 border-b border-white/10 bg-dark-lighter text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="hover:bg-white/5 transition">
                        <td class="px-5 py-5 border-b border-white/10 bg-surface text-sm">
                            <p class="text-white font-semibold">{{ $user->name }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-white/10 bg-surface text-sm">
                            <p class="text-gray-300">{{ $user->email }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-white/10 bg-surface text-sm text-gray-400">
                            {{ $user->created_at->format('d M Y H:i') }}
                        </td>
                        <td class="px-5 py-5 border-b border-white/10 bg-surface text-sm">
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                class="text-primary hover:text-white mr-3">Edit</a>

                            @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block"
                                    onsubmit="return confirm('Delete this admin user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-300">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4"
                            class="px-5 py-5 border-b border-white/10 bg-surface text-sm text-center text-gray-500">
                            No admin users found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 max-w-7xl mx-auto">
        {{ $users->links() }}
    </div>
</x-admin-layout>