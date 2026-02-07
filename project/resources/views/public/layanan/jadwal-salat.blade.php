<x-public-layout>
    <x-slot name="title">Jadwal Salat</x-slot>

    {{-- Hero Section --}}
    <section class="bg-emerald-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-3">Jadwal Salat</h1>
            <p class="text-emerald-100 text-lg max-w-2xl mx-auto">Jadwal waktu salat wilayah Surabaya dan sekitarnya</p>
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Month Navigation --}}
        <div class="flex items-center justify-between mb-8">
            <a href="{{ route('public.layanan.jadwal-salat', ['year' => $prevMonth->year, 'month' => $prevMonth->month]) }}"
                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-50 transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Sebelumnya
            </a>
            <h2 class="text-xl md:text-2xl font-bold text-gray-900">{{ $months[$month] }} {{ $year }}</h2>
            <a href="{{ route('public.layanan.jadwal-salat', ['year' => $nextMonth->year, 'month' => $nextMonth->month]) }}"
                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-50 transition">
                Selanjutnya
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        {{-- Prayer Times Table --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-emerald-600 text-white">
                            <th class="px-4 py-3 text-left font-medium">Tanggal</th>
                            <th class="px-4 py-3 text-center font-medium">Imsak</th>
                            <th class="px-4 py-3 text-center font-medium">Subuh</th>
                            <th class="px-4 py-3 text-center font-medium">Terbit</th>
                            <th class="px-4 py-3 text-center font-medium">Dzuhur</th>
                            <th class="px-4 py-3 text-center font-medium">Ashar</th>
                            <th class="px-4 py-3 text-center font-medium">Maghrib</th>
                            <th class="px-4 py-3 text-center font-medium">Isya</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @php
                            $date = $startDate->copy();
                        @endphp
                        @while($date <= $endDate)
                        @php
                            $dateKey = $date->format('Y-m-d');
                            $prayer = $prayerTimes[$dateKey] ?? null;
                            $isToday = $dateKey === now()->format('Y-m-d');
                        @endphp
                        <tr class="{{ $isToday ? 'bg-emerald-50 font-medium' : 'hover:bg-gray-50' }}">
                            <td class="px-4 py-3 {{ $isToday ? 'text-emerald-700' : 'text-gray-700' }}">
                                <div class="flex items-center space-x-2">
                                    @if($isToday)
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    @endif
                                    <span>{{ $date->format('d') }} {{ $date->translatedFormat('D') }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-center text-gray-600">{{ $prayer?->imsak ?? '-' }}</td>
                            <td class="px-4 py-3 text-center text-gray-600">{{ $prayer?->subuh ?? '-' }}</td>
                            <td class="px-4 py-3 text-center text-gray-600">{{ $prayer?->terbit ?? '-' }}</td>
                            <td class="px-4 py-3 text-center text-gray-600">{{ $prayer?->dzuhur ?? '-' }}</td>
                            <td class="px-4 py-3 text-center text-gray-600">{{ $prayer?->ashar ?? '-' }}</td>
                            <td class="px-4 py-3 text-center text-gray-600">{{ $prayer?->maghrib ?? '-' }}</td>
                            <td class="px-4 py-3 text-center text-gray-600">{{ $prayer?->isya ?? '-' }}</td>
                        </tr>
                        @php $date->addDay(); @endphp
                        @endwhile
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6 bg-amber-50 border border-amber-200 rounded-lg p-4">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-amber-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <div>
                    <p class="text-sm font-medium text-amber-800">Catatan</p>
                    <p class="text-sm text-amber-700 mt-1">Waktu salat berdasarkan perhitungan untuk wilayah Surabaya dan sekitarnya. Jadwal dapat berubah. Pastikan mengikuti adzan dari masjid terdekat.</p>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
