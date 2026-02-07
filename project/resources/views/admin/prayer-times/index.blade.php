<x-admin-layout>
    <x-slot name="header">Jadwal Sholat</x-slot>

    {{-- Flash Messages --}}
    @if(session('success'))
    <div class="mb-6 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg flex items-center space-x-2">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span class="text-sm">{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-lg flex items-center space-x-2">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span class="text-sm">{{ session('error') }}</span>
    </div>
    @endif

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 gap-4">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Jadwal Sholat - {{ now()->translatedFormat('F Y') }}</h2>
            <div class="flex items-center space-x-4 mt-1 text-sm text-gray-500">
                <span>{{ $prayerTimes->count() }} hari tersedia</span>
                @if($lastUpdated)
                <span>&middot; Terakhir update: {{ \Carbon\Carbon::parse($lastUpdated)->diffForHumans() }}</span>
                @endif
            </div>
        </div>
        <form method="POST" action="{{ route('admin.prayer-times.sync') }}">
            @csrf
            <button type="submit" class="inline-flex items-center space-x-2 px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm font-medium hover:bg-emerald-700 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                <span>Sinkronisasi Sekarang</span>
            </button>
        </form>
    </div>

    {{-- Info Card --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
            <p class="text-sm text-gray-500">Sumber Data</p>
            <p class="text-lg font-semibold text-gray-900 mt-1">API Aladhan</p>
            <p class="text-xs text-gray-400 mt-0.5">Method: Kemenag RI</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
            <p class="text-sm text-gray-500">Lokasi</p>
            <p class="text-lg font-semibold text-gray-900 mt-1">Surabaya</p>
            <p class="text-xs text-gray-400 mt-0.5">Indonesia</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
            <p class="text-sm text-gray-500">Data Tersimpan</p>
            <p class="text-lg font-semibold text-gray-900 mt-1">{{ $prayerTimes->count() }} / {{ now()->daysInMonth }} hari</p>
            <p class="text-xs text-gray-400 mt-0.5">Bulan {{ now()->translatedFormat('F Y') }}</p>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Imsak</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Subuh</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Terbit</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Dzuhur</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Ashar</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Maghrib</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Isya</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($prayerTimes as $pt)
                    @php
                        $isToday = $pt->tanggal->format('Y-m-d') === now()->format('Y-m-d');
                        $formatTime = fn($t) => $t ? \Carbon\Carbon::createFromFormat('H:i:s', $t)->format('H:i') : '-';
                    @endphp
                    <tr class="{{ $isToday ? 'bg-emerald-50 font-medium' : 'hover:bg-gray-50' }}">
                        <td class="px-4 py-3 text-gray-900">
                            <div class="flex items-center space-x-2">
                                @if($isToday)
                                <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                                @endif
                                <span>{{ $pt->tanggal->format('d') }} {{ $pt->tanggal->translatedFormat('D') }}</span>
                                @if($isToday)
                                <span class="text-xs bg-emerald-100 text-emerald-700 px-1.5 py-0.5 rounded font-semibold">Hari Ini</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3 text-center text-gray-600">{{ $formatTime($pt->imsak) }}</td>
                        <td class="px-4 py-3 text-center text-gray-600">{{ $formatTime($pt->subuh) }}</td>
                        <td class="px-4 py-3 text-center text-gray-600">{{ $formatTime($pt->terbit) }}</td>
                        <td class="px-4 py-3 text-center text-gray-600">{{ $formatTime($pt->dzuhur) }}</td>
                        <td class="px-4 py-3 text-center text-gray-600">{{ $formatTime($pt->ashar) }}</td>
                        <td class="px-4 py-3 text-center text-gray-600">{{ $formatTime($pt->maghrib) }}</td>
                        <td class="px-4 py-3 text-center text-gray-600">{{ $formatTime($pt->isya) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center space-y-3">
                                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <p class="text-sm">Belum ada data jadwal sholat bulan ini.</p>
                                <p class="text-xs text-gray-400">Klik tombol "Sinkronisasi Sekarang" untuk mengambil data dari API Aladhan.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
