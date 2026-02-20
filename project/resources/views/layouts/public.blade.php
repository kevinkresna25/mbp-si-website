<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }"
      x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val)); if(darkMode) document.documentElement.classList.add('dark');"
      :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? site_setting('site_name', 'Masjid Bukit Palma') }} - {{ site_setting('site_name', 'Masjid Bukit Palma') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="font-sans antialiased bg-cream-100 text-gray-900 dark:text-white selection:bg-emerald-100 dark:bg-emerald-900/30 selection:text-emerald-900 dark:bg-slate-900 dark:text-emerald-50 transition-colors duration-300">
    <!-- Particles Background -->
    <div id="tsparticles" class="fixed inset-0 -z-10 pointer-events-none"></div>

    {{-- Navigation (Glassmorphism) --}}
    <nav class="fixed top-0 w-full z-50 transition-all duration-300 border-b border-transparent"
         x-data="{ mobileOpen: false, scrolled: false }"
         @scroll.window="scrolled = (window.scrollY > 20)"
         :class="scrolled ? 'pt-4 px-4' : 'bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border-b border-emerald-200 dark:border-emerald-500/30'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 transition-all duration-300"
             :class="scrolled ? 'bg-white/90 dark:bg-slate-900/90 backdrop-blur-xl shadow-lg rounded-2xl border border-emerald-200 dark:border-emerald-500/50 shadow-emerald-500/10 py-2' : ''">
            <div class="flex justify-between h-16">
                {{-- Logo --}}
                <div class="flex items-center">
                    <a wire:navigate href="/" class="flex items-center space-x-2.5 group">
                        <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-700 rounded-xl flex items-center justify-center shadow-sm group-hover:shadow-md transition-shadow">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93s3.05-7.44 7-7.93v15.86z"/></svg>
                        </div>
                        <span class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-emerald-700 transition-colors dark:text-white dark:group-hover:text-emerald-400">{{ site_setting('site_name', 'Masjid Bukit Palma') }}</span>
                    </a>
                </div>

                {{-- Desktop Navigation --}}
                <div class="hidden lg:flex items-center space-x-0.5">
                    {{-- 1. Beranda --}}
                    <a wire:navigate href="/" class="relative px-4 py-2 text-sm font-medium rounded-full transition-all duration-300 {{ request()->is('/') ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/50 dark:text-emerald-300 font-bold shadow-sm' : 'text-gray-600 dark:text-gray-300 hover:text-emerald-700 dark:hover:text-emerald-400 hover:bg-gray-50 dark:hover:bg-white/5' }}">
                        Beranda
                    </a>

                    {{-- 2. Profil (mega panel) --}}
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="relative px-4 py-2 text-sm font-medium rounded-full transition-all duration-300 flex items-center gap-1 {{ request()->is('profil*') || request()->is('pembangunan*') ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/50 dark:text-emerald-300 font-bold shadow-sm' : 'text-gray-600 dark:text-gray-300 hover:text-emerald-700 dark:hover:text-emerald-400 hover:bg-gray-50 dark:hover:bg-white/5' }}">
                            Profil
                            <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2" class="absolute left-1/2 -translate-x-1/2 mt-3 w-80 bg-white/95 backdrop-blur-lg rounded-2xl shadow-2xl ring-1 ring-gray-900/5 p-2 z-50 dark:bg-slate-900/95 dark:ring-white/10">
                            {{-- Arrow notch --}}
                            <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-4 h-4 bg-white/95 rotate-45 ring-1 ring-gray-900/5 rounded-sm dark:bg-slate-900/95 dark:ring-white/10" style="clip-path: polygon(0 0, 100% 0, 0 100%);"></div>
                            <a wire:navigate href="/profil/sejarah" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                <div class="flex-shrink-0 w-9 h-9 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center mt-0.5">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-emerald-700">Sejarah</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Perjalanan Masjid Bukit Palma</p>
                                </div>
                            </a>
                            <a wire:navigate href="/profil/visi-misi" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                <div class="flex-shrink-0 w-9 h-9 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center mt-0.5">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-emerald-700">Visi & Misi</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Tujuan dan arah masjid</p>
                                </div>
                            </a>
                            <a wire:navigate href="/profil/struktur" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                <div class="flex-shrink-0 w-9 h-9 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center mt-0.5">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-emerald-700">Struktur Organisasi</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Pengurus dan takmir masjid</p>
                                </div>
                            </a>
                            <a wire:navigate href="/profil/lokasi" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                <div class="flex-shrink-0 w-9 h-9 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center mt-0.5">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-emerald-700">Lokasi</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Alamat dan peta masjid</p>
                                </div>
                            </a>
                            <div class="border-t border-gray-100 my-1.5 mx-3"></div>
                            <a wire:navigate href="/pembangunan" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                <div class="flex-shrink-0 w-9 h-9 bg-amber-100 dark:bg-amber-900/30 rounded-lg flex items-center justify-center mt-0.5">
                                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-emerald-700">Pembangunan</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Progress pembangunan masjid</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    {{-- 3. Informasi (mega panel) --}}
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="relative px-4 py-2 text-sm font-medium rounded-full transition-all duration-300 flex items-center gap-1 {{ request()->is('pengumuman*') || request()->is('kegiatan*') || request()->is('keuangan*') ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/50 dark:text-emerald-300 font-bold shadow-sm' : 'text-gray-600 dark:text-gray-300 hover:text-emerald-700 dark:hover:text-emerald-400 hover:bg-gray-50 dark:hover:bg-white/5' }}">
                            Informasi
                            <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2" class="absolute left-1/2 -translate-x-1/2 mt-3 w-80 bg-white/95 backdrop-blur-lg rounded-2xl shadow-2xl ring-1 ring-gray-900/5 p-2 z-50 dark:bg-slate-900/95 dark:ring-white/10">
                            <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-4 h-4 bg-white/95 rotate-45 ring-1 ring-gray-900/5 rounded-sm dark:bg-slate-900/95 dark:ring-white/10" style="clip-path: polygon(0 0, 100% 0, 0 100%);"></div>
                            <a wire:navigate href="/pengumuman" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                <div class="flex-shrink-0 w-9 h-9 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center mt-0.5">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-emerald-700">Pengumuman</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Info terkini dari masjid</p>
                                </div>
                            </a>
                            <a wire:navigate href="/kegiatan" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                <div class="flex-shrink-0 w-9 h-9 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center mt-0.5">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-emerald-700">Kegiatan</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Jadwal acara dan kajian</p>
                                </div>
                            </a>
                            <a wire:navigate href="/keuangan" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                <div class="flex-shrink-0 w-9 h-9 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center mt-0.5">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-emerald-700">Keuangan & Donasi</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Transparansi keuangan masjid</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    {{-- 4. Media (mega panel) --}}
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="relative px-4 py-2 text-sm font-medium rounded-full transition-all duration-300 flex items-center gap-1 {{ request()->is('artikel*') || request()->is('video-ceramah*') ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/50 dark:text-emerald-300 font-bold shadow-sm' : 'text-gray-600 dark:text-gray-300 hover:text-emerald-700 dark:hover:text-emerald-400 hover:bg-gray-50 dark:hover:bg-white/5' }}">
                            Media
                            <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2" class="absolute left-1/2 -translate-x-1/2 mt-3 w-72 bg-white/95 backdrop-blur-lg rounded-2xl shadow-2xl ring-1 ring-gray-900/5 p-2 z-50 dark:bg-slate-900/95 dark:ring-white/10">
                            <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-4 h-4 bg-white/95 rotate-45 ring-1 ring-gray-900/5 rounded-sm dark:bg-slate-900/95 dark:ring-white/10" style="clip-path: polygon(0 0, 100% 0, 0 100%);"></div>
                            <a wire:navigate href="/artikel" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                <div class="flex-shrink-0 w-9 h-9 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center mt-0.5">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-emerald-700">Artikel</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Tulisan dan berita terbaru</p>
                                </div>
                            </a>
                            <a wire:navigate href="/video-ceramah" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                <div class="flex-shrink-0 w-9 h-9 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center mt-0.5">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-emerald-700">Video</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Dokumentasi dan konten video</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    {{-- 5. Layanan (mega panel - 2 column) --}}
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="relative px-4 py-2 text-sm font-medium rounded-full transition-all duration-300 flex items-center gap-1 {{ request()->is('layanan*') || request()->is('belajar-islam*') ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/50 dark:text-emerald-300 font-bold shadow-sm' : 'text-gray-600 dark:text-gray-300 hover:text-emerald-700 dark:hover:text-emerald-400 hover:bg-gray-50 dark:hover:bg-white/5' }}">
                            Layanan
                            <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2" class="absolute right-0 mt-3 bg-white/95 backdrop-blur-lg rounded-2xl shadow-2xl ring-1 ring-gray-900/5 p-4 z-50 dark:bg-slate-900/95 dark:ring-white/10" style="width: 540px;">
                            <div class="absolute -top-2 right-12 w-4 h-4 bg-white/95 rotate-45 ring-1 ring-gray-900/5 rounded-sm dark:bg-slate-900/95 dark:ring-white/10" style="clip-path: polygon(0 0, 100% 0, 0 100%);"></div>
                            <div class="grid grid-cols-2 gap-4">
                                {{-- Column 1: Ibadah --}}
                                <div>
                                    <p class="px-3 pb-2 text-xs font-semibold text-emerald-600 uppercase tracking-wider">Ibadah</p>
                                    <a wire:navigate href="/layanan/jadwal-salat" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                        <div class="flex-shrink-0 w-9 h-9 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center mt-0.5">
                                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-emerald-700">Jadwal Salat</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Waktu salat hari ini</p>
                                        </div>
                                    </a>
                                    <a wire:navigate href="/belajar-islam/syahadat" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                        <div class="flex-shrink-0 w-9 h-9 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center mt-0.5">
                                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-emerald-700">Syahadat</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Pilar pertama Islam</p>
                                        </div>
                                    </a>
                                    <a wire:navigate href="/belajar-islam/sholat" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                        <div class="flex-shrink-0 w-9 h-9 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center mt-0.5">
                                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-emerald-700">Panduan Sholat</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Tata cara sholat lengkap</p>
                                        </div>
                                    </a>
                                    <a wire:navigate href="/belajar-islam/mengaji" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                        <div class="flex-shrink-0 w-9 h-9 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center mt-0.5">
                                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-emerald-700">Kelas Mengaji</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Program belajar Al-Quran</p>
                                        </div>
                                    </a>
                                </div>
                                {{-- Column 2: Pelayanan --}}
                                <div>
                                    <p class="px-3 pb-2 text-xs font-semibold text-emerald-600 uppercase tracking-wider">Pelayanan</p>
                                    <a wire:navigate href="/layanan/nikah" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                        <div class="flex-shrink-0 w-9 h-9 bg-rose-100 dark:bg-rose-900/30 rounded-lg flex items-center justify-center mt-0.5">
                                            <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-emerald-700">Nikah</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Layanan pernikahan</p>
                                        </div>
                                    </a>
                                    <a wire:navigate href="/layanan/konsultasi" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                        <div class="flex-shrink-0 w-9 h-9 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mt-0.5">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-emerald-700">Konsultasi</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Konsultasi agama Islam</p>
                                        </div>
                                    </a>
                                    <a wire:navigate href="/layanan/permohonan" class="flex items-start gap-3 px-3 py-2.5 rounded-lg hover:bg-emerald-50/80 transition group">
                                        <div class="flex-shrink-0 w-9 h-9 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mt-0.5">
                                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-emerald-700">Permohonan</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Surat dan administrasi</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 6. Kontak --}}
                    <a wire:navigate href="/kontak" class="relative px-4 py-2 text-sm font-medium rounded-full transition-all duration-300 {{ request()->is('kontak*') ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/50 dark:text-emerald-300 font-bold shadow-sm' : 'text-gray-600 dark:text-gray-300 hover:text-emerald-700 dark:hover:text-emerald-400 hover:bg-gray-50 dark:hover:bg-white/5' }}">
                        Kontak
                    </a>
                </div>

                {{-- Right side: CTA + Auth + Dark Mode --}}
                <div class="hidden lg:flex items-center space-x-3">
                    {{-- Dark Mode Toggle --}}
                    <button @click="darkMode = !darkMode" class="p-2 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-slate-800 transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-500/20" aria-label="Toggle Dark Mode">
                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                        <svg x-show="darkMode" x-cloak class="w-5 h-5 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </button>

                    <a wire:navigate href="/layanan/jadwal-salat" class="px-4 py-2 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-lg text-sm font-medium hover:from-emerald-700 hover:to-emerald-800 shadow-sm hover:shadow-md transition-all flex items-center space-x-1.5 border border-transparent dark:border-white/10">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Jadwal Salat</span>
                    </a>
                    @auth
                        <a wire:navigate href="/admin/dashboard" class="px-3 py-2 text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-emerald-700 transition">Dashboard</a>
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
                {{-- Dark Mode Mobile --}}
                <div class="flex items-center justify-between px-3 py-2 rounded-lg text-sm font-medium text-gray-600 dark:text-gray-300 dark:hover:bg-slate-800 transition">
                    <span>Mode Gelap</span>
                    <button @click="darkMode = !darkMode" class="relative inline-flex h-6 w-11 items-center rounded-full bg-gray-200 dark:bg-slate-700 transition">
                        <span class="sr-only">Enable dark mode</span>
                        <span :class="darkMode ? 'translate-x-6' : 'translate-x-1'" class="inline-block h-4 w-4 transform rounded-full bg-white transition"></span>
                    </button>
                </div>
                <div class="border-t border-gray-100 dark:border-white/10 my-2"></div>

                {{-- CTA: Jadwal Salat --}}
                <a wire:navigate href="/layanan/jadwal-salat" @click="mobileOpen = false" class="flex items-center justify-center space-x-2 px-3 py-2.5 rounded-lg text-sm font-medium bg-gradient-to-r from-emerald-600 to-emerald-700 text-white shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Jadwal Salat</span>
                </a>

                <div class="border-t border-gray-100 my-2"></div>

                <a wire:navigate href="/" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-emerald-50 hover:text-emerald-700">Beranda</a>

                {{-- Profil (accordion) --}}
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-emerald-50 hover:text-emerald-700">
                        <span>Profil</span>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" x-collapse>
                        <a wire:navigate href="/profil/sejarah" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 pl-6">Sejarah</a>
                        <a wire:navigate href="/profil/visi-misi" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 pl-6">Visi & Misi</a>
                        <a wire:navigate href="/profil/struktur" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 pl-6">Struktur Organisasi</a>
                        <a wire:navigate href="/profil/lokasi" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 pl-6">Lokasi</a>
                        <a wire:navigate href="/pembangunan" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 pl-6">Pembangunan</a>
                    </div>
                </div>

                {{-- Informasi (accordion) --}}
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-emerald-50 hover:text-emerald-700">
                        <span>Informasi</span>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" x-collapse>
                        <a wire:navigate href="/pengumuman" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 pl-6">Pengumuman</a>
                        <a wire:navigate href="/kegiatan" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 pl-6">Kegiatan</a>
                        <a wire:navigate href="/keuangan" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 pl-6">Keuangan & Donasi</a>
                    </div>
                </div>

                {{-- Media (accordion) --}}
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-emerald-50 hover:text-emerald-700">
                        <span>Media</span>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" x-collapse>
                        <a wire:navigate href="/artikel" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 pl-6">Artikel</a>
                        <a wire:navigate href="/video-ceramah" @click="mobileOpen = false" class="block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 pl-6">Video</a>
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
                    <h3 class="text-lg font-bold mb-4">{{ site_setting('site_name', 'Masjid Bukit Palma') }}</h3>
                    <p class="text-emerald-200 text-sm leading-relaxed">{{ site_setting('site_tagline', 'Membangun Kepercayaan Jamaah Melalui Transparansi Digital') }}</p>
                    <p class="text-emerald-300 text-sm mt-4">{{ site_setting('site_address', 'Perumahan Bukit Palma, Surabaya, Jawa Timur, Indonesia') }}</p>
                    <div class="flex space-x-4 mt-5">
                        @foreach(App\Models\SocialLink::allActive() as $link)
                        <a href="{{ $link->url }}" class="text-emerald-200 hover:text-white transition" title="{{ $link->label }}" target="_blank">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="{{ $link->getIconSvg() }}"/></svg>
                        </a>
                        @endforeach
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
                &copy; {{ date('Y') }} {{ site_setting('site_name', 'Masjid Bukit Palma') }}. Semua hak dilindungi.
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
