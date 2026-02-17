<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Dashboard' }} - Admin Masjid Bukit Palma</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-100" x-data="{ sidebarOpen: true }">
    <div class="min-h-screen flex">
        {{-- Sidebar --}}
        <aside class="w-64 bg-emerald-800 text-white flex-shrink-0 transition-all duration-300" :class="{ '-ml-64': !sidebarOpen }">
            <div class="p-4 border-b border-emerald-700">
                <a href="/admin/dashboard" class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-emerald-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93s3.05-7.44 7-7.93v15.86z"/></svg>
                    </div>
                    <span class="text-sm font-bold">MBP Admin</span>
                </a>
            </div>
            <nav class="p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-700 text-white' : 'text-emerald-200 hover:bg-emerald-700 hover:text-white' }} transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Dashboard</span>
                </a>

                @if(auth()->user()->hasAnyRole(['bendahara', 'takmir_inti', 'admin']))
                <div class="pt-4">
                    <p class="px-3 text-xs font-semibold text-emerald-400 uppercase tracking-wider">Keuangan</p>
                    @if(auth()->user()->hasAnyRole(['bendahara', 'admin']))
                    <a href="{{ Route::has('admin.transactions.index') ? route('admin.transactions.index') : '#' }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.transactions.*') ? 'bg-emerald-700 text-white' : 'text-emerald-200 hover:bg-emerald-700 hover:text-white' }} transition mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Transaksi</span>
                    </a>
                    @endif
                    @if(auth()->user()->hasAnyRole(['takmir_inti', 'admin']))
                    <a href="{{ Route::has('admin.approval.index') ? route('admin.approval.index') : '#' }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.approval.*') ? 'bg-emerald-700 text-white' : 'text-emerald-200 hover:bg-emerald-700 hover:text-white' }} transition mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Approval</span>
                    </a>
                    @endif
                    <a href="{{ Route::has('admin.donation-targets.index') ? route('admin.donation-targets.index') : '#' }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.donation-targets.*') ? 'bg-emerald-700 text-white' : 'text-emerald-200 hover:bg-emerald-700 hover:text-white' }} transition mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        <span>Target Donasi</span>
                    </a>
                </div>
                @endif

                @if(auth()->user()->hasAnyRole(['media', 'takmir_inti', 'admin']))
                <div class="pt-4">
                    <p class="px-3 text-xs font-semibold text-emerald-400 uppercase tracking-wider">Konten</p>
                    <a href="{{ Route::has('admin.articles.index') ? route('admin.articles.index') : '#' }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.articles.*') ? 'bg-emerald-700 text-white' : 'text-emerald-200 hover:bg-emerald-700 hover:text-white' }} transition mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        <span>Artikel</span>
                    </a>
                    <a href="{{ Route::has('admin.galleries.index') ? route('admin.galleries.index') : '#' }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.galleries.*') ? 'bg-emerald-700 text-white' : 'text-emerald-200 hover:bg-emerald-700 hover:text-white' }} transition mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>Galeri</span>
                    </a>
                    <a href="{{ Route::has('admin.kegiatan.index') ? route('admin.kegiatan.index') : '#' }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.kegiatan.*') ? 'bg-emerald-700 text-white' : 'text-emerald-200 hover:bg-emerald-700 hover:text-white' }} transition mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>Kegiatan</span>
                    </a>
                    <a href="{{ Route::has('admin.video-ceramah.index') ? route('admin.video-ceramah.index') : '#' }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.video-ceramah.*') ? 'bg-emerald-700 text-white' : 'text-emerald-200 hover:bg-emerald-700 hover:text-white' }} transition mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        <span>Video Ceramah</span>
                    </a>
                    <a href="{{ Route::has('admin.kutipan-hikmah.index') ? route('admin.kutipan-hikmah.index') : '#' }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.kutipan-hikmah.*') ? 'bg-emerald-700 text-white' : 'text-emerald-200 hover:bg-emerald-700 hover:text-white' }} transition mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                        <span>Kutipan Hikmah</span>
                    </a>
                </div>
                @endif

                @if(auth()->user()->hasAnyRole(['takmir_inti', 'admin']))
                <div class="pt-4">
                    <p class="px-3 text-xs font-semibold text-emerald-400 uppercase tracking-wider">Masjid</p>
                    <a href="{{ Route::has('admin.struktur.index') ? route('admin.struktur.index') : '#' }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.struktur.*') ? 'bg-emerald-700 text-white' : 'text-emerald-200 hover:bg-emerald-700 hover:text-white' }} transition mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <span>Struktur Organisasi</span>
                    </a>
                    <a href="{{ Route::has('admin.pengumuman.index') ? route('admin.pengumuman.index') : '#' }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.pengumuman.*') ? 'bg-emerald-700 text-white' : 'text-emerald-200 hover:bg-emerald-700 hover:text-white' }} transition mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                        <span>Pengumuman</span>
                    </a>
                    <a href="{{ Route::has('admin.static-pages.index') ? route('admin.static-pages.index') : '#' }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.static-pages.*') ? 'bg-emerald-700 text-white' : 'text-emerald-200 hover:bg-emerald-700 hover:text-white' }} transition mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>Halaman Statis</span>
                    </a>
                    <a href="{{ Route::has('admin.pembangunan.index') ? route('admin.pembangunan.index') : '#' }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.pembangunan.*') ? 'bg-emerald-700 text-white' : 'text-emerald-200 hover:bg-emerald-700 hover:text-white' }} transition mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        <span>Pembangunan</span>
                    </a>
                    <a href="{{ Route::has('admin.prayer-times.index') ? route('admin.prayer-times.index') : '#' }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.prayer-times.*') ? 'bg-emerald-700 text-white' : 'text-emerald-200 hover:bg-emerald-700 hover:text-white' }} transition mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Jadwal Sholat</span>
                    </a>
                </div>
                @endif

                @if(auth()->user()->hasRole('admin'))
                <div class="pt-4">
                    <p class="px-3 text-xs font-semibold text-emerald-400 uppercase tracking-wider">Sistem</p>
                    <a href="{{ Route::has('admin.users.index') ? route('admin.users.index') : '#' }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.users.*') ? 'bg-emerald-700 text-white' : 'text-emerald-200 hover:bg-emerald-700 hover:text-white' }} transition mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        <span>Users</span>
                    </a>
                    <a href="{{ Route::has('admin.audit-log.index') ? route('admin.audit-log.index') : '#' }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.audit-log.*') ? 'bg-emerald-700 text-white' : 'text-emerald-200 hover:bg-emerald-700 hover:text-white' }} transition mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        <span>Audit Log</span>
                    </a>
                    <a href="{{ Route::has('admin.contact-messages.index') ? route('admin.contact-messages.index') : '#' }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.contact-messages.*') ? 'bg-emerald-700 text-white' : 'text-emerald-200 hover:bg-emerald-700 hover:text-white' }} transition mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>Pesan Masuk</span>
                    </a>
                    <a href="{{ Route::has('admin.site-settings.index') ? route('admin.site-settings.index') : '#' }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.site-settings.*') ? 'bg-emerald-700 text-white' : 'text-emerald-200 hover:bg-emerald-700 hover:text-white' }} transition mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>Pengaturan Situs</span>
                    </a>
                    <a href="{{ Route::has('admin.social-links.index') ? route('admin.social-links.index') : '#' }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm {{ request()->routeIs('admin.social-links.*') ? 'bg-emerald-700 text-white' : 'text-emerald-200 hover:bg-emerald-700 hover:text-white' }} transition mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                        <span>Media Sosial</span>
                    </a>
                </div>
                @endif
            </nav>
        </aside>

        {{-- Main content --}}
        <div class="flex-1 flex flex-col min-h-screen">
            {{-- Top bar --}}
            <header class="bg-white shadow-sm border-b border-gray-200 h-16 flex items-center justify-between px-6">
                <div class="flex items-center space-x-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-lg text-gray-600 hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <h1 class="text-lg font-semibold text-gray-800">{{ $header ?? 'Dashboard' }}</h1>
                </div>
                <div class="flex items-center space-x-4">
                    {{-- Visit site link --}}
                    <a href="/" target="_blank" class="text-sm text-gray-500 hover:text-emerald-600 transition">Lihat Website</a>
                    {{-- User dropdown --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 text-sm">
                            @if(auth()->user()->avatar)
                                <img src="{{ auth()->user()->avatar }}" class="w-8 h-8 rounded-full" alt="">
                            @else
                                <div class="w-8 h-8 rounded-full bg-emerald-600 flex items-center justify-center text-white text-xs font-bold">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-xs text-gray-500">{{ auth()->user()->getRoleNames()->implode(', ') }}</p>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Page content --}}
            <main class="flex-1 p-6">
                {{-- Flash messages --}}
                @if(session('success'))
                <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg">
                    {{ session('success') }}
                </div>
                @endif
                @if(session('error'))
                <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts
</body>
</html>
