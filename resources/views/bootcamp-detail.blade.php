<x-app-layout>
    <!-- Hero Section -->
    <section class="relative pt-20 pb-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center">
                <div
                    class="inline-block mb-6 px-4 py-1.5 rounded-full bg-primary/10 border border-primary/20 backdrop-blur-sm">
                    <span class="text-primary font-bold text-sm tracking-wide uppercase italic">Februari 2026 -
                        TopCoder</span>
                </div>

                <h1 class="text-4xl md:text-6xl font-extrabold text-white tracking-tight leading-tight mb-8">
                    Bangun Aplikasi POS Restoran <br class="hidden md:block" />
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-primary to-secondary">Berbasis Web
                        dengan AI Agent</span>
                </h1>

                <p class="mt-4 text-xl text-gray-400 max-w-3xl mx-auto mb-10 leading-relaxed">
                    Studi kasus sistem pemesanan ala restoran modern berbasis QR Code. <br />
                    Versi MVP, siap pakai. Membuat aplikasi web restoran tanpa harus mahir coding.
                </p>

                <div class="flex justify-center mb-16">
                    <a href="{{ route('register') }}"
                        class="px-10 py-5 rounded-full bg-gradient-to-r from-primary to-primary-hover text-white font-bold text-xl shadow-2xl shadow-primary/30 transition-all transform hover:scale-105 hover:-translate-y-1">
                        Daftar Bootcamp
                    </a>
                </div>
            </div>

            <!-- Preview Graphic -->
            <div class="max-w-5xl mx-auto relative mt-8">
                <div class="bg-surface rounded-3xl border border-white/5 p-4 shadow-2xl">
                    <div
                        class="bg-dark rounded-2xl p-6 border border-white/5 aspect-video flex items-center justify-center overflow-hidden group">
                        <!-- Abstract Dashboard Mockup -->
                        <div class="w-full h-full grid grid-cols-12 gap-4">
                            <div class="col-span-3 space-y-4">
                                <div class="h-8 bg-white/5 rounded-lg w-3/4"></div>
                                <div class="h-32 bg-white/5 rounded-xl border border-white/5"></div>
                                <div class="h-32 bg-white/5 rounded-xl border border-white/5"></div>
                            </div>
                            <div class="col-span-9 space-y-4">
                                <div class="h-10 bg-primary/20 rounded-lg w-full flex items-center px-4">
                                    <div class="w-4 h-4 rounded-full bg-primary mr-2"></div>
                                    <div class="h-2 bg-primary/40 rounded w-48"></div>
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <div
                                        class="h-40 bg-white/5 rounded-2xl border border-white/5 p-4 flex flex-col justify-end">
                                        <div class="h-2 bg-white/10 rounded w-1/2 mb-2"></div>
                                        <div class="h-4 bg-white/20 rounded w-3/4"></div>
                                    </div>
                                    <div
                                        class="h-40 bg-white/5 rounded-2xl border border-white/5 p-4 flex flex-col justify-end">
                                        <div class="h-2 bg-white/10 rounded w-1/2 mb-2"></div>
                                        <div class="h-4 bg-white/20 rounded w-3/4"></div>
                                    </div>
                                    <div
                                        class="h-40 bg-white/5 rounded-2xl border border-white/5 p-4 flex flex-col justify-end">
                                        <div class="h-2 bg-white/10 rounded w-1/2 mb-2"></div>
                                        <div class="h-4 bg-white/20 rounded w-3/4"></div>
                                    </div>
                                </div>
                                <div class="h-48 bg-white/5 rounded-2xl border border-white/5"></div>
                            </div>
                        </div>
                        <!-- Hover Overlay -->
                        <div
                            class="absolute inset-0 bg-dark/60 backdrop-blur-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <div class="text-center p-8 bg-surface rounded-3xl border border-white/10 max-w-sm">
                                <div
                                    class="w-16 h-16 bg-primary/20 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-primary" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h4 class="text-white font-bold text-lg mb-2">Laravel & JavaScript SPA</h4>
                                <p class="text-gray-400 text-sm">Pelajari bagaimana membangun sistem pesan menu berbasis
                                    QR Code.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Float elements -->
                <div
                    class="absolute -bottom-10 -right-10 bg-surface border border-white/5 p-4 rounded-2xl shadow-xl hidden md:block w-48">
                    <div class="text-xs text-gray-500 mb-2 uppercase tracking-widest font-bold">Tech Stack</div>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-2 py-1 bg-primary/10 text-primary text-[10px] rounded font-bold">Laravel
                            11</span>
                        <span
                            class="px-2 py-1 bg-secondary/10 text-secondary text-[10px] rounded font-bold">Alpine.js</span>
                        <span class="px-2 py-1 bg-blue-500/10 text-blue-500 text-[10px] rounded font-bold">Tailwind
                            4</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Worth Following -->
    <section class="py-24 bg-dark-lighter/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-8 italic"><span
                            class="text-primary italic">Kenapa</span> Bootcamp Ini Layak Diikuti?</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="p-6 bg-surface rounded-2xl border border-white/5">
                            <h4 class="text-white font-bold mb-2">Peserta Dewasa</h4>
                            <p class="text-sm text-gray-400">Dirancang khusus dengan ritme yang masuk akal bagi
                                profesional.</p>
                        </div>
                        <div class="p-6 bg-surface rounded-2xl border border-white/5">
                            <h4 class="text-white font-bold mb-2">Pemula Non-IT</h4>
                            <p class="text-sm text-gray-400">Penyampaian materi tanpa istilah teknis yang memusingkan.
                            </p>
                        </div>
                        <div class="p-6 bg-surface rounded-2xl border border-white/5">
                            <h4 class="text-white font-bold mb-2">Efisiensi Waktu</h4>
                            <p class="text-sm text-gray-400">Belajar to-the-point pada bagian yang benar-benar
                                dibutuhkan.</p>
                        </div>
                        <div class="p-6 bg-surface rounded-2xl border border-white/5">
                            <h4 class="text-white font-bold mb-2">Aplikasi Nyata</h4>
                            <p class="text-sm text-gray-400">Hasil bootcamp adalah aplikasi yang siap di-deploy ke
                                produksi.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-dark p-8 rounded-3xl border border-white/5 relative group">
                    <div class="absolute inset-0 bg-primary/5 rounded-3xl group-hover:bg-primary/10 transition-colors">
                    </div>
                    <div class="relative z-10">
                        <span class="text-primary text-xs font-bold uppercase tracking-widest block mb-4">Studi
                            Kasus</span>
                        <h3 class="text-2xl font-bold text-white mb-6">Aplikasi POS Restoran</h3>
                        <p class="text-gray-400 mb-8 leading-relaxed">
                            Peserta membangun aplikasi secara utuh yang mencakup fitur:
                        </p>
                        <ul class="space-y-4">
                            <li class="flex items-center text-gray-300">
                                <svg class="w-5 h-5 text-primary mr-3" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Scan QR Code Meja
                            </li>
                            <li class="flex items-center text-gray-300">
                                <svg class="w-5 h-5 text-primary mr-3" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Pilih Menu & Keranjang (SPA)
                            </li>
                            <li class="flex items-center text-gray-300">
                                <svg class="w-5 h-5 text-primary mr-3" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Order Masuk Otomatis ke Kasir/Dapur
                            </li>
                            <li class="flex items-center text-gray-300">
                                <svg class="w-5 h-5 text-primary mr-3" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Sistem siap digunakan di restoran modern
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What You Get -->
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-white mb-16 text-center">Apa yang Akan Didapat Peserta?</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="p-8 bg-surface rounded-3xl border border-white/5">
                    <div class="text-4xl mb-6">🎥</div>
                    <h5 class="text-xl font-bold text-white mb-4">4 Sesi Live Development</h5>
                    <p class="text-gray-400">Membangun aplikasi secara bertahap dari nol hingga berjalan.</p>
                </div>
                <div class="p-8 bg-surface rounded-3xl border border-white/5">
                    <div class="text-4xl mb-6">🤝</div>
                    <h5 class="text-xl font-bold text-white mb-4">2 Sesi Mentoring Intensif</h5>
                    <p class="text-gray-400">Fokus troubleshooting dan penyempurnaan aplikasi secara live.</p>
                </div>
                <div class="p-8 bg-surface rounded-3xl border border-white/5">
                    <div class="text-4xl mb-6">🚀</div>
                    <h5 class="text-xl font-bold text-white mb-4">Aplikasi Web Siap Pakai</h5>
                    <p class="text-gray-400">Bisa digunakan, dikembangkan, dan dijadikan portofolio juara.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Investment -->
    <section class="py-24 relative overflow-hidden">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-gradient-to-br from-primary to-secondary p-[1px] rounded-[40px] shadow-2xl">
                <div class="bg-dark p-8 md:p-16 rounded-[40px] text-center">
                    <h2 class="text-3xl font-bold text-white mb-8">Investasi Bootcamp</h2>

                    <div class="flex flex-col gap-6 mb-12 items-center">
                        <div class="text-gray-500 line-through text-2xl">Rp 2.500.000</div>
                        <div class="text-5xl md:text-7xl font-black text-white">Rp 2.000.000</div>
                        <div
                            class="inline-block px-4 py-1 bg-yellow-500 text-black font-bold rounded-full text-xs uppercase animate-bounce">
                            Early Bird (Terbatas!)</div>
                    </div>

                    <p class="text-gray-400 mb-12">
                        ⏰ Berlaku hingga <span class="text-white font-bold">26 Januari 2026</span>
                    </p>

                    <a href="{{ route('register') }}"
                        class="block w-full py-5 rounded-2xl bg-white text-dark font-black text-2xl hover:bg-gray-200 transition-all transform hover:scale-[1.02] shadow-xl">
                        Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
        <!-- BG Blur -->
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-[500px] bg-primary/20 blur-[150px] -z-10 rounded-full">
        </div>
    </section>

    <!-- Closing -->
    <section class="py-24 text-center">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-xl text-gray-400 mb-8 italic">
                "TopCoder adalah tempat belajar membangun aplikasi nyata dengan bantuan AI. Jika Anda mencari program
                yang masuk akal dan fokus hasil, bootcamp ini adalah langkah yang tepat."
            </p>
            <div class="w-16 h-1 bg-primary mx-auto mb-12"></div>
            <a href="{{ route('register') }}"
                class="text-primary font-bold hover:text-white transition decoration-primary underline-offset-8 underline">
                Amankan Kursi Anda Sekarang →
            </a>
        </div>
    </section>

</x-app-layout>