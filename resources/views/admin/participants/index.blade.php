<x-admin-layout>
    <div class="flex justify-between items-center mb-6 max-w-7xl mx-auto">
        <h3 class="text-white text-3xl font-medium">Participants Management</h3>
    </div>

    <div class="bg-surface shadow-md rounded-xl overflow-hidden border border-white/5 max-w-7xl mx-auto">
        <!-- Filters -->
        <div class="p-4 bg-dark-lighter border-b border-white/10 flex flex-col md:flex-row gap-4">
            <form action="{{ route('admin.participants.index') }}" method="GET"
                class="flex flex-col md:flex-row gap-4 w-full">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search by Name or Email..."
                    class="flex-1 bg-surface border border-white/10 text-white text-sm rounded-lg focus:ring-primary focus:border-primary block p-2.5">

                <select name="status"
                    class="bg-surface border border-white/10 text-white text-sm rounded-lg focus:ring-primary focus:border-primary block p-2.5">
                    <option value="">All Statuses</option>
                    <option value="Umum" {{ request('status') == 'Umum' ? 'selected' : '' }}>Umum</option>
                    <option value="SMA" {{ request('status') == 'SMA' ? 'selected' : '' }}>SMA</option>
                    <option value="Mahasiswa" {{ request('status') == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                    <option value="Pekerja" {{ request('status') == 'Pekerja' ? 'selected' : '' }}>Pekerja</option>
                </select>

                <button type="submit"
                    class="text-white bg-primary hover:bg-primary-hover focus:ring-4 focus:ring-primary/50 font-medium rounded-lg text-sm px-5 py-2.5">Filter</button>
            </form>
        </div>

        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 border-b border-white/10 bg-dark-lighter text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Name</th>
                    <th
                        class="px-5 py-3 border-b border-white/10 bg-dark-lighter text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Information</th>
                    <th
                        class="px-5 py-3 border-b border-white/10 bg-dark-lighter text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Status</th>
                    <th
                        class="px-5 py-3 border-b border-white/10 bg-dark-lighter text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Latest Order</th>
                    <th
                        class="px-5 py-3 border-b border-white/10 bg-dark-lighter text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($participants as $participant)
                    <tr class="hover:bg-white/5 transition">
                        <td class="px-5 py-5 border-b border-white/10 bg-surface text-sm">
                            <div class="flex items-center">
                                <div
                                    class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center text-primary font-bold mr-3">
                                    {{ substr($participant->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-white font-semibold">{{ $participant->name }}</p>
                                    <p class="text-gray-500 text-xs">{{ $participant->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-5 border-b border-white/10 bg-surface text-sm">
                            <p class="text-gray-300">{{ $participant->gender == 'L' ? 'Male' : 'Female' }}</p>
                            <p class="text-gray-500 text-xs">{{ $participant->whatsapp }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-white/10 bg-surface text-sm">
                            <span
                                class="inline-block px-3 py-1 text-xs font-semibold leading-tight text-white bg-white/10 rounded-full">
                                {{ $participant->status }}
                            </span>
                        </td>
                        <td class="px-5 py-5 border-b border-white/10 bg-surface text-sm">
                            @if($participant->transactions->isNotEmpty())
                                @php $lastTx = $participant->transactions->last(); @endphp
                                <span class="block text-white">{{ $lastTx->package->name ?? 'Unknown Package' }}</span>
                                <span
                                    class="text-xs {{ $lastTx->status == 'paid' ? 'text-green-400' : ($lastTx->status == 'pending' ? 'text-yellow-400' : 'text-red-400') }}">
                                    {{ ucfirst($lastTx->status) }}
                                </span>
                            @else
                                <span class="text-gray-500 italic">No orders</span>
                            @endif
                        </td>
                        <td class="px-5 py-5 border-b border-white/10 bg-surface text-sm">
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('admin.participants.show', $participant->id) }}"
                                    class="text-blue-400 hover:text-blue-300 transition" title="View">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                <a href="{{ route('admin.participants.edit', $participant->id) }}"
                                    class="text-yellow-400 hover:text-yellow-300 transition" title="Edit">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.participants.destroy', $participant->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure? This will delete all participant data.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300 transition pt-1"
                                        title="Delete">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5"
                            class="px-5 py-5 border-b border-white/10 bg-surface text-sm text-center text-gray-500">
                            No participants found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-5 bg-surface border-t border-white/10">
            {{ $participants->links() }}
        </div>
    </div>
</x-admin-layout>