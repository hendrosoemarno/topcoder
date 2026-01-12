<x-app-layout>
    <!-- Hero Section -->
    <section class="relative pt-20 pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h2 class="text-primary font-bold tracking-widest uppercase mb-4 animate-fade-in">TopCoder</h2>
            <h1 class="text-5xl md:text-7xl font-extrabold text-white tracking-tight leading-tight mb-8">
                Bimbingan Belajar Coding <br class="hidden md:block" />
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-primary to-secondary">untuk
                    Dewasa</span>
            </h1>

            <p class="mt-4 text-xl text-gray-400 max-w-3xl mx-auto mb-12 leading-relaxed">
                Belajar membangun aplikasi nyata dengan bantuan AI. <br class="hidden md:block" />
                Bukan sekadar belajar syntax, tapi memahami alur, logika, dan solusi digital yang benar-benar bekerja.
            </p>

            <div class="flex justify-center">
                <a href="{{ route('bootcamp.detail') }}"
                    class="px-10 py-5 rounded-full bg-gradient-to-r from-primary to-primary-hover text-white font-bold text-xl shadow-2xl shadow-primary/30 transition-all transform hover:scale-105 hover:-translate-y-1">
                    Lihat Program Bootcamp
                </a>
            </div>
        </div>

        <!-- Decorative background elements -->
        <div class="absolute top-1/4 -left-20 w-96 h-96 bg-primary/10 rounded-full blur-[120px] -z-10"></div>
        <div class="absolute bottom-1/4 -right-20 w-96 h-96 bg-secondary/10 rounded-full blur-[120px] -z-10"></div>
    </section>

    <!-- Why TopCoder -->
    <section class="py-24 bg-dark-lighter/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-8">Kenapa TopCoder Ada?</h2>
                    <p class="text-xl text-gray-400 mb-8 font-medium">Banyak orang dewasa ingin belajar coding, tetapi:
                    </p>

                    <ul class="space-y-6">
                        <li class="flex items-start">
                            <div
                                class="flex-shrink-0 w-6 h-6 rounded-full bg-red-500/20 text-red-500 flex items-center justify-center mt-1 mr-4">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                            <span class="text-lg text-gray-300">Tidak punya waktu belajar berbulan-bulan</span>
                        </li>
                        <li class="flex items-start">
                            <div
                                class="flex-shrink-0 w-6 h-6 rounded-full bg-red-500/20 text-red-500 flex items-center justify-center mt-1 mr-4">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                            <span class="text-lg text-gray-300">Tidak berlatar belakang IT</span>
                        </li>
                        <li class="flex items-start">
                            <div
                                class="flex-shrink-0 w-6 h-6 rounded-full bg-red-500/20 text-red-500 flex items-center justify-center mt-1 mr-4">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                            <span class="text-lg text-gray-300">Bingung harus mulai dari mana</span>
                        </li>
                        <li class="flex items-start">
                            <div
                                class="flex-shrink-0 w-6 h-6 rounded-full bg-red-500/20 text-red-500 flex items-center justify-center mt-1 mr-4">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                            <span class="text-lg text-gray-300">Ingin hasil yang bisa langsung dipakai</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-surface p-8 md:p-12 rounded-3xl border border-white/5 relative">
                    <div
                        class="absolute -top-6 -left-6 w-12 h-12 bg-primary rounded-xl flex items-center justify-center shadow-lg shadow-primary/30">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-6">TopCoder hadir untuk menjawab itu.</h3>
                    <p class="text-gray-400 mb-8 leading-relaxed text-lg">Kami merancang program belajar coding yang:
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="bg-dark-lighter p-4 rounded-xl border border-white/5">
                            <span class="text-primary font-bold block mb-1">Masuk akal</span>
                            <span class="text-sm text-gray-500">untuk orang dewasa</span>
                        </div>
                        <div class="bg-dark-lighter p-4 rounded-xl border border-white/5">
                            <span class="text-primary font-bold block mb-1">Fokus praktik</span>
                            <span class="text-sm text-gray-500">nyata dan terukur</span>
                        </div>
                        <div class="bg-dark-lighter p-4 rounded-xl border border-white/5">
                            <span class="text-primary font-bold block mb-1">Relevan</span>
                            <span class="text-sm text-gray-500">untuk kerja dan usaha</span>
                        </div>
                        <div class="bg-dark-lighter p-4 rounded-xl border border-white/5">
                            <span class="text-primary font-bold block mb-1">Dibantu AI</span>
                            <span class="text-sm text-gray-500">agar lebih efisien</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Approach -->
    <section class="py-24 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-white mb-4">Bukan Kursus Coding Konvensional</h2>
                <p class="text-xl text-gray-400">TopCoder tidak menuntut peserta menghafal syntax atau teori panjang.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
                <div class="bg-surface p-8 rounded-2xl border border-white/5">
                    <div class="text-primary font-bold text-4xl mb-4">01</div>
                    <h4 class="text-xl font-bold text-white mb-3">Pahami Requirement</h4>
                    <p class="text-gray-400">Belajar menganalisa apa yang dibutuhkan oleh pengguna atau bisnis.</p>
                </div>
                <div class="bg-surface p-8 rounded-2xl border border-white/5">
                    <div class="text-primary font-bold text-4xl mb-4">02</div>
                    <h4 class="text-xl font-bold text-white mb-3">Susun Alur Sistem</h4>
                    <p class="text-gray-400">Merancang logika bagaimana data mengalir dan aplikasi bekerja.</p>
                </div>
                <div class="bg-surface p-8 rounded-2xl border border-white/5">
                    <div class="text-primary font-bold text-4xl mb-4">03</div>
                    <h4 class="text-xl font-bold text-white mb-3">Gunakan AI Asisten</h4>
                    <p class="text-gray-400">Memanfaatkan AI (Cursor/ChatGPT) untuk menulis kode dengan efisien.</p>
                </div>
            </div>

            <div
                class="max-w-4xl mx-auto bg-gradient-to-r from-primary/20 to-secondary/20 p-10 rounded-3xl border border-white/10 backdrop-blur-md">
                <div class="flex flex-col md:flex-row gap-8 items-center">
                    <div class="flex-1">
                        <h4 class="text-2xl font-bold text-white mb-4">Tujuan Akhirnya:</h4>
                        <p class="text-xl text-gray-300 leading-relaxed italic">
                            "Peserta mampu membangun solusi digital, bukan sekadar menulis kode."
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- For Whom -->
    <section class="py-24 bg-dark-lighter/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-16">Untuk Siapa TopCoder?</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="p-6">
                    <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h5 class="text-lg font-bold text-white">Pemula non-IT</h5>
                </div>
                <div class="p-6">
                    <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <h5 class="text-lg font-bold text-white text-center">Halaman untuk Upgrade Skill</h5>
                </div>
                <div class="p-6">
                    <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h5 class="text-lg font-bold text-white">Pelaku Usaha</h5>
                </div>
                <div class="p-6">
                    <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <h5 class="text-lg font-bold text-white">Profesional Produk Digital</h5>
                </div>
            </div>

            <p class="mt-12 text-gray-500 italic max-w-2xl mx-auto">
                "Tidak harus jago coding. Yang penting adalah kemauan belajar dan berpikir sistematis."
            </p>
        </div>
    </section>

    <!-- Program Unggulan -->
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="bg-surface rounded-3xl border border-white/5 overflow-hidden flex flex-col lg:flex-row shadow-2xl">
                <div class="lg:w-1/2 p-8 md:p-16 flex flex-col justify-center">
                    <div
                        class="inline-block px-4 py-1.5 bg-primary/20 text-primary rounded-full text-xs font-bold tracking-widest uppercase mb-6">
                        Program Unggulan</div>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Online AI Agent Programming Bootcamp</h2>
                    <p class="text-gray-400 mb-8 text-lg leading-relaxed">
                        Program intensif untuk membangun aplikasi nyata berbasis web dengan bantuan AI, dipandu mentor
                        secara live.
                    </p>
                    <div>
                        <a href="{{ route('bootcamp.detail') }}"
                            class="inline-block px-8 py-4 bg-primary hover:bg-primary-hover text-white font-bold rounded-xl shadow-lg transition-all">
                            Lihat Detail Bootcamp
                        </a>
                    </div>
                </div>
                <div class="lg:w-1/2 bg-gradient-to-br from-primary/40 to-secondary/40 relative min-h-[300px]">
                    <!-- Use an abstract graphic or generated image -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div
                            class="w-64 h-64 bg-dark/40 rounded-3xl backdrop-blur-md border border-white/10 flex items-center justify-center p-8 text-center rotate-3 shadow-2xl">
                            <div>
                                <span class="text-white font-bold text-xl block mb-2">POS Restoran</span>
                                <span class="text-xs text-gray-400 block mb-4">QR Code Ready</span>
                                <div
                                    class="w-16 h-16 bg-primary/20 rounded-lg mx-auto flex items-center justify-center">
                                    <svg class="w-8 h-8 text-primary" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>