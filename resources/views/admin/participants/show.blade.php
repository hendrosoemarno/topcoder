<x-admin-layout>
    <div class="mb-6 max-w-5xl mx-auto">
        <a href="{{ route('admin.participants.index') }}"
            class="text-gray-400 hover:text-white mb-4 inline-block">&larr; Back to List</a>
        <h3 class="text-white text-3xl font-medium">Participant Details</h3>
    </div>

    <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Left Col: Profile -->
        <div class="md:col-span-1 space-y-6">
            <div class="bg-surface rounded-xl shadow-md border border-white/5 p-6 text-center">
                <div
                    class="w-24 h-24 mx-auto rounded-full bg-primary/20 flex items-center justify-center text-primary text-4xl font-bold mb-4">
                    {{ substr($participant->name, 0, 1) }}
                </div>
                <h4 class="text-xl font-bold text-white">{{ $participant->name }}</h4>
                <p class="text-gray-400 text-sm">{{ $participant->email }}</p>
                <div class="mt-4">
                    <span
                        class="inline-block px-3 py-1 bg-white/10 rounded-full text-sm text-white">{{ $participant->status }}</span>
                </div>
            </div>

            <div class="bg-surface rounded-xl shadow-md border border-white/5 p-6">
                <h5 class="text-lg font-bold text-white mb-4 border-b border-white/10 pb-2">Contact Info</h5>
                <ul class="space-y-3 text-sm">
                    <li>
                        <span class="block text-gray-500 text-xs uppercase">WhatsApp</span>
                        <span class="text-gray-300">{{ $participant->whatsapp }}</span>
                    </li>
                    <li>
                        <span class="block text-gray-500 text-xs uppercase">Address</span>
                        <span class="text-gray-300">{{ $participant->address }}</span><br>
                        <span class="text-gray-300">{{ $participant->city }}, {{ $participant->province }}
                            {{ $participant->postal_code }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Right Col: Details & Transactions -->
        <div class="md:col-span-2 space-y-6">

            <!-- Additional Info based on Status -->
            <div class="bg-surface rounded-xl shadow-md border border-white/5 p-6">
                <h5 class="text-lg font-bold text-white mb-4 border-b border-white/10 pb-2">Background Information</h5>

                <div class="grid grid-cols-2 gap-4">
                    @if($participant->status == 'SMA')
                        <div>
                            <span class="block text-gray-500 text-xs uppercase">School</span>
                            <span class="text-white">{{ $participant->school }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-500 text-xs uppercase">Class/Major</span>
                            <span class="text-white">{{ $participant->school_class }} / {{ $participant->major }}</span>
                        </div>
                    @elseif($participant->status == 'Mahasiswa')
                        <div>
                            <span class="block text-gray-500 text-xs uppercase">University</span>
                            <span class="text-white">{{ $participant->campus }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-500 text-xs uppercase">Program</span>
                            <span class="text-white">{{ $participant->study_program }} (Sem
                                {{ $participant->semester }})</span>
                        </div>
                    @elseif($participant->status == 'Pekerja')
                        <div>
                            <span class="block text-gray-500 text-xs uppercase">Company</span>
                            <span class="text-white">{{ $participant->company }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-500 text-xs uppercase">Occupation</span>
                            <span class="text-white">{{ $participant->occupation }}</span>
                        </div>
                    @endif
                </div>

                <div class="mt-4">
                    <span class="block text-gray-500 text-xs uppercase mb-1">Programming Experience</span>
                    <p class="text-gray-300 text-sm bg-dark-lighter p-3 rounded-lg border border-white/5">
                        {{ $participant->programming_experience ?? 'None provided.' }}
                    </p>
                </div>
            </div>

            <!-- Transaction History -->
            <div class="bg-surface rounded-xl shadow-md border border-white/5 p-6">
                <h5 class="text-lg font-bold text-white mb-4 border-b border-white/10 pb-2">Transaction History</h5>

                <div class="space-y-4">
                    @forelse($participant->transactions as $transaction)
                        <div class="border border-white/10 rounded-lg p-4 bg-dark-lighter/50">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h6 class="font-bold text-white">{{ $transaction->package->name ?? 'Unknown Package' }}
                                    </h6>
                                    <p class="text-xs text-mono text-gray-500">{{ $transaction->order_id }}</p>
                                </div>
                                <span class="px-2 py-1 rounded text-xs font-bold uppercase 
                                        @if($transaction->status == 'paid') bg-green-500/20 text-green-500
                                        @elseif($transaction->status == 'pending') bg-yellow-500/20 text-yellow-500
                                        @else bg-red-500/20 text-red-500 @endif">
                                    {{ $transaction->status }}
                                </span>
                            </div>
                            <div class="flex justify-between items-end text-sm text-gray-400">
                                <span>Rp {{ number_format($transaction->amount, 0, ',', '.') }}</span>
                                <span>{{ $transaction->created_at->format('d M Y H:i') }}</span>
                            </div>

                            @if($transaction->payment_url)
                                <div class="mt-2 pt-2 border-t border-white/5 text-xs">
                                    <span class="text-gray-500">Payment URL:</span>
                                    <a href="{{ $transaction->payment_url }}" target="_blank"
                                        class="text-primary hover:underline truncate block">{{ $transaction->payment_url }}</a>
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-500 italic">No transactions found.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>