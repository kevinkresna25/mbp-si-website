<x-public-layout>
    <x-slot name="title">Beranda</x-slot>

    {{-- Hero Section --}}
    <section class="relative bg-gradient-to-br from-emerald-700 via-emerald-800 to-emerald-900 text-white overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 800 600" fill="none" xmlns="http://www.w3.org/2000/svg">
                <pattern id="islamic-pattern" x="0" y="0" width="100" height="100" patternUnits="userSpaceOnUse">
                    <circle cx="50" cy="50" r="40" stroke="white" stroke-width="0.5" fill="none"/>
                    <circle cx="0" cy="0" r="40" stroke="white" stroke-width="0.5" fill="none"/>
                    <circle cx="100" cy="0" r="40" stroke="white" stroke-width="0.5" fill="none"/>
                    <circle cx="0" cy="100" r="40" stroke="white" stroke-width="0.5" fill="none"/>
                    <circle cx="100" cy="100" r="40" stroke="white" stroke-width="0.5" fill="none"/>
                </pattern>
                <rect width="800" height="600" fill="url(#islamic-pattern)"/>
            </svg>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28">
            <div class="text-center">
                <div class="inline-flex items-center px-4 py-2 bg-emerald-600/50 rounded-full text-sm font-medium mb-6 backdrop-blur-sm">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93s3.05-7.44 7-7.93v15.86z"/></svg>
                    Masjid Bukit Palma - Surabaya
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                    Membangun Ukhuwah<br>
                    <span class="text-emerald-300">Melalui Transparansi Digital</span>
                </h1>
                <p class="text-lg md:text-xl text-emerald-100 max-w-2xl mx-auto mb-10">
                    Pusat informasi dan transparansi keuangan Masjid Bukit Palma, Perumahan Bukit Palma, Surabaya.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="/keuangan" class="px-8 py-3 bg-white text-emerald-700 rounded-xl font-semibold hover:bg-emerald-50 transition shadow-lg">
                        Lihat Keuangan
                    </a>
                    <a href="/profil/sejarah" class="px-8 py-3 bg-emerald-600/50 text-white rounded-xl font-semibold hover:bg-emerald-600 transition backdrop-blur-sm border border-emerald-500/50">
                        Profil Masjid
                    </a>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L0,120Z" fill="#f9fafb"/>
            </svg>
        </div>
    </section>

    {{-- Prayer Times Widget --}}
    @if($prayerTime)
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10 mb-16">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="bg-emerald-700 text-white px-6 py-4 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <h2 class="text-lg font-semibold">Jadwal Sholat Hari Ini</h2>
                </div>
                <span class="text-emerald-200 text-sm">{{ now()->translatedFormat('l, d F Y') }}</span>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 divide-x divide-gray-100">
                @php
                    $prayers = [
                        'Subuh' => $prayerTime->subuh,
                        'Terbit' => $prayerTime->terbit,
                        'Dzuhur' => $prayerTime->dzuhur,
                        'Ashar' => $prayerTime->ashar,
                        'Maghrib' => $prayerTime->maghrib,
                        'Isya' => $prayerTime->isya,
                    ];
                @endphp
                @foreach($prayers as $name => $time)
                <div class="p-4 text-center {{ $nextPrayer && $nextPrayer['name'] === $name ? 'bg-emerald-50 ring-2 ring-inset ring-emerald-200' : '' }}">
                    <p class="text-xs uppercase tracking-wider {{ $nextPrayer && $nextPrayer['name'] === $name ? 'text-emerald-700 font-bold' : 'text-gray-500' }}">{{ $name }}</p>
                    <p class="text-xl font-bold mt-1 {{ $nextPrayer && $nextPrayer['name'] === $name ? 'text-emerald-700' : 'text-gray-900' }}">
                        {{ $time ? \Carbon\Carbon::createFromFormat('H:i:s', $time)->format('H:i') : '-' }}
                    </p>
                    @if($nextPrayer && $nextPrayer['name'] === $name)
                    <span class="inline-block mt-1 px-2 py-0.5 bg-emerald-100 text-emerald-700 text-xs font-semibold rounded-full">Selanjutnya</span>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Sambutan Ketua --}}
    @if($sambutan)
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <span class="inline-block px-3 py-1 bg-emerald-100 text-emerald-700 text-sm font-semibold rounded-full mb-4">Sambutan</span>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ $sambutan->title }}</h2>
                <div class="prose prose-emerald text-gray-600 leading-relaxed">
                    {!! \Illuminate\Support\Str::limit(strip_tags($sambutan->content), 500) !!}
                </div>
                <a href="/profil/sejarah" class="inline-flex items-center mt-6 text-emerald-600 font-semibold hover:text-emerald-700 transition">
                    Baca Selengkapnya
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
            <div class="bg-gradient-to-br from-emerald-100 to-emerald-50 rounded-2xl p-8 flex items-center justify-center">
                <div class="text-center">
                    <div class="w-24 h-24 bg-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93s3.05-7.44 7-7.93v15.86z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-emerald-800">Masjid Bukit Palma</h3>
                    <p class="text-sm text-emerald-600 mt-1">Perumahan Bukit Palma, Surabaya</p>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- Pengumuman --}}
    @if($pengumuman->isNotEmpty())
    <section class="bg-emerald-50 py-16 mb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span class="inline-block px-3 py-1 bg-emerald-100 text-emerald-700 text-sm font-semibold rounded-full mb-3">Info Terkini</span>
                <h2 class="text-3xl font-bold text-gray-900">Pengumuman</h2>
            </div>
            <div class="flex justify-end mb-4">
                <a href="{{ route('public.pengumuman.index') }}" class="text-sm font-medium text-emerald-700 hover:text-emerald-800 transition flex items-center">
                    Lihat Semua Pengumuman
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($pengumuman as $item)
                <a href="{{ route('public.pengumuman.show', $item) }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition block">
                    <div class="flex items-center justify-between mb-3">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Pengumuman</span>
                        <span class="text-xs text-gray-400">{{ $item->created_at->diffForHumans() }}</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2 hover:text-emerald-700 transition">{{ $item->title }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">{{ \Illuminate\Support\Str::limit(strip_tags($item->content), 150) }}</p>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Donation Progress --}}
    @if($donationTargets->isNotEmpty())
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
        <div class="text-center mb-10">
            <span class="inline-block px-3 py-1 bg-amber-100 text-amber-700 text-sm font-semibold rounded-full mb-3">Donasi</span>
            <h2 class="text-3xl font-bold text-gray-900">Program Donasi Aktif</h2>
            <p class="text-gray-500 mt-2">Bantu kami mewujudkan program-program masjid</p>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($donationTargets as $target)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
                <div class="flex items-center justify-between mb-4">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                        {{ $target->category_ziswaf?->label() ?? $target->category_ziswaf ?? 'Donasi' }}
                    </span>
                    <span class="text-sm font-semibold text-emerald-600">{{ $target->progress_percent }}%</span>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $target->name }}</h3>
                @if($target->description)
                <p class="text-gray-500 text-sm mb-4">{{ \Illuminate\Support\Str::limit($target->description, 100) }}</p>
                @endif
                <div class="w-full bg-gray-200 rounded-full h-2.5 mb-3">
                    <div class="bg-emerald-500 h-2.5 rounded-full transition-all" style="width: {{ min(100, $target->progress_percent) }}%"></div>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Terkumpul: <strong class="text-gray-700">Rp {{ number_format($target->current_amount, 0, ',', '.') }}</strong></span>
                    <span class="text-gray-500">Target: <strong class="text-gray-700">Rp {{ number_format($target->target_amount, 0, ',', '.') }}</strong></span>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="/keuangan/donasi" class="inline-flex items-center px-6 py-3 bg-emerald-600 text-white rounded-xl font-semibold hover:bg-emerald-700 transition">
                Lihat Semua Program Donasi
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
    </section>
    @endif

    {{-- Gallery Carousel --}}
    @if($galleries->isNotEmpty())
    <section class="bg-gray-900 py-16 mb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span class="inline-block px-3 py-1 bg-emerald-900 text-emerald-300 text-sm font-semibold rounded-full mb-3">Dokumentasi</span>
                <h2 class="text-3xl font-bold text-white">Galeri Kegiatan</h2>
                <p class="text-gray-400 mt-2">Momen-momen kebersamaan di Masjid Bukit Palma</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($galleries as $gallery)
                @php
                    $media = $gallery->getFirstMedia('photos');
                @endphp
                @if($media)
                <div class="group relative aspect-square rounded-xl overflow-hidden">
                    <img src="{{ $media->getUrl('thumb') }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                        <div>
                            <p class="text-white text-sm font-semibold">{{ $gallery->title }}</p>
                            <p class="text-gray-300 text-xs">{{ $gallery->tanggal?->translatedFormat('d M Y') }}</p>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Kutipan Hikmah --}}
    @if($kutipanHikmah)
    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
        <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-2xl p-8 md:p-12 text-center border border-emerald-100">
            <svg class="w-10 h-10 text-emerald-400 mx-auto mb-4" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
            <blockquote class="text-xl md:text-2xl font-medium text-gray-800 leading-relaxed mb-4">
                {{ $kutipanHikmah->kutipan_text }}
            </blockquote>
            @if($kutipanHikmah->sumber)
            <cite class="text-emerald-600 font-semibold not-italic">- {{ $kutipanHikmah->sumber }}</cite>
            @endif
        </div>
    </section>
    @endif

    {{-- Quick Links --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
        <div class="grid md:grid-cols-4 gap-6">
            <a href="/profil/sejarah" class="group bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md hover:border-emerald-200 transition text-center">
                <div class="w-14 h-14 bg-emerald-100 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:bg-emerald-200 transition">
                    <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-1">Profil Masjid</h3>
                <p class="text-sm text-gray-500">Sejarah & visi misi</p>
            </a>
            <a href="/keuangan" class="group bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md hover:border-emerald-200 transition text-center">
                <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-1">Laporan Keuangan</h3>
                <p class="text-sm text-gray-500">Transparansi dana masjid</p>
            </a>
            <a href="/artikel" class="group bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md hover:border-emerald-200 transition text-center">
                <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:bg-purple-200 transition">
                    <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-1">Artikel & Kajian</h3>
                <p class="text-sm text-gray-500">Ilmu & informasi masjid</p>
            </a>
            <a href="/kontak" class="group bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md hover:border-emerald-200 transition text-center">
                <div class="w-14 h-14 bg-amber-100 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:bg-amber-200 transition">
                    <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-1">Hubungi Kami</h3>
                <p class="text-sm text-gray-500">Kontak & lokasi masjid</p>
            </a>
        </div>
    </section>
</x-public-layout>
