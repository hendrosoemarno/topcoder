<x-admin-layout>
    <div class="flex justify-between items-center mb-6 max-w-7xl mx-auto">
        <h3 class="text-white text-3xl font-medium">Bootcamp Packages</h3>
        <a href="{{ route('admin.packages.create') }}"
            class="bg-primary hover:bg-primary-hover text-white px-4 py-2 rounded-lg font-medium transition">
            + New Package
        </a>
    </div>

    <div class="bg-surface shadow-md rounded-xl overflow-hidden border border-white/5 max-w-7xl mx-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 border-b border-white/10 bg-dark-lighter text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Name</th>
                    <th
                        class="px-5 py-3 border-b border-white/10 bg-dark-lighter text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Batch</th>
                    <th
                        class="px-5 py-3 border-b border-white/10 bg-dark-lighter text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Price</th>
                    <th
                        class="px-5 py-3 border-b border-white/10 bg-dark-lighter text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Status</th>
                    <th
                        class="px-5 py-3 border-b border-white/10 bg-dark-lighter text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($packages as $package)
                    <tr class="hover:bg-white/5 transition">
                        <td class="px-5 py-5 border-b border-white/10 bg-surface text-sm">
                            <p class="text-white font-semibold">{{ $package->name }}</p>
                            <p class="text-gray-500 text-xs">{{ $package->slug }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-white/10 bg-surface text-sm">
                            <p class="text-gray-300">Batch {{ $package->batch_number }}</p>
                            <p class="text-gray-500 text-xs">{{ $package->start_date?->format('d M Y') }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-white/10 bg-surface text-sm text-white">
                            Rp {{ number_format($package->price, 0, ',', '.') }}
                        </td>
                        <td class="px-5 py-5 border-b border-white/10 bg-surface text-sm">
                            <span
                                class="inline-block px-3 py-1 text-xs font-semibold leading-tight {{ $package->is_active ? 'text-green-500 bg-green-500/10' : 'text-red-500 bg-red-500/10' }} rounded-full">
                                {{ $package->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-5 py-5 border-b border-white/10 bg-surface text-sm">
                            <a href="{{ route('admin.packages.edit', $package->id) }}"
                                class="text-primary hover:text-white mr-3">Edit</a>
                            <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST"
                                class="inline-block" onsubmit="return confirm('Delete this package?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-300">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5"
                            class="px-5 py-5 border-b border-white/10 bg-surface text-sm text-center text-gray-500">
                            No packages found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>