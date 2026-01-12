<x-app-layout>
    <div class="min-h-screen flex items-center justify-center p-4 py-24">
        <div class="max-w-6xl w-full bg-surface rounded-3xl shadow-2xl overflow-hidden flex border border-white/5">

            <!-- Left Side: Branding & Info (Hidden on mobile) -->
            <div class="hidden lg:flex w-5/12 bg-dark-lighter relative p-12 flex-col justify-between overflow-hidden">
                <div class="relative z-10">
                    <h2 class="text-3xl font-bold font-display text-white mb-4">Bergabunglah dengan Para Elite</h2>
                    <p class="text-gray-400 leading-relaxed">
                        Anda tinggal satu langkah lagi untuk mengubah karir Anda. Bergabunglah dengan ratusan developer
                        yang telah meningkatkan skill mereka bersama kami.
                    </p>
                </div>

                <div class="relative z-10">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="flex -space-x-2">
                            <!-- Dummy Avatars -->
                            <div class="w-10 h-10 rounded-full border-2 border-dark-lighter bg-gray-600"></div>
                            <div class="w-10 h-10 rounded-full border-2 border-dark-lighter bg-gray-500"></div>
                            <div class="w-10 h-10 rounded-full border-2 border-dark-lighter bg-gray-400"></div>
                        </div>
                        <span class="text-sm text-gray-400 font-medium">+500 Siswa</span>
                    </div>
                    <div class="bg-white/5 backdrop-blur-md p-6 rounded-2xl border border-white/10">
                        <div class="flex text-yellow-500 mb-3">★★★★★</div>
                        <p class="text-gray-300 italic text-sm">"Investasi terbaik untuk karir saya. Pendekatan berbasis
                            proyek adalah apa yang saya butuhkan."</p>
                        <p class="text-white text-xs font-bold mt-4 uppercase tracking-wider">Ahmad, Alumni Batch 3</p>
                    </div>
                </div>

                <!-- Abstract Decorations -->
                <div class="absolute top-0 right-0 -m-20 w-80 h-80 bg-primary/20 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -m-20 w-80 h-80 bg-secondary/20 rounded-full blur-3xl"></div>
            </div>

            <!-- Right Side: Form -->
            <div class="w-full lg:w-7/12 p-8 md:p-12 bg-surface" x-data="{ 
                status: '{{ old('status', 'Umum') }}',
                package: '{{ request()->query('package', old('bootcamp_package_id')) }}'
            }">
                <div class="mb-8">
                    <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">Buat Akun</h2>
                    <p class="text-gray-400">Daftar untuk mengikuti batch bootcamp mendatang.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 bg-red-500/10 border border-red-500/20 text-red-400 p-4 rounded-xl text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register.store') }}" class="space-y-6">
                    @csrf

                    <!-- Personal Info -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-white border-b border-white/10 pb-2">Informasi Pribadi
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="w-full bg-dark-lighter border border-white/10 rounded-lg px-4 py-2.5 text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                    placeholder="John Doe" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1">Alamat Email</label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="w-full bg-dark-lighter border border-white/10 rounded-lg px-4 py-2.5 text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                    placeholder="john@example.com" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1">Nomor WhatsApp</label>
                                <input type="text" name="whatsapp" value="{{ old('whatsapp') }}"
                                    class="w-full bg-dark-lighter border border-white/10 rounded-lg px-4 py-2.5 text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                    placeholder="0812..." required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1">Jenis Kelamin</label>
                                <select name="gender"
                                    class="w-full bg-dark-lighter border border-white/10 rounded-lg px-4 py-2.5 text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1">Tanggal Lahir</label>
                                <input type="date" name="birth_date" value="{{ old('birth_date') }}"
                                    class="w-full bg-dark-lighter border border-white/10 rounded-lg px-4 py-2.5 text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                    required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1">Status</label>
                                <select name="status" x-model="status"
                                    class="w-full bg-dark-lighter border border-white/10 rounded-lg px-4 py-2.5 text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                                    <option value="Umum">Umum</option>
                                    <option value="SMA">Siswa SMA/SMK</option>
                                    <option value="Mahasiswa">Mahasiswa</option>
                                    <option value="Pekerja">Pekerja</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic Fields based on Status -->
                    <div class="space-y-4 pt-2">

                        <!-- SMA Fields -->
                        <div x-show="status === 'SMA'" x-transition
                            class="bg-dark-lighter/50 p-4 rounded-xl border border-white/5 space-y-4">
                            <h4 class="text-sm font-bold text-primary uppercase tracking-wide">Detail Sekolah</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <input type="text" name="school" placeholder="Nama Sekolah"
                                    class="col-span-1 md:col-span-1 bg-surface border border-white/10 rounded-lg px-4 py-2 text-white text-sm focus:ring-primary">
                                <input type="text" name="school_class" placeholder="Kelas (cth. XII RPL)"
                                    class="col-span-1 md:col-span-1 bg-surface border border-white/10 rounded-lg px-4 py-2 text-white text-sm focus:ring-primary">
                                <input type="text" name="major" placeholder="Jurusan"
                                    class="col-span-1 md:col-span-1 bg-surface border border-white/10 rounded-lg px-4 py-2 text-white text-sm focus:ring-primary">
                            </div>
                        </div>

                        <!-- Mahasiswa Fields -->
                        <div x-show="status === 'Mahasiswa'" x-transition
                            class="bg-dark-lighter/50 p-4 rounded-xl border border-white/5 space-y-4">
                            <h4 class="text-sm font-bold text-secondary uppercase tracking-wide">Detail Kampus</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <input type="text" name="campus" placeholder="Universitas / Kampus"
                                    class="col-span-1 bg-surface border border-white/10 rounded-lg px-4 py-2 text-white text-sm focus:ring-primary">
                                <input type="text" name="study_program" placeholder="Program Studi"
                                    class="col-span-1 bg-surface border border-white/10 rounded-lg px-4 py-2 text-white text-sm focus:ring-primary">
                                <input type="text" name="semester" placeholder="Semester"
                                    class="col-span-1 bg-surface border border-white/10 rounded-lg px-4 py-2 text-white text-sm focus:ring-primary">
                            </div>
                        </div>

                        <!-- Pekerja Fields -->
                        <div x-show="status === 'Pekerja'" x-transition
                            class="bg-dark-lighter/50 p-4 rounded-xl border border-white/5 space-y-4">
                            <h4 class="text-sm font-bold text-blue-400 uppercase tracking-wide">Detail Pekerjaan</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="text" name="occupation" placeholder="Posisi / Jabatan"
                                    class="bg-surface border border-white/10 rounded-lg px-4 py-2 text-white text-sm focus:ring-primary">
                                <input type="text" name="company" placeholder="Nama Perusahaan"
                                    class="bg-surface border border-white/10 rounded-lg px-4 py-2 text-white text-sm focus:ring-primary">
                            </div>
                        </div>

                    </div>

                    <!-- Address -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-white border-b border-white/10 pb-2">Lokasi</h3>
                        <div class="grid grid-cols-1 gap-4">
                            <textarea name="address" rows="2"
                                class="w-full bg-dark-lighter border border-white/10 rounded-lg px-4 py-2.5 text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                placeholder="Alamat Lengkap" required>{{ old('address') }}</textarea>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <input type="text" name="city" value="{{ old('city') }}" placeholder="Kota"
                                class="bg-dark-lighter border border-white/10 rounded-lg px-4 py-2.5 text-white focus:ring-primary"
                                required>
                            <input type="text" name="province" value="{{ old('province') }}" placeholder="Provinsi"
                                class="bg-dark-lighter border border-white/10 rounded-lg px-4 py-2.5 text-white focus:ring-primary"
                                required>
                            <input type="text" name="postal_code" value="{{ old('postal_code') }}"
                                placeholder="Kode Pos"
                                class="col-span-2 md:col-span-1 bg-dark-lighter border border-white/10 rounded-lg px-4 py-2.5 text-white focus:ring-primary"
                                required>
                        </div>
                    </div>

                    <!-- Bootcamp Options -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-white border-b border-white/10 pb-2">Detail Bootcamp
                            Details</h3>
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Pilih Paket</label>
                            <select name="bootcamp_package_id" x-model="package"
                                class="w-full bg-dark-lighter border border-white/10 rounded-lg px-4 py-2.5 text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                required>
                                <option value="" disabled>-- Pilih Paket --</option>
                                @foreach($packages as $pkg)
                                    <option value="{{ $pkg->id }}"
                                        :selected="package == '{{ $pkg->slug }}' || package == '{{ $pkg->id }}'">
                                        {{ $pkg->name }} - Rp {{ number_format($pkg->price, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-1">Pengalaman Coding</label>
                            <textarea name="programming_experience" rows="3"
                                class="w-full bg-dark-lighter border border-white/10 rounded-lg px-4 py-2.5 text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                placeholder="Ceritakan singkat pengalaman coding Anda..."
                                required>{{ old('programming_experience') }}</textarea>
                        </div>
                    </div>

                    <!-- Account Security -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-white border-b border-white/10 pb-2">Keamanan Akun</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1">Password</label>
                                <input type="password" name="password"
                                    class="w-full bg-dark-lighter border border-white/10 rounded-lg px-4 py-2.5 text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                    required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation"
                                    class="w-full bg-dark-lighter border border-white/10 rounded-lg px-4 py-2.5 text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-primary to-secondary hover:from-primary-hover hover:to-pink-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-primary/20 transform transition hover:scale-[1.02] active:scale-95">
                            Daftar & Lanjut Pembayaran
                        </button>
                    </div>

                    <p class="text-center text-gray-500 text-sm">
                        Sudah punya akun? <a href="{{ route('login') }}"
                            class="text-primary hover:text-white transition">Login di sini</a>
                    </p>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>