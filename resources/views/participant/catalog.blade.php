<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-3xl font-bold text-white">Available Bootcamps</h1>
                <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-white transition">Back to
                    Dashboard</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($packages as $package)
                    <div
                        class="bg-surface rounded-2xl border border-white/5 overflow-hidden flex flex-col h-full shadow-lg hover:border-primary/50 transition-colors">
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex justify-between items-start mb-4">
                                <span
                                    class="px-3 py-1 bg-primary/10 text-primary text-xs font-bold rounded-full uppercase tracking-wide">
                                    Batch {{ $package->batch_number }}
                                </span>
                            </div>

                            <h3 class="text-xl font-bold text-white mb-2">{{ $package->name }}</h3>
                            <p class="text-gray-400 text-sm mb-6 flex-1">{{ Str::limit($package->description, 100) }}</p>

                            <div class="border-t border-white/10 pt-4 mt-auto">
                                <div class="flex justify-between items-end mb-4">
                                    <span class="text-gray-400 text-sm">Price</span>
                                    <span class="text-2xl font-bold text-white">Rp
                                        {{ number_format($package->price, 0, ',', '.') }}</span>
                                </div>
                                <div class="text-xs text-gray-500 mb-4">
                                    Start: {{ $package->start_date ? $package->start_date->format('d M Y') : 'TBA' }}
                                </div>

                                <form action="{{ route('participant.order.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="package_id" value="{{ $package->id }}">
                                    <button type="submit"
                                        class="w-full py-3 rounded-xl bg-primary hover:bg-primary-hover text-white font-bold transition shadow-lg shadow-primary/20">
                                        Join Now
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 bg-surface rounded-2xl border border-white/5">
                        <p class="text-gray-400">No active bootcamps available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>