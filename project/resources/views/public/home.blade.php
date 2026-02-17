<x-public-layout>
    <x-slot name="title">Beranda</x-slot>

    {{-- Hero Section (Zen/Minimalist) --}}
    <section class="relative min-h-[85vh] flex items-center justify-center overflow-hidden">
        {{-- Content --}}
        <div class="relative z-10 text-center px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
            {{-- Badge --}}
            <div class="animate-fade-in-up opacity-0" style="animation-delay: 0.1s;">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-600 border border-emerald-500/20 backdrop-blur-sm mb-6 dark:bg-emerald-500/20 dark:text-emerald-400">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 mr-2 animate-pulse"></span>
                    {{ site_setting('site_name', 'Masjid Bukit Palma') }}
                </span>
            </div>

            {{-- Headline --}}
            <h1 class="font-display font-bold text-5xl md:text-7xl lg:text-8xl tracking-tight mb-8 animate-fade-in-up opacity-0 text-gray-900 dark:text-white" style="animation-delay: 0.3s;">
                Generasi <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 to-teal-500">Muda</span>
                <br />
                <span class="text-gray-900 dark:text-white">Yang Berdaya</span>
            </h1>

            {{-- Description --}}
            <p class="max-w-2xl mx-auto text-lg md:text-xl text-gray-600 dark:text-gray-400 mb-10 leading-relaxed animate-fade-in-up opacity-0" style="animation-delay: 0.5s;">
                {{ site_setting('site_tagline', 'Membangun sinergi, kreativitas, dan spiritualitas dalam satu wadah modern.') }}
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 animate-fade-in-up opacity-0" style="animation-delay: 0.7s;">
                <a href="#bento-grid" class="group relative px-8 py-4 bg-emerald-600 hover:bg-emerald-500 text-white font-semibold rounded-2xl transition-all duration-300 shadow-[0_10px_20px_rgba(16,185,129,0.2)] hover:shadow-[0_15px_30px_rgba(16,185,129,0.3)]">
                    Jelajahi
                    <span class="absolute inset-0 rounded-2xl ring-2 ring-white/20 group-hover:ring-white/40 transition-all"></span>
                </a>
                <a href="/profil/sejarah" class="group px-8 py-4 bg-white/50 hover:bg-white/80 text-gray-900 dark:text-white dark:bg-white/5 dark:hover:bg-white/10 font-semibold rounded-2xl backdrop-blur-sm border border-gray-200 dark:border-white/10 transition-all duration-300">
                    Tentang Kami
                </a>
            </div>
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2"
             x-data="{ show: true }"
             @scroll.window="show = window.scrollY < 50"
             x-show="show"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <a href="#bento-grid" class="flex flex-col items-center gap-2 text-gray-400 hover:text-emerald-500 transition duration-300 animate-bounce">
                <span class="text-xs font-medium tracking-widest uppercase opacity-70"></span>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7-7-7"/></svg>
            </a>
        </div>
    </section>

    {{-- Bento Grid Section --}}
    <section id="bento-grid" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">

            {{-- 1. Jadwal Sholat (Compact & Glowing) --}}
            @if($prayerTime)
            <div class="md:col-span-1 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-3xl p-6 border border-gray-200/50 dark:border-white/10 shadow-lg hover:shadow-emerald-500/10 transition-all duration-300 group reveal-on-scroll">
                <div class="flex items-center justify-between mb-4">
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </span>
                    <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 dark:bg-emerald-900/20 px-2 py-1 rounded-lg animate-pulse">Live</span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-1">Jadwal Sholat</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">{{ now()->translatedFormat('l, d F Y') }}</p>

                <div class="space-y-3">
                    @php
                        $prayers = [
                            'Subuh' => $prayerTime->subuh,
                            'Dzuhur' => $prayerTime->dzuhur,
                            'Ashar' => $prayerTime->ashar,
                            'Maghrib' => $prayerTime->maghrib,
                            'Isya' => $prayerTime->isya,
                        ];
                    @endphp
                    @foreach($prayers as $name => $time)
                    <div class="flex justify-between items-center p-2 rounded-lg {{ $nextPrayer && $nextPrayer['name'] === $name ? 'bg-gradient-to-r from-emerald-500 to-teal-500 text-white shadow-md transform scale-105' : 'hover:bg-gray-50 dark:hover:bg-white/5' }} transition-all">
                        <span class="text-sm font-medium {{ $nextPrayer && $nextPrayer['name'] === $name ? 'text-white' : 'text-gray-600 dark:text-gray-300' }}">{{ $name }}</span>
                        <span class="font-bold {{ $nextPrayer && $nextPrayer['name'] === $name ? 'text-white' : 'text-gray-900 dark:text-white' }}">{{ $time ? \Carbon\Carbon::createFromFormat('H:i:s', $time)->format('H:i') : '-' }}</span>
                    </div>
                    @endforeach
                </div>
                <div class="mt-6 pt-4 border-t border-gray-100 dark:border-white/10 text-center">
                    <a href="/layanan/jadwal-salat" class="text-sm text-emerald-600 hover:text-emerald-500 font-medium">Lihat Jadwal Lengkap &rarr;</a>
                </div>
            </div>
            @endif

            {{-- 2. Pengumuman (Span 2 Cols) --}}
            @if($pengumuman->isNotEmpty())
            <div class="md:col-span-2 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-3xl p-8 border border-gray-200/50 dark:border-white/10 shadow-lg relative overflow-hidden group reveal-on-scroll">
                <div class="absolute top-0 right-0 p-8 opacity-10 group-hover:opacity-20 transition-opacity">
                    <svg class="w-32 h-32 text-emerald-500" fill="currentColor" viewBox="0 0 24 24"><path d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                </div>

                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <span class="text-xs font-bold tracking-wider text-emerald-600 uppercase mb-1 block">Info Terkini</span>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Pengumuman</h3>
                        </div>
                        <a href="{{ route('public.pengumuman.index') }}" class="p-2 rounded-full bg-gray-100 dark:bg-white/5 hover:bg-emerald-500 hover:text-white transition duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>

                    <div class="space-y-4">
                        @foreach($pengumuman->take(2) as $item)
                        <a href="{{ route('public.pengumuman.show', $item) }}" class="block p-4 rounded-2xl bg-gray-50 dark:bg-white/5 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 border border-transparent hover:border-emerald-200 dark:hover:border-emerald-500/30 transition-all duration-300">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-1 line-clamp-1">{{ $item->title }}</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2">{{ strip_tags($item->content) }}</p>
                                </div>
                                <span class="text-xs font-medium text-gray-400 whitespace-nowrap ml-4">{{ $item->created_at->diffForHumans() }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            {{-- 3. Donasi (Progress Card) --}}
            @if($donationTargets->isNotEmpty())
            @php $target = $donationTargets->first(); @endphp
            <div class="md:col-span-1 bg-gradient-to-br from-emerald-600 to-teal-700 rounded-3xl p-6 text-white shadow-lg shadow-emerald-500/20 relative overflow-hidden reveal-on-scroll">
                {{-- Pattern Overlay --}}
                <div class="absolute inset-0 opacity-10">
                    <svg class="w-full h-full" viewBox="0 0 100 100" fill="none"><circle cx="100" cy="0" r="50" stroke="white" stroke-width="20" /></svg>
                </div>

                <div class="relative z-10 flex flex-col h-full justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="p-1.5 rounded-lg bg-white/20 backdrop-blur-sm"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></span>
                            <span class="text-sm font-medium text-emerald-100">Program Donasi</span>
                        </div>
                        <h3 class="text-xl font-bold mb-2 leading-tight">{{ $target->name }}</h3>
                        <p class="text-sm text-emerald-100 mb-6 line-clamp-2">{{ $target->description }}</p>
                    </div>

                    <div>
                        <div class="flex justify-between text-sm mb-2 font-medium">
                            <span>Terkumpul</span>
                            <span>{{ $target->progress_percent }}%</span>
                        </div>
                        <div class="w-full bg-black/20 rounded-full h-2 mb-4 overflow-hidden">
                            <div class="bg-white h-2 rounded-full transition-all duration-1000" style="width: {{ $target->progress_percent }}%"></div>
                        </div>
                        <a href="/keuangan/donasi" class="w-full block text-center py-3 bg-white text-emerald-700 rounded-xl font-bold hover:bg-emerald-50 transition shadow-lg">
                            Donasi Sekarang
                        </a>
                    </div>
                </div>
            </div>
            @endif

            {{-- 4. Kutipan / Quote (Span 3 on MD, 2 on LG) --}}
            @if($kutipanHikmah)
            <div class="md:col-span-2 lg:col-span-2 bg-amber-50 dark:bg-amber-900/10 rounded-3xl p-8 border border-amber-100 dark:border-amber-500/10 relative overflow-hidden reveal-on-scroll">
                <div class="absolute top-4 left-4 text-amber-200 dark:text-amber-500/20">
                    <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                </div>
                <div class="relative z-10 flex flex-col items-center text-center justify-center h-full">
                    <blockquote class="text-xl md:text-2xl font-serif text-gray-800 dark:text-gray-200 italic mb-4">
                        "{{ $kutipanHikmah->kutipan_text }}"
                    </blockquote>
                    @if($kutipanHikmah->sumber)
                    <cite class="text-amber-600 dark:text-amber-500 font-semibold not-italic">- {{ $kutipanHikmah->sumber }}</cite>
                    @endif
                </div>
            </div>
            @endif

            {{-- 5. Sambutan Ketua (Portrait Card) --}}
            @if($sambutan)
            <div class="md:col-span-1 lg:col-span-2 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-3xl p-8 border border-gray-200/50 dark:border-white/10 shadow-lg flex flex-col md:flex-row items-center gap-6 reveal-on-scroll">
                <div class="flex-shrink-0">
                    <div class="w-20 h-20 md:w-24 md:h-24 bg-gray-200 rounded-full overflow-hidden border-4 border-white dark:border-slate-800 shadow-lg">
                         {{-- Placeholder for Ketua Photo --}}
                         <svg class="w-full h-full text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </div>
                </div>
                <div>
                    <span class="text-xs font-bold tracking-wider text-emerald-600 uppercase mb-1 block">Sambutan Ketua</span>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $sambutan->title }}</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-3 mb-4">
                        {{ strip_tags($sambutan->content) }}
                    </p>
                    <a href="/profil/sejarah" class="text-emerald-600 hover:text-emerald-500 text-sm font-semibold">Baca Selengkapnya &rarr;</a>
                </div>
            </div>
            @endif

            {{-- 6. Galeri (Image Grid) --}}
            @if($galleries->isNotEmpty())
            <div class="md:col-span-3 lg:col-span-4 bg-gray-900 rounded-3xl p-8 relative overflow-hidden group reveal-on-scroll">
                 <div class="absolute inset-0 bg-cover bg-center opacity-30 transition-transform duration-700 group-hover:scale-105" style="background-image: url('{{ $galleries->first()->getFirstMediaUrl('photos', 'thumb') }}')"></div>
                 <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/80 to-transparent"></div>
                 
                 <div class="relative z-10 flex flex-col md:flex-row items-end justify-between gap-6">
                    <div>
                        <span class="inline-block px-3 py-1 bg-white/10 backdrop-blur-md rounded-full text-white text-xs font-medium border border-white/20 mb-3">Dokumentasi</span>
                        <h3 class="text-2xl md:text-3xl font-bold text-white mb-2">Galeri Kegiatan</h3>
                        <p class="text-gray-300 max-w-xl">Momen-momen kebersamaan dan kegiatan positif yang telah kami laksanakan.</p>
                    </div>
                    <a href="/artikel" class="px-6 py-3 bg-white text-gray-900 rounded-xl font-bold hover:bg-gray-100 transition">
                        Lihat Semua Foto
                    </a>
                 </div>

                 <!-- Mini Grid -->
                 <div class="grid grid-cols-4 md:grid-cols-6 gap-3 mt-8 relative z-10">
                    @foreach($galleries->take(6) as $gallery)
                    @if($gallery->hasMedia('photos'))
                    <div class="aspect-square rounded-lg overflow-hidden border border-white/10 cursor-pointer hover:border-emerald-500 transition">
                        <img src="{{ $gallery->getFirstMediaUrl('photos', 'thumb') }}" class="w-full h-full object-cover" alt="{{ $gallery->title }}">
                    </div>
                    @endif
                    @endforeach
                 </div>
            </div>
            @endif

        </div>
    </section>

</x-public-layout>
