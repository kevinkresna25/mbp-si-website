<x-public-layout>
    <x-page-header title="Jadwal Salat" subtitle="Jadwal waktu salat wilayah Surabaya dan sekitarnya" breadcrumb="Layanan / Jadwal Salat" />

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <x-bento.grid>
            {{-- Content --}}
            <x-bento.item span="2">
                {{-- Month Navigation --}}
                <div class="flex flex-col sm:flex-row items-center justify-between mb-8 gap-4 bg-white dark:bg-slate-800 p-4 rounded-2xl border border-gray-100 dark:border-white/5 shadow-sm">
                    <a wire:navigate href="{{ route('public.layanan.jadwal-salat', ['year' => $prevMonth->year, 'month' => $prevMonth->month]) }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-50 dark:bg-slate-700 border border-gray-200 dark:border-white/10 text-sm font-medium rounded-xl text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-emerald-900/30 hover:border-emerald-200 dark:hover:border-emerald-500/30 hover:text-emerald-600 dark:hover:text-emerald-400 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        Bulan Sebelumnya
                    </a>
                    <h2 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white">{{ $months[$month] }} {{ $year }}</h2>
                    <a wire:navigate href="{{ route('public.layanan.jadwal-salat', ['year' => $nextMonth->year, 'month' => $nextMonth->month]) }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-50 dark:bg-slate-700 border border-gray-200 dark:border-white/10 text-sm font-medium rounded-xl text-gray-700 dark:text-gray-300 hover:bg-emerald-50 dark:hover:bg-emerald-900/30 hover:border-emerald-200 dark:hover:border-emerald-500/30 hover:text-emerald-600 dark:hover:text-emerald-400 transition">
                        Bulan Berikutnya
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                {{-- Prayer Times Table --}}
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-100 dark:border-white/5 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-emerald-600 text-white">
                                    <th class="px-6 py-4 text-left font-bold">Tanggal</th>
                                    <th class="px-4 py-4 text-center font-bold">Imsak</th>
                                    <th class="px-4 py-4 text-center font-bold">Subuh</th>
                                    <th class="px-4 py-4 text-center font-bold">Terbit</th>
                                    <th class="px-4 py-4 text-center font-bold">Dzuhur</th>
                                    <th class="px-4 py-4 text-center font-bold">Ashar</th>
                                    <th class="px-4 py-4 text-center font-bold">Maghrib</th>
                                    <th class="px-4 py-4 text-center font-bold">Isya</th>
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
                                <tr class="{{ $isToday ? 'bg-emerald-50 dark:bg-emerald-900/20 font-bold' : 'hover:bg-gray-50 dark:hover:bg-slate-700/50 transition' }}">
                                    <td class="px-6 py-4 {{ $isToday ? 'text-emerald-700 dark:text-emerald-300' : 'text-gray-700 dark:text-gray-300' }}">
                                        <div class="flex items-center gap-3">
                                            @if($isToday)
                                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                            @endif
                                            <span>{{ $date->format('d') }} {{ $date->translatedFormat('D') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-center text-gray-600 dark:text-gray-400">{{ $prayer?->imsak ?? '-' }}</td>
                                    <td class="px-4 py-4 text-center text-gray-600 dark:text-gray-400">{{ $prayer?->subuh ?? '-' }}</td>
                                    <td class="px-4 py-4 text-center text-gray-600 dark:text-gray-400">{{ $prayer?->terbit ?? '-' }}</td>
                                    <td class="px-4 py-4 text-center text-gray-600 dark:text-gray-400">{{ $prayer?->dzuhur ?? '-' }}</td>
                                    <td class="px-4 py-4 text-center text-gray-600 dark:text-gray-400">{{ $prayer?->ashar ?? '-' }}</td>
                                    <td class="px-4 py-4 text-center text-gray-600 dark:text-gray-400">{{ $prayer?->maghrib ?? '-' }}</td>
                                    <td class="px-4 py-4 text-center text-gray-600 dark:text-gray-400">{{ $prayer?->isya ?? '-' }}</td>
                                </tr>
                                @php $date->addDay(); @endphp
                                @endwhile
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-6 bg-amber-50 dark:bg-amber-900/10 border border-amber-200 dark:border-amber-500/20 rounded-xl p-4 flex items-start gap-3">
                    <svg class="w-5 h-5 text-amber-600 dark:text-amber-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <div>
                        <p class="text-sm font-bold text-amber-800 dark:text-amber-300">Catatan</p>
                        <p class="text-sm text-amber-700 dark:text-amber-400 mt-1">Waktu salat berdasarkan perhitungan untuk wilayah Surabaya dan sekitarnya. Jadwal dapat berubah. Pastikan mengikuti adzan dari masjid terdekat.</p>
                    </div>
                </div>
            </x-bento.item>

            {{-- Sidebar --}}
            <div class="space-y-6">
                <x-sidebar-menu title="Layanan Masjid" :links="[
                    ['label' => 'Jadwal Salat', 'url' => '/layanan/jadwal-salat', 'color' => 'bg-emerald-500'],
                    ['label' => 'Konsultasi Agama', 'url' => '/layanan/konsultasi', 'color' => 'bg-blue-500'],
                    ['label' => 'Akad Nikah', 'url' => '/layanan/nikah', 'color' => 'bg-pink-500'],
                    ['label' => 'Permohonan', 'url' => '/layanan/permohonan', 'color' => 'bg-amber-500'],
                ]" />
            </div>
        </x-bento.grid>
    </section>
</x-public-layout>
