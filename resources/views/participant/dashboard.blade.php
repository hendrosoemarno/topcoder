<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-white mb-8">Dashboard</h1>

            @if(session('success'))
                <div class="bg-green-500/10 border border-green-500/20 text-green-400 p-4 rounded-xl mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-500/10 border border-red-500/20 text-red-400 p-4 rounded-xl mb-6">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-500/10 border border-red-500/20 text-red-500 p-4 rounded-xl mb-6">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Profile Card -->
                <div class="md:col-span-1 bg-surface p-6 rounded-2xl border border-white/5">
                    <div class="flex items-center mb-6">
                        <div
                            class="w-16 h-16 rounded-full bg-primary/20 flex items-center justify-center text-primary text-2xl font-bold">
                            {{ substr($participant->name, 0, 1) }}
                        </div>
                        <div class="ml-4">
                            <h2 class="text-xl font-bold text-white">{{ $participant->name }}</h2>
                            <p class="text-sm text-gray-400">{{ $participant->email }}</p>
                            <span
                                class="inline-block px-2 py-0.5 mt-2 rounded bg-white/10 text-xs text-gray-300">{{ $participant->status }}</span>
                        </div>
                    </div>
                </div>

                <!-- Latest Transaction / Payment Status -->
                <div class="md:col-span-2 bg-surface p-6 rounded-2xl border border-white/5">
                    <h2 class="text-xl font-bold text-white mb-4">Current Bootcamp</h2>

                    @if($latestTransaction)
                        <div
                            class="flex flex-col md:flex-row justify-between items-start md:items-center bg-dark-lighter p-4 rounded-xl border border-white/5">
                            <div>
                                <h3 class="font-bold text-white text-lg">{{ $latestTransaction->package->name }}</h3>
                                <p class="text-sm text-gray-400">Batch: {{ $latestTransaction->package->batch_number }}</p>
                                <p class="text-sm text-gray-400 mt-1">Order ID: <span
                                        class="font-mono">{{ $latestTransaction->order_id }}</span></p>
                            </div>
                            <div class="mt-4 md:mt-0 text-right">
                                <div class="mb-2">
                                    <span class="text-2xl font-bold text-white block">Rp
                                        {{ number_format($latestTransaction->amount, 0, ',', '.') }}</span>
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider 
                                                        @if($latestTransaction->status == 'paid') bg-green-500/20 text-green-500
                                                        @elseif($latestTransaction->status == 'pending') bg-yellow-500/20 text-yellow-500
                                                        @elseif($latestTransaction->status == 'failed') bg-red-500/20 text-red-500
                                                        @else bg-gray-500/20 text-gray-500 @endif">
                                        @if($latestTransaction->status == 'paid')
                                            SUKSES
                                        @elseif($latestTransaction->status == 'pending')
                                            MENUNGGU PEMBAYARAN
                                        @elseif($latestTransaction->status == 'failed')
                                            GAGAL
                                        @else
                                            {{ strtoupper($latestTransaction->status) }}
                                        @endif
                                    </span>
                                </div>

                                @if($latestTransaction->status == 'pending')
                                    <div class="flex flex-col sm:flex-row gap-3 mt-4">
                                        <a href="{{ route('pay', $latestTransaction->id) }}"
                                            class="inline-block px-6 py-2 rounded-lg bg-primary hover:bg-primary-hover text-white font-bold transition">
                                            Bayar Sekarang
                                        </a>

                                        @if(config('app.env') == 'local')
                                            <a href="{{ route('payment.simulate', $latestTransaction->id) }}"
                                                class="inline-block px-4 py-2 rounded-lg bg-white/5 hover:bg-white/10 text-gray-400 text-sm font-medium transition border border-white/10 text-center">
                                                Simulasi Sukses (Dev Only)
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <p class="text-gray-400">You have not registered for any bootcamp yet.</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>