<x-admin-layout>
    <h3 class="text-white text-3xl font-medium">Dashboard Overview</h3>

    <div class="mt-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Stats Cards -->
            <div class="p-6 bg-surface rounded-xl shadow-md border border-white/5">
                <div class="flex items-center">
                    <div class="p-3 bg-primary/20 rounded-full text-primary">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-white">{{ $totalParticipants }}</h4>
                        <div class="text-gray-400">Total Participants</div>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-surface rounded-xl shadow-md border border-white/5">
                <div class="flex items-center">
                    <div class="p-3 bg-green-500/20 rounded-full text-green-500">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-white">Rp
                            {{ number_format($totalTransactions / 1000000, 1) }}M</h4>
                        <div class="text-gray-400">Total Revenue</div>
                    </div>
                </div>
            </div>
            <div class="p-6 bg-surface rounded-xl shadow-md border border-white/5">
                <div class="flex items-center">
                    <div class="p-3 bg-secondary/20 rounded-full text-secondary">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-white">{{ $activePackages }}</h4>
                        <div class="text-gray-400">Active Packages</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8">
        <h4 class="text-white text-xl font-medium mb-4">Newest Participants</h4>
        <div class="bg-surface shadow-md rounded-xl overflow-hidden border border-white/5">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 border-b border-white/10 bg-dark-lighter text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                            Name
                        </th>
                        <th
                            class="px-5 py-3 border-b border-white/10 bg-dark-lighter text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                            Status
                        </th>
                        <th
                            class="px-5 py-3 border-b border-white/10 bg-dark-lighter text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                            Registered
                        </th>
                        <th
                            class="px-5 py-3 border-b border-white/10 bg-dark-lighter text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentParticipants as $participant)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-5 py-5 border-b border-white/10 bg-surface text-sm">
                                <div class="flex items-center">
                                    <div class="ml-3">
                                        <p class="text-white whitespace-no-wrap">
                                            {{ $participant->name }}
                                        </p>
                                        <p class="text-gray-500 text-xs">{{ $participant->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-5 border-b border-white/10 bg-surface text-sm">
                                <span class="relative inline-block px-3 py-1 font-semibold text-white leading-tight">
                                    <span aria-hidden class="absolute inset-0 bg-primary/20 rounded-full"></span>
                                    <span class="relative text-xs">{{ $participant->status }}</span>
                                </span>
                            </td>
                            <td class="px-5 py-5 border-b border-white/10 bg-surface text-sm">
                                <p class="text-gray-400 whitespace-no-wrap">{{ $participant->created_at->diffForHumans() }}
                                </p>
                            </td>
                            <td class="px-5 py-5 border-b border-white/10 bg-surface text-sm">
                                <a href="{{ route('admin.participants.show', $participant->id) }}"
                                    class="text-secondary hover:text-white">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>