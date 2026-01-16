<x-admin-layout>
    <div class="mb-6 max-w-3xl mx-auto">
        <a href="{{ route('admin.participants.index') }}"
            class="text-primary hover:text-white transition flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Participants
        </a>
    </div>

    <div class="bg-surface shadow-md rounded-2xl overflow-hidden border border-white/5 max-w-3xl mx-auto">
        <div class="p-8 border-b border-white/5 bg-white/5 flex justify-between items-center">
            <div>
                <h3 class="text-white text-2xl font-bold">Edit Participant</h3>
                <p class="text-gray-400 text-sm">Update participant profile information.</p>
            </div>
        </div>

        <form action="{{ route('admin.participants.update', $participant->id) }}" method="POST" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            <!-- Personal Info -->
            <div class="space-y-4">
                <h4 class="text-sm font-bold text-primary uppercase tracking-wide border-b border-white/10 pb-2">
                    Personal Info</h4>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-bold text-gray-300">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $participant->name) }}" required
                            class="w-full bg-dark border border-white/10 rounded-xl px-4 py-3 text-white focus:border-primary focus:ring-1 focus:ring-primary transition shadow-inner">
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-bold text-gray-300">Email</label>
                        <input type="email" name="email" value="{{ old('email', $participant->email) }}" required
                            class="w-full bg-dark border border-white/10 rounded-xl px-4 py-3 text-white focus:border-primary focus:ring-1 focus:ring-primary transition shadow-inner">
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="whatsapp" class="block text-sm font-bold text-gray-300">WhatsApp</label>
                        <input type="text" name="whatsapp" value="{{ old('whatsapp', $participant->whatsapp) }}"
                            required
                            class="w-full bg-dark border border-white/10 rounded-xl px-4 py-3 text-white focus:border-primary focus:ring-1 focus:ring-primary transition shadow-inner">
                        @error('whatsapp') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="status" class="block text-sm font-bold text-gray-300">Status</label>
                        <select name="status"
                            class="w-full bg-dark border border-white/10 rounded-xl px-4 py-3 text-white focus:border-primary focus:ring-1 focus:ring-primary">
                            <option value="Umum" {{ $participant->status == 'Umum' ? 'selected' : '' }}>Umum</option>
                            <option value="SMA" {{ $participant->status == 'SMA' ? 'selected' : '' }}>SMA</option>
                            <option value="Mahasiswa" {{ $participant->status == 'Mahasiswa' ? 'selected' : '' }}>
                                Mahasiswa</option>
                            <option value="Pekerja" {{ $participant->status == 'Pekerja' ? 'selected' : '' }}>Pekerja
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Address Info -->
            <div class="space-y-4">
                <h4 class="text-sm font-bold text-secondary uppercase tracking-wide border-b border-white/10 pb-2">
                    Location</h4>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="col-span-2 space-y-2">
                        <label for="address" class="block text-sm font-bold text-gray-300">Full Address</label>
                        <textarea name="address" rows="2"
                            class="w-full bg-dark border border-white/10 rounded-xl px-4 py-3 text-white focus:border-primary focus:ring-1 focus:ring-primary">{{ old('address', $participant->address) }}</textarea>
                    </div>

                    <div class="space-y-2">
                        <label for="city" class="block text-sm font-bold text-gray-300">City</label>
                        <input type="text" name="city" value="{{ old('city', $participant->city) }}" required
                            class="w-full bg-dark border border-white/10 rounded-xl px-4 py-3 text-white focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>

                    <div class="space-y-2">
                        <label for="province" class="block text-sm font-bold text-gray-300">Province</label>
                        <input type="text" name="province" value="{{ old('province', $participant->province) }}"
                            required
                            class="w-full bg-dark border border-white/10 rounded-xl px-4 py-3 text-white focus:border-primary focus:ring-1 focus:ring-primary">
                    </div>
                </div>
            </div>

            <div class="pt-4 flex justify-end gap-3">
                <button type="submit"
                    class="bg-primary hover:bg-primary-hover text-white px-8 py-3 rounded-xl font-bold transition shadow-lg shadow-primary/20 transform hover:scale-[1.02]">
                    Update Participant
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>