<x-public-layout>
    <x-slot name="title">Lokasi Masjid</x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        {{-- Breadcrumb --}}
        <nav class="flex mb-8 text-sm text-gray-500 dark:text-gray-400">
            <a wire:navigate href="/" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition">Beranda</a>
            <span class="mx-2">/</span>
            <span class="text-gray-700 dark:text-gray-300">Profil</span>
            <span class="mx-2">/</span>
            <span class="font-semibold text-emerald-600 dark:text-emerald-400">Lokasi</span>
        </nav>

        <x-bento.grid>
             {{-- Hero Title (Full Width) --}}
            <x-bento.item span="3" class="bg-gradient-to-br from-emerald-800 to-emerald-950 text-white !border-0 min-h-[240px] flex flex-col justify-center relative overflow-hidden">
                <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')]"></div>
                <div class="absolute right-0 top-0 w-64 h-64 bg-emerald-500 rounded-full blur-3xl opacity-20 -mr-16 -mt-16"></div>
                
                <div class="relative z-10 max-w-3xl">
                    <span class="inline-block py-1 px-3 rounded-full bg-emerald-700/50 border border-emerald-600/50 text-emerald-100 text-xs font-medium mb-4 backdrop-blur-sm">
                        Peta & Alamat
                    </span>
                    <h1 class="text-3xl md:text-5xl font-bold tracking-tight mb-4">Lokasi Masjid</h1>
                    <p class="text-emerald-200 text-lg max-w-2xl">Temukan ketenangan di jantung perumahan Bukit Palma. Kami menantikan kehadiran Anda.</p>
                </div>
            </x-bento.item>

            {{-- Map (Main Content) --}}
            <x-bento.item span="2" class="!p-0 overflow-hidden min-h-[400px] md:min-h-[600px] flex flex-col border-0 shadow-lg">
                <div class="flex-grow relative h-full w-full">
                    <iframe
                        src="{{ site_setting('google_maps_embed', '') }}"
                        width="100%"
                        height="100%"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        class="absolute inset-0 w-full h-full grayscale-[50%] hover:grayscale-0 transition duration-700"
                    ></iframe>
                </div>
                <div class="p-4 bg-white dark:bg-slate-800 border-t border-gray-100 dark:border-white/5 flex justify-between items-center relative z-10">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">Google Maps Integration</span>
                    </div>
                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode(site_setting('site_name', 'Masjid Bukit Palma')) }}"
                       target="_blank"
                       class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm font-bold hover:bg-emerald-700 transition shadow-lg shadow-emerald-600/20">
                        Buka Peta
                    </a>
                </div>
            </x-bento.item>

            {{-- Sidebar & Info --}}
            <div class="space-y-6 flex flex-col gap-6">
                <x-profil-sidebar />
                
                {{-- Address Card --}}
                <x-bento.item class="!p-6 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition">
                         <svg class="w-24 h-24 text-emerald-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                    </div>
                    
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center relative z-10">
                        <div class="w-10 h-10 rounded-full bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center mr-3 shadow-sm">
                            <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        Alamat Lengkap
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed relative z-10 font-medium">
                        {{ site_setting('site_name', 'Masjid Bukit Palma') }}<br>
                        {{ site_setting('site_address', 'Perumahan Bukit Palma, Surabaya, Jawa Timur, Indonesia') }}
                    </p>
                </x-bento.item>

                {{-- Operational Hours --}}
                <div class="bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-950/30 dark:to-teal-950/20 rounded-3xl p-6 border border-emerald-100 dark:border-emerald-500/20 shadow-sm">
                    <h3 class="text-lg font-bold text-emerald-900 dark:text-emerald-400 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Jam Operasional
                    </h3>
                    <div class="space-y-3">
                        @php
                            $hours = site_setting('office_hours');
                            $schedule = is_string($hours) ? json_decode($hours, true) : $hours;
                            if (!is_array($schedule)) $schedule = [];
                        @endphp

                        @foreach($schedule as $slot)
                            <div class="flex justify-between items-center text-sm border-b border-emerald-100 dark:border-white/5 last:border-0 pb-2 last:pb-0">
                                <span class="font-medium text-gray-700 dark:text-gray-300">
                                    {{ $slot['day_start'] ?? '' }}
                                    @if(($slot['day_end'] ?? '') && ($slot['day_end'] !== $slot['day_start']))
                                        - {{ $slot['day_end'] }}
                                    @endif
                                </span>
                                <span class="text-right">
                                    @if(!empty($slot['is_closed']))
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-rose-100 text-rose-800 dark:bg-rose-900/30 dark:text-rose-400">Tutup</span>
                                    @else
                                        <span class="font-mono font-bold text-emerald-700 dark:text-emerald-400 bg-white dark:bg-slate-800 px-2 py-0.5 rounded border border-emerald-100 dark:border-white/10 shadow-sm">{{ $slot['time_open'] ?? '00:00' }} - {{ $slot['time_close'] ?? '00:00' }}</span>
                                    @endif
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </x-bento.grid>
    </div>
</x-public-layout>
