<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Masjid Bukit Palma' }} - Masjid Bukit Palma</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    {{-- Navigation (Glassmorphism) --}}
    <nav class="bg-white/80 backdrop-blur-xl border-b border-gray-200/50 sticky top-0 z-50 transition-all duration-300"
         x-data="{ mobileOpen: false, scrolled: false }"
         @scroll.window="scrolled = (window.scrollY > 10)"
         :class="scrolled ? 'shadow-lg border-transparent bg-white/90' : ''">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                {{-- Logo --}}
                <div class="flex items-center">
                    <a href="/" class="flex items-center space-x-2.5 group">
                        <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-700 rounded-xl flex items-center justify-center shadow-sm group-hover:shadow-md transition-shadow">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93s3.05-7.44 7-7.93v15.86z"/></svg>
                        </div>
                        <span class="text-lg font-bold text-gray-900 group-hover:text-emerald-700 transition-colors">Masjid Bukit Palma</span>
                    </a>
                </div>

                {{-- Desktop Navigation --}}
                <div class="hidden lg:flex items-center space-x-0.5">
                    {{-- 1. Beranda --}}
                    <a href="/" class="relative px-3.5 py-2 text-sm font-medium transition {{ request()->is('/') ? 'text-emerald-700' : 'text-gray-600 hover:text-emerald-700' }}">
                        Beranda
                        @if(request()->is('/'))
                        <span class="absolute bottom-0 left-3.5 right-3.5 h-0.5 bg-emerald-600 rounded-full"></span>
                        @endif
                    </a>

                    {{-- 2. Profil (mega panel) --}}
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="relative px-3.5 py-2 text-sm font-medium transition flex items-center gap-1 {{ request()->is('profil*') || request()->is('pembangunan*') ? 'text-emerald-700' : 'text-gray-600 hover:text-emerald-700' }}">
                            Profil
                            <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            @if(request()->is('profil*') || request()->is('pembangunan*'))
                            <span class="absolute bottom-0 left-3.5 right-3.5 h-0.5 bg-emerald-600 rounded-full"></span>
                            @endif
                        </button>
                        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2" class="absolute left-1/2 -translate-x-1/2 mt-3 w-80 bg-white/95 backdrop-blur-lg rounded-xl shadow-2xl ring-1 ring-gray-900/5 p-2 z-50">
                            {{-- Arrow notch --}}
                            <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-4 h-4 bg-white/95 rotate-45 ring-1 ring-gray-900/5 rounded-sm" style="clip-path: polygon(0 0, 100% 0, 0 100%);"></div>
                            <a href="/profil/sejarah" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                <div class="flex-shrink-0 w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center mt-0.5">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 group-hover:text-emerald-700">Sejarah</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Perjalanan Masjid Bukit Palma</p>
                                </div>
                            </a>
                            <a href="/profil/visi-misi" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                <div class="flex-shrink-0 w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center mt-0.5">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 group-hover:text-emerald-700">Visi & Misi</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Tujuan dan arah masjid</p>
                                </div>
                            </a>
                            <a href="/profil/struktur" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                <div class="flex-shrink-0 w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center mt-0.5">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 group-hover:text-emerald-700">Struktur Organisasi</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Pengurus dan takmir masjid</p>
                                </div>
                            </a>
                            <a href="/profil/lokasi" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                <div class="flex-shrink-0 w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center mt-0.5">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 group-hover:text-emerald-700">Lokasi</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Alamat dan peta masjid</p>
                                </div>
                            </a>
                            <div class="border-t border-gray-100 my-1.5 mx-3"></div>
                            <a href="/pembangunan" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                <div class="flex-shrink-0 w-9 h-9 bg-amber-100 rounded-lg flex items-center justify-center mt-0.5">
                                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 group-hover:text-emerald-700">Pembangunan</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Progress pembangunan masjid</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    {{-- 3. Informasi (mega panel) --}}
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="relative px-3.5 py-2 text-sm font-medium transition flex items-center gap-1 {{ request()->is('pengumuman*') || request()->is('kegiatan*') || request()->is('keuangan*') ? 'text-emerald-700' : 'text-gray-600 hover:text-emerald-700' }}">
                            Informasi
                            <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            @if(request()->is('pengumuman*') || request()->is('kegiatan*') || request()->is('keuangan*'))
                            <span class="absolute bottom-0 left-3.5 right-3.5 h-0.5 bg-emerald-600 rounded-full"></span>
                            @endif
                        </button>
                        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2" class="absolute left-1/2 -translate-x-1/2 mt-3 w-80 bg-white/95 backdrop-blur-lg rounded-xl shadow-2xl ring-1 ring-gray-900/5 p-2 z-50">
                            <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-4 h-4 bg-white/95 rotate-45 ring-1 ring-gray-900/5 rounded-sm" style="clip-path: polygon(0 0, 100% 0, 0 100%);"></div>
                            <a href="/pengumuman" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                <div class="flex-shrink-0 w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center mt-0.5">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 group-hover:text-emerald-700">Pengumuman</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Info terkini dari masjid</p>
                                </div>
                            </a>
                            <a href="/kegiatan" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                <div class="flex-shrink-0 w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center mt-0.5">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 group-hover:text-emerald-700">Kegiatan</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Jadwal acara dan kajian</p>
                                </div>
                            </a>
                            <a href="/keuangan" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                <div class="flex-shrink-0 w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center mt-0.5">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 group-hover:text-emerald-700">Keuangan & Donasi</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Transparansi keuangan masjid</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    {{-- 4. Media (mega panel) --}}
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="relative px-3.5 py-2 text-sm font-medium transition flex items-center gap-1 {{ request()->is('artikel*') || request()->is('video-ceramah*') ? 'text-emerald-700' : 'text-gray-600 hover:text-emerald-700' }}">
                            Media
                            <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            @if(request()->is('artikel*') || request()->is('video-ceramah*'))
                            <span class="absolute bottom-0 left-3.5 right-3.5 h-0.5 bg-emerald-600 rounded-full"></span>
                            @endif
                        </button>
                        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2" class="absolute left-1/2 -translate-x-1/2 mt-3 w-72 bg-white/95 backdrop-blur-lg rounded-xl shadow-2xl ring-1 ring-gray-900/5 p-2 z-50">
                            <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-4 h-4 bg-white/95 rotate-45 ring-1 ring-gray-900/5 rounded-sm" style="clip-path: polygon(0 0, 100% 0, 0 100%);"></div>
                            <a href="/artikel" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                <div class="flex-shrink-0 w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center mt-0.5">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 group-hover:text-emerald-700">Artikel</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Tulisan dan berita terbaru</p>
                                </div>
                            </a>
                            <a href="/video-ceramah" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                <div class="flex-shrink-0 w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center mt-0.5">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 group-hover:text-emerald-700">Video</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Dokumentasi dan konten video</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    {{-- 5. Layanan (mega panel - 2 column) --}}
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="relative px-3.5 py-2 text-sm font-medium transition flex items-center gap-1 {{ request()->is('layanan*') || request()->is('belajar-islam*') ? 'text-emerald-700' : 'text-gray-600 hover:text-emerald-700' }}">
                            Layanan
                            <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            @if(request()->is('layanan*') || request()->is('belajar-islam*'))
                            <span class="absolute bottom-0 left-3.5 right-3.5 h-0.5 bg-emerald-600 rounded-full"></span>
                            @endif
                        </button>
                        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2" class="absolute right-0 mt-3 bg-white/95 backdrop-blur-lg rounded-xl shadow-2xl ring-1 ring-gray-900/5 p-4 z-50" style="width: 540px;">
                            <div class="absolute -top-2 right-12 w-4 h-4 bg-white/95 rotate-45 ring-1 ring-gray-900/5 rounded-sm" style="clip-path: polygon(0 0, 100% 0, 0 100%);"></div>
                            <div class="grid grid-cols-2 gap-4">
                                {{-- Column 1: Ibadah --}}
                                <div>
                                    <p class="px-3 pb-2 text-xs font-semibold text-emerald-600 uppercase tracking-wider">Ibadah</p>
                                    <a href="/layanan/jadwal-salat" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                        <div class="flex-shrink-0 w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center mt-0.5">
                                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 group-hover:text-emerald-700">Jadwal Salat</p>
                                            <p class="text-xs text-gray-500 mt-0.5">Waktu salat hari ini</p>
                                        </div>
                                    </a>
                                    <a href="/belajar-islam/syahadat" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                        <div class="flex-shrink-0 w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center mt-0.5">
                                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 group-hover:text-emerald-700">Syahadat</p>
                                            <p class="text-xs text-gray-500 mt-0.5">Pilar pertama Islam</p>
                                        </div>
                                    </a>
                                    <a href="/belajar-islam/sholat" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                        <div class="flex-shrink-0 w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center mt-0.5">
                                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 group-hover:text-emerald-700">Panduan Sholat</p>
                                            <p class="text-xs text-gray-500 mt-0.5">Tata cara sholat lengkap</p>
                                        </div>
                                    </a>
                                    <a href="/belajar-islam/mengaji" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                        <div class="flex-shrink-0 w-9 h-9 bg-emerald-100 rounded-lg flex items-center justify-center mt-0.5">
                                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 group-hover:text-emerald-700">Kelas Mengaji</p>
                                            <p class="text-xs text-gray-500 mt-0.5">Program belajar Al-Quran</p>
                                        </div>
                                    </a>
                                </div>
                                {{-- Column 2: Pelayanan --}}
                                <div>
                                    <p class="px-3 pb-2 text-xs font-semibold text-emerald-600 uppercase tracking-wider">Pelayanan</p>
                                    <a href="/layanan/nikah" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                        <div class="flex-shrink-0 w-9 h-9 bg-rose-100 rounded-lg flex items-center justify-center mt-0.5">
                                            <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 group-hover:text-emerald-700">Nikah</p>
                                            <p class="text-xs text-gray-500 mt-0.5">Layanan pernikahan</p>
                                        </div>
                                    </a>
                                    <a href="/layanan/konsultasi" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                        <div class="flex-shrink-0 w-9 h-9 bg-blue-100 rounded-lg flex items-center justify-center mt-0.5">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 group-hover:text-emerald-700">Konsultasi</p>
                                            <p class="text-xs text-gray-500 mt-0.5">Konsultasi agama Islam</p>
                                        </div>
                                    </a>
                                    <a href="/layanan/permohonan" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                        <div class="flex-shrink-0 w-9 h-9 bg-purple-100 rounded-lg flex items-center justify-center mt-0.5">
                                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 group-hover:text-emerald-700">Permohonan</p>
                                            <p class="text-xs text-gray-500 mt-0.5">Surat dan administrasi</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 6. Kontak --}}
                    <a href="/kontak" class="relative px-3.5 py-2 text-sm font-medium transition {{ request()->is('kontak*') ? 'text-emerald-700' : 'text-gray-600 hover:text-emerald-700' }}">
                        Kontak
                        @if(request()->is('kontak*'))
                        <span class="absolute bottom-0 left-3.5 right-3.5 h-0.5 bg-emerald-600 rounded-full"></span>
                        @endif
                    </a>
                </div>

                {{-- Right side: CTA + Auth --}}
                <div class="hidden lg:flex items-center space-x-3">
                    <a href="/layanan/jadwal-salat" class="px-4 py-2 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-lg text-sm font-medium hover:from-emerald-700 hover:to-emerald-800 shadow-sm hover:shadow-md transition-all flex items-center space-x-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Jadwal Salat</span>
                    </a>
                    @auth
                        <a href="/admin/dashboard" class="px-3 py-2 text-sm font-medium text-gray-500 hover:text-emerald-700 transition">Dashboard</a>
                    @endauth
                </div>

                {{-- Mobile menu button (animated hamburger) --}}
                <div class="flex items-center lg:hidden">
                    <button @click="mobileOpen = !mobileOpen" class="relative p-2 rounded-lg text-gray-600 hover:bg-gray-100/80 transition" aria-label="Toggle menu">
                        <div class="w-6 h-5 flex flex-col justify-between">
                            <span class="block h-0.5 w-6 bg-current rounded-full transition-all duration-300 origin-center" :class="mobileOpen ? 'rotate-45 translate-y-[9px]' : ''"></span>
                            <span class="block h-0.5 w-6 bg-current rounded-full transition-all duration-300" :class="mobileOpen ? 'opacity-0 scale-x-0' : ''"></span>
                            <span class="block h-0.5 w-6 bg-current rounded-full transition-all duration-300 origin-center" :class="mobileOpen ? '-rotate-45 -translate-y-[9px]' : ''"></span>
                        </div>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile menu (slide-down + accordion) --}}
        <div x-show="mobileOpen" x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             @click.away="mobileOpen = false"
             class="lg:hidden border-t border-gray-200/50 bg-white/95 backdrop-blur-lg">
            <div class="px-4 py-3 space-y-1 max-h-[calc(100vh-4rem)] overflow-y-auto">
                {{-- CTA: Jadwal Salat --}}
                <a href="/layanan/jadwal-salat" @click="mobileOpen = false" class="flex items-center justify-center space-x-2 px-3 py-2.5 rounded-lg text-sm font-medium bg-gradient-to-r from-emerald-600 to-emerald-700 text-white shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Jadwal Salat</span>
                </a>

                <div class="border-t border-gray-100 my-2"></div>

                <a href="/" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-emerald-50 hover:text-emerald-700">Beranda</a>

                {{-- Profil (accordion) --}}
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-emerald-50 hover:text-emerald-700">
                        <span>Profil</span>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" x-collapse>
                        <a href="/profil/sejarah" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 pl-6">Sejarah</a>
                        <a href="/profil/visi-misi" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 pl-6">Visi & Misi</a>
                        <a href="/profil/struktur" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 pl-6">Struktur Organisasi</a>
                        <a href="/profil/lokasi" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 pl-6">Lokasi</a>
                        <a href="/pembangunan" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 pl-6">Pembangunan</a>
                    </div>
                </div>

                {{-- Informasi (accordion) --}}
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-emerald-50 hover:text-emerald-700">
                        <span>Informasi</span>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" x-collapse>
                        <a href="/pengumuman" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 pl-6">Pengumuman</a>
                        <a href="/kegiatan" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 pl-6">Kegiatan</a>
                        <a href="/keuangan" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 pl-6">Keuangan & Donasi</a>
                    </div>
                </div>

                {{-- Media (accordion) --}}
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-emerald-50 hover:text-emerald-700">
                        <span>Media</span>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" x-collapse>
                        <a href="/artikel" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 pl-6">Artikel</a>
                        <a href="/video-ceramah" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 pl-6">Video</a>
                    </div>
                </div>

                {{-- Layanan (accordion) --}}
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-emerald-50 hover:text-emerald-700">
                        <span>Layanan</span>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" x-collapse>
                        <a href="/belajar-islam/syahadat" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 pl-6">Syahadat</a>
                        <a href="/belajar-islam/sholat" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 pl-6">Panduan Sholat</a>
                        <a href="/belajar-islam/mengaji" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 pl-6">Kelas Mengaji</a>
                        <a href="/layanan/nikah" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 pl-6">Nikah</a>
                        <a href="/layanan/konsultasi" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 pl-6">Konsultasi</a>
                        <a href="/layanan/permohonan" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 pl-6">Permohonan</a>
                    </div>
                </div>

                <a href="/kontak" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-emerald-50 hover:text-emerald-700">Kontak</a>

                @auth
                    <div class="border-t border-gray-100 my-2"></div>
                    <a href="/admin/dashboard" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm font-medium text-emerald-700 hover:bg-emerald-50">Dashboard Admin</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main>
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="bg-emerald-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-bold mb-4">Masjid Bukit Palma</h3>
                    <p class="text-emerald-200 text-sm leading-relaxed">Membangun Kepercayaan Jamaah Melalui Transparansi Digital</p>
                    <p class="text-emerald-300 text-sm mt-4">Perumahan Bukit Palma, Surabaya<br>Jawa Timur, Indonesia</p>
                    <div class="flex space-x-4 mt-5">
                        <a href="#" class="text-emerald-200 hover:text-white transition" title="Instagram">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="#" class="text-emerald-200 hover:text-white transition" title="YouTube">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                        <a href="#" class="text-emerald-200 hover:text-white transition" title="WhatsApp">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="text-sm font-bold mb-4 uppercase tracking-wider">Profil & Informasi</h3>
                    <ul class="space-y-2 text-sm text-emerald-200">
                        <li><a href="/profil/sejarah" class="hover:text-white transition">Profil Masjid</a></li>
                        <li><a href="/pembangunan" class="hover:text-white transition">Pembangunan</a></li>
                        <li><a href="/pengumuman" class="hover:text-white transition">Pengumuman</a></li>
                        <li><a href="/kegiatan" class="hover:text-white transition">Kegiatan</a></li>
                        <li><a href="/keuangan" class="hover:text-white transition">Keuangan & Donasi</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-bold mb-4 uppercase tracking-wider">Media & Layanan</h3>
                    <ul class="space-y-2 text-sm text-emerald-200">
                        <li><a href="/artikel" class="hover:text-white transition">Artikel</a></li>
                        <li><a href="/video-ceramah" class="hover:text-white transition">Video</a></li>
                        <li><a href="/layanan/jadwal-salat" class="hover:text-white transition">Jadwal Salat</a></li>
                        <li><a href="/belajar-islam/syahadat" class="hover:text-white transition">Belajar Islam</a></li>
                        <li><a href="/kontak" class="hover:text-white transition">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-bold mb-4 uppercase tracking-wider">Akses Cepat</h3>
                    <ul class="space-y-2 text-sm text-emerald-200">
                        <li><a href="/layanan/jadwal-salat" class="hover:text-white transition">Jadwal Salat Hari Ini</a></li>
                        <li><a href="/keuangan/donasi" class="hover:text-white transition">Donasi</a></li>
                        <li><a href="/kontak" class="hover:text-white transition">Hubungi Kami</a></li>
                        @guest
                        <li><a href="{{ route('login') }}" class="hover:text-white transition">Login Admin</a></li>
                        @endguest
                    </ul>
                </div>
            </div>
            <div class="border-t border-emerald-800 mt-8 pt-8 text-center text-emerald-300 text-sm">
                &copy; {{ date('Y') }} Masjid Bukit Palma. Semua hak dilindungi.
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
