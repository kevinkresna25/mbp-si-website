<x-public-layout>
    <x-page-header title="Jadwal Salat" subtitle="Jadwal waktu salat untuk wilayah Surabaya dan sekitarnya." breadcrumb="Layanan / Jadwal Salat" />

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20 relative">
        {{-- Background Decoration --}}
        <div class="absolute top-20 left-0 w-72 h-72 bg-emerald-500/10 rounded-full blur-3xl -z-10 pointer-events-none"></div>
        <div class="absolute bottom-20 right-0 w-72 h-72 bg-blue-500/10 rounded-full blur-3xl -z-10 pointer-events-none"></div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Content --}}
            <div class="lg:col-span-2 space-y-8">
                {{-- Month Navigation --}}
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-white dark:bg-slate-800 p-6 rounded-3xl shadow-lg shadow-emerald-900/5 border border-emerald-200 dark:border-emerald-500/20 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/5 to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
                    
                    <a wire:navigate href="{{ route('public.layanan.jadwal-salat', ['year' => $prevMonth->year, 'month' => $prevMonth->month]) }}"
                        class="relative z-10 inline-flex items-center px-5 py-2.5 bg-gray-50 dark:bg-slate-700/50 border border-gray-200 dark:border-white/10 text-sm font-bold rounded-xl text-gray-700 dark:text-gray-300 hover:bg-emerald-500 hover:text-white dark:hover:bg-emerald-500 dark:hover:text-white hover:border-emerald-500 transition-all duration-300 shadow-sm hover:shadow-emerald-500/30">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        Bulan Sebelumnya
                    </a>
                    
                    <h2 class="relative z-10 text-xl md:text-2xl font-black text-gray-900 dark:text-white tracking-tight">
                        {{ $months[$month] }} <span class="text-emerald-500">{{ $year }}</span>
                    </h2>
                    
                    <a wire:navigate href="{{ route('public.layanan.jadwal-salat', ['year' => $nextMonth->year, 'month' => $nextMonth->month]) }}"
                        class="relative z-10 inline-flex items-center px-5 py-2.5 bg-gray-50 dark:bg-slate-700/50 border border-gray-200 dark:border-white/10 text-sm font-bold rounded-xl text-gray-700 dark:text-gray-300 hover:bg-emerald-500 hover:text-white dark:hover:bg-emerald-500 dark:hover:text-white hover:border-emerald-500 transition-all duration-300 shadow-sm hover:shadow-emerald-500/30">
                        Bulan Berikutnya
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                {{-- Prayer Times Table --}}
                <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl shadow-gray-200/50 dark:shadow-none border border-emerald-200 dark:border-emerald-500/20 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-gradient-to-r from-emerald-600 to-emerald-500 text-white">
                                    <th class="px-6 py-5 text-left font-bold uppercase tracking-wider text-xs">Tanggal</th>
                                    <th class="px-4 py-5 text-center font-bold uppercase tracking-wider text-xs">Imsak</th>
                                    <th class="px-4 py-5 text-center font-bold uppercase tracking-wider text-xs">Subuh</th>
                                    <th class="px-4 py-5 text-center font-bold uppercase tracking-wider text-xs">Terbit</th>
                                    <th class="px-4 py-5 text-center font-bold uppercase tracking-wider text-xs">Dzuhur</th>
                                    <th class="px-4 py-5 text-center font-bold uppercase tracking-wider text-xs">Ashar</th>
                                    <th class="px-4 py-5 text-center font-bold uppercase tracking-wider text-xs">Maghrib</th>
                                    <th class="px-4 py-5 text-center font-bold uppercase tracking-wider text-xs">Isya</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                                @php
                                    $date = $startDate->copy();
                                @endphp
                                @while($date <= $endDate)
                                @php
                                    $dateKey = $date->format('Y-m-d');
                                    $prayer = $prayerTimes[$dateKey] ?? null;
                                    $isToday = $dateKey === now()->format('Y-m-d');
                                @endphp
                                <tr class="{{ $isToday ? 'bg-emerald-50/80 dark:bg-emerald-500/10' : 'hover:bg-gray-50 dark:hover:bg-slate-700/30 transition duration-150' }} group">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            @if($isToday)
                                            <div class="relative w-2.5 h-2.5">
                                                <span class="absolute w-full h-full rounded-full bg-emerald-500 animate-ping opacity-75"></span>
                                                <span class="absolute w-full h-full rounded-full bg-emerald-500"></span>
                                            </div>
                                            @endif
                                            <span class="font-bold {{ $isToday ? 'text-emerald-700 dark:text-emerald-400' : 'text-gray-900 dark:text-white' }}">
                                                {{ $date->format('d') }} {{ $date->translatedFormat('D') }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-center font-medium {{ $isToday ? 'text-emerald-700 dark:text-emerald-300' : 'text-gray-600 dark:text-gray-400' }}">{{ $prayer?->imsak ? \Carbon\Carbon::parse($prayer->imsak)->format('H:i') : '-' }}</td>
                                    <td class="px-4 py-4 text-center font-medium {{ $isToday ? 'text-emerald-700 dark:text-emerald-300' : 'text-gray-600 dark:text-gray-400' }}">{{ $prayer?->subuh ? \Carbon\Carbon::parse($prayer->subuh)->format('H:i') : '-' }}</td>
                                    <td class="px-4 py-4 text-center text-gray-500 dark:text-gray-500 text-xs">{{ $prayer?->terbit ? \Carbon\Carbon::parse($prayer->terbit)->format('H:i') : '-' }}</td>
                                    <td class="px-4 py-4 text-center font-medium {{ $isToday ? 'text-emerald-700 dark:text-emerald-300' : 'text-gray-600 dark:text-gray-400' }}">{{ $prayer?->dzuhur ? \Carbon\Carbon::parse($prayer->dzuhur)->format('H:i') : '-' }}</td>
                                    <td class="px-4 py-4 text-center font-medium {{ $isToday ? 'text-emerald-700 dark:text-emerald-300' : 'text-gray-600 dark:text-gray-400' }}">{{ $prayer?->ashar ? \Carbon\Carbon::parse($prayer->ashar)->format('H:i') : '-' }}</td>
                                    <td class="px-4 py-4 text-center font-medium {{ $isToday ? 'text-emerald-700 dark:text-emerald-300' : 'text-gray-600 dark:text-gray-400' }}">{{ $prayer?->maghrib ? \Carbon\Carbon::parse($prayer->maghrib)->format('H:i') : '-' }}</td>
                                    <td class="px-4 py-4 text-center font-medium {{ $isToday ? 'text-emerald-700 dark:text-emerald-300' : 'text-gray-600 dark:text-gray-400' }}">{{ $prayer?->isya ? \Carbon\Carbon::parse($prayer->isya)->format('H:i') : '-' }}</td>
                                </tr>
                                @php $date->addDay(); @endphp
                                @endwhile
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-amber-50 dark:bg-amber-900/10 border border-amber-200 dark:border-amber-500/20 rounded-2xl p-6 flex items-start gap-4 shadow-sm">
                    <div class="p-2 bg-amber-100 dark:bg-amber-900/30 rounded-lg shrink-0 text-amber-600 dark:text-amber-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-amber-900 dark:text-amber-300 mb-1">Catatan Penting</h4>
                        <p class="text-sm text-amber-800 dark:text-amber-400 leading-relaxed">
                            Jadwal waktu salat ini disusun berdasarkan perhitungan hisab untuk wilayah <strong>Surabaya dan sekitarnya</strong>. Waktu dapat berubah sewaktu-waktu. Sangat disarankan untuk menunggu kumandang adzan dari masjid terdekat sebagai tanda masuk waktu salat yang lebih akurat.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Sidebar (Menu Layanan) --}}
            <div class="space-y-6">
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-lg shadow-gray-200/50 dark:shadow-none border border-emerald-200 dark:border-emerald-500/20 sticky top-24">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                        Layanan Lainnya
                    </h3>
                    <nav class="space-y-2">
                        <a href="{{ route('public.layanan.jadwal-salat') }}" 
                            class="flex items-center justify-between p-4 rounded-xl transition-all duration-300 {{ request()->routeIs('public.layanan.jadwal-salat') ? 'bg-emerald-500 text-white shadow-emerald-500/30 shadow-lg' : 'bg-gray-50 dark:bg-slate-700/30 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-slate-700 hover:text-emerald-600 dark:hover:text-emerald-400' }}">
                            <span class="font-bold text-sm">Jadwal Salat</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </a>
                        <a href="{{ route('public.layanan.konsultasi') }}"
                            class="flex items-center justify-between p-4 rounded-xl transition-all duration-300 {{ request()->routeIs('public.layanan.konsultasi') ? 'bg-emerald-500 text-white shadow-emerald-500/30 shadow-lg' : 'bg-gray-50 dark:bg-slate-700/30 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-slate-700 hover:text-emerald-600 dark:hover:text-emerald-400' }}">
                            <span class="font-bold text-sm">Konsultasi Agama</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        </a>
                        <a href="{{ route('public.layanan.nikah') }}"
                            class="flex items-center justify-between p-4 rounded-xl transition-all duration-300 {{ request()->routeIs('public.layanan.nikah') ? 'bg-emerald-500 text-white shadow-emerald-500/30 shadow-lg' : 'bg-gray-50 dark:bg-slate-700/30 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-slate-700 hover:text-emerald-600 dark:hover:text-emerald-400' }}">
                            <span class="font-bold text-sm">Akad Nikah</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        </a>
                        <a href="{{ route('public.layanan.permohonan') }}"
                            class="flex items-center justify-between p-4 rounded-xl transition-all duration-300 {{ request()->routeIs('public.layanan.permohonan') ? 'bg-emerald-500 text-white shadow-emerald-500/30 shadow-lg' : 'bg-gray-50 dark:bg-slate-700/30 text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-slate-700 hover:text-emerald-600 dark:hover:text-emerald-400' }}">
                            <span class="font-bold text-sm">Permohonan Surat</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
