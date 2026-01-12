<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <a href="{{ route('dashboard') }}"
                    class="text-primary hover:text-white transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>

            <div class="bg-surface rounded-3xl border border-white/5 overflow-hidden shadow-2xl">
                <div class="p-8 border-b border-white/5 bg-white/5">
                    <h1 class="text-2xl font-bold text-white mb-2">Pilih Metode Pembayaran</h1>
                    <p class="text-gray-400">Total Tagihan: <span class="text-white font-bold">Rp
                            {{ number_format($transaction->amount, 0, ',', '.') }}</span></p>
                </div>

                @if(session('error'))
                    <div class="p-4 bg-red-500/10 border-b border-red-500/20 text-red-400 text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="p-8">
                    @if(empty($methods))
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="text-gray-400">Maaf, tidak ada metode pembayaran yang tersedia saat ini.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 gap-4">
                            @foreach($methods as $method)
                                <a href="{{ route('pay', ['transaction' => $transaction->id, 'method' => $method['paymentMethod']]) }}"
                                    class="flex items-center justify-between p-5 rounded-2xl bg-dark-lighter border border-white/5 hover:border-primary/50 hover:bg-white/5 transition-all group">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-16 h-10 bg-white rounded-lg flex items-center justify-center p-2 overflow-hidden">
                                            <img src="{{ $method['paymentImage'] }}" alt="{{ $method['paymentName'] }}"
                                                class="max-h-full max-w-full object-contain">
                                        </div>
                                        <div>
                                            <h4 class="text-white font-bold group-hover:text-primary transition">
                                                {{ $method['paymentName'] }}</h4>
                                            <p class="text-xs text-gray-500">Biaya: Rp
                                                {{ number_format($method['totalFee'], 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-600 group-hover:text-primary transition-transform group-hover:translate-x-1"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-8 text-center">
                <p class="text-sm text-gray-500">Pembayaran diproses dengan aman oleh <span
                        class="font-bold">Duitku</span></p>
            </div>
        </div>
    </div>
</x-app-layout>