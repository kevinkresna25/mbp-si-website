<x-public-layout>
    <x-slot name="title">Lokasi Masjid</x-slot>
    <x-page-header :title="$page->title ?? 'Lokasi Masjid'" subtitle="Temukan ketenangan di jantung perumahan Bukit Palma. Kami menantikan kehadiran Anda." breadcrumb="Profil / Lokasi" />
    
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20 relative">
        {{-- Background Decoration --}}
        <div class="absolute top-20 right-0 w-72 h-72 bg-emerald-500/10 rounded-full blur-3xl -z-10 pointer-events-none"></div>
        <div class="absolute bottom-20 left-0 w-72 h-72 bg-teal-500/10 rounded-full blur-3xl -z-10 pointer-events-none"></div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-8">
                {{-- Map Card --}}
                <div class="bg-white dark:bg-slate-800 rounded-3xl overflow-hidden border border-emerald-100 dark:border-white/5 shadow-2xl shadow-gray-200/50 dark:shadow-none group relative h-[500px] flex flex-col">
                    <div class="flex-grow relative h-full w-full">
                        <iframe
                            src="{{ site_setting('google_maps_embed', '') }}"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            class="absolute inset-0 w-full h-full grayscale-[20%] group-hover:grayscale-0 transition duration-700 ease-in-out"
                        ></iframe>
                    </div>
                    <div class="p-5 bg-white dark:bg-slate-800 border-t border-emerald-100 dark:border-white/5 flex justify-between items-center relative z-10">
                        <div class="flex items-center gap-3">
                            <span class="relative flex h-3 w-3">
                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                              <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                            </span>
                            <span class="text-sm font-bold text-gray-900 dark:text-white">Google Maps Integration</span>
                        </div>
                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode(site_setting('site_name', 'Masjid Bukit Palma')) }}"
                           target="_blank"
                           class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-xl text-sm font-bold hover:bg-emerald-700 transition shadow-lg shadow-emerald-600/20 hover:-translate-y-0.5">
                            Buka Peta
                        </a>
                    </div>
                </div>

                {{-- Address Card --}}
                <div class="bg-white dark:bg-slate-800 rounded-3xl border border-emerald-200 dark:border-emerald-500/20 p-8 shadow-xl shadow-gray-200/50 dark:shadow-none relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition duration-500">
                         <svg class="w-32 h-32 text-emerald-600 transform group-hover:rotate-12 transition duration-700" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                    </div>
                    
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center relative z-10">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center mr-4 shadow-sm text-emerald-600 dark:text-emerald-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        Alamat Lengkap
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed relative z-10 font-medium pl-2 border-l-2 border-emerald-100 dark:border-white/10 ml-4">
                        {{ site_setting('site_name', 'Masjid Bukit Palma') }}<br>
                        {{ site_setting('site_address', 'Perumahan Bukit Palma, Surabaya, Jawa Timur, Indonesia') }}
                    </p>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6 sticky top-24 h-fit">
                <x-profil-sidebar />

                 {{-- Operational Hours --}}
                 <div class="bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/10 dark:to-teal-900/10 rounded-3xl p-6 border border-emerald-100 dark:border-emerald-500/20 shadow-lg shadow-gray-200/50 dark:shadow-none hover:shadow-xl transition duration-300">
                    <h3 class="text-lg font-bold text-emerald-900 dark:text-emerald-400 mb-6 flex items-center gap-3">
                        <div class="p-2 bg-white dark:bg-emerald-900/50 rounded-xl shadow-sm border border-emerald-100 dark:border-emerald-500/20">
                            <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        Jam Operasional
                    </h3>
                    <div class="space-y-3">
                        @php
                            $hours = site_setting('office_hours');
                            $schedule = is_string($hours) ? json_decode($hours, true) : $hours;
                            if (!is_array($schedule)) $schedule = [];
                        @endphp

                        @foreach($schedule as $slot)
                            <div class="flex justify-between items-center text-sm border-b border-emerald-200/50 dark:border-white/5 last:border-0 pb-3 last:pb-0">
                                <span class="font-bold text-gray-700 dark:text-gray-300 w-24">
                                    {{ $slot['day_start'] ?? '' }}
                                    @if(($slot['day_end'] ?? '') && ($slot['day_end'] !== $slot['day_start']))
                                        - {{ substr($slot['day_end'], 0, 3) }}
                                    @endif
                                </span>
                                <span class="text-right flex-grow">
                                    @if(!empty($slot['is_closed']))
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold uppercase tracking-wider bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-400 border border-rose-200 dark:border-rose-800/30">Tutup</span>
                                    @else
                                        <span class="font-mono font-bold text-emerald-700 dark:text-emerald-400 bg-white dark:bg-slate-800 px-3 py-1 rounded-lg border border-emerald-100 dark:border-white/10 shadow-sm whitespace-nowrap">{{ $slot['time_open'] ?? '00:00' }} - {{ $slot['time_close'] ?? '00:00' }}</span>
                                    @endif
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
