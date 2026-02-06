<x-public-layout>
    <x-slot name="title">Kalender Kegiatan</x-slot>

    {{-- Hero Section --}}
    <section class="bg-emerald-700 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-3">Kalender Kegiatan</h1>
            <p class="text-emerald-100 text-lg">Lihat jadwal kegiatan Masjid Bukit Palma dalam tampilan kalender</p>
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Month Navigation --}}
        <div class="flex items-center justify-between mb-8">
            <a href="{{ route('public.kegiatan.kalender', ['year' => $prevMonth->year, 'month' => $prevMonth->month]) }}"
                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-50 transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Sebelumnya
            </a>
            <h2 class="text-xl md:text-2xl font-bold text-gray-900">{{ $months[$month] }} {{ $year }}</h2>
            <a href="{{ route('public.kegiatan.kalender', ['year' => $nextMonth->year, 'month' => $nextMonth->month]) }}"
                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-50 transition">
                Selanjutnya
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        {{-- Legend --}}
        <div class="flex flex-wrap gap-4 mb-6 justify-center">
            <div class="flex items-center space-x-1.5 text-sm text-gray-600">
                <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                <span>Kajian</span>
            </div>
            <div class="flex items-center space-x-1.5 text-sm text-gray-600">
                <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                <span>Hari Besar Islam</span>
            </div>
            <div class="flex items-center space-x-1.5 text-sm text-gray-600">
                <span class="w-3 h-3 rounded-full bg-blue-500"></span>
                <span>Program Sosial</span>
            </div>
            <div class="flex items-center space-x-1.5 text-sm text-gray-600">
                <span class="w-3 h-3 rounded-full bg-purple-500"></span>
                <span>Kegiatan Remaja</span>
            </div>
        </div>

        {{-- Calendar Grid --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            {{-- Day Headers --}}
            <div class="grid grid-cols-7 bg-emerald-600 text-white text-center text-sm font-medium">
                <div class="py-3">Min</div>
                <div class="py-3">Sen</div>
                <div class="py-3">Sel</div>
                <div class="py-3">Rab</div>
                <div class="py-3">Kam</div>
                <div class="py-3">Jum</div>
                <div class="py-3">Sab</div>
            </div>

            {{-- Calendar Days --}}
            <div class="grid grid-cols-7">
                {{-- Empty cells before first day --}}
                @for($i = 0; $i < $startDayOfWeek; $i++)
                <div class="min-h-[80px] md:min-h-[100px] border-b border-r border-gray-100 bg-gray-50"></div>
                @endfor

                {{-- Days of the month --}}
                @for($day = 1; $day <= $daysInMonth; $day++)
                @php
                    $dateStr = sprintf('%04d-%02d-%02d', $year, $month, $day);
                    $dayKegiatan = $kegiatan->filter(fn($k) => $k->tanggal->format('Y-m-d') === $dateStr);
                    $isToday = $dateStr === now()->format('Y-m-d');
                @endphp
                <div class="min-h-[80px] md:min-h-[100px] border-b border-r border-gray-100 p-1.5 md:p-2 {{ $isToday ? 'bg-emerald-50' : '' }}">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-sm font-medium {{ $isToday ? 'bg-emerald-600 text-white w-7 h-7 rounded-full flex items-center justify-center' : 'text-gray-700' }}">
                            {{ $day }}
                        </span>
                    </div>
                    @foreach($dayKegiatan as $event)
                    @php
                        $dotColor = match($event->jenis) {
                            'kajian' => 'bg-emerald-500',
                            'maulid' => 'bg-amber-500',
                            'sosial' => 'bg-blue-500',
                            'remaja' => 'bg-purple-500',
                            default => 'bg-gray-400',
                        };
                    @endphp
                    <a href="{{ route('public.kegiatan.show', $event->id) }}"
                        class="flex items-center space-x-1 py-0.5 px-1 rounded text-xs hover:bg-gray-100 transition truncate group" title="{{ $event->nama_kegiatan }}">
                        <span class="w-2 h-2 rounded-full {{ $dotColor }} flex-shrink-0"></span>
                        <span class="truncate text-gray-600 group-hover:text-gray-900 hidden md:inline">{{ Str::limit($event->nama_kegiatan, 15) }}</span>
                    </a>
                    @endforeach
                </div>
                @endfor

                {{-- Empty cells after last day --}}
                @php
                    $totalCells = $startDayOfWeek + $daysInMonth;
                    $remainingCells = $totalCells % 7 === 0 ? 0 : 7 - ($totalCells % 7);
                @endphp
                @for($i = 0; $i < $remainingCells; $i++)
                <div class="min-h-[80px] md:min-h-[100px] border-b border-r border-gray-100 bg-gray-50"></div>
                @endfor
            </div>
        </div>

        {{-- Events List Below Calendar --}}
        @if($kegiatan->count() > 0)
        <div class="mt-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Kegiatan Bulan {{ $months[$month] }} {{ $year }}</h3>
            <div class="space-y-3">
                @foreach($kegiatan as $event)
                <a href="{{ route('public.kegiatan.show', $event->id) }}" class="flex items-center p-4 bg-white rounded-lg border border-gray-200 hover:shadow-sm transition group">
                    @php
                        $dotColor = match($event->jenis) {
                            'kajian' => 'bg-emerald-500',
                            'maulid' => 'bg-amber-500',
                            'sosial' => 'bg-blue-500',
                            'remaja' => 'bg-purple-500',
                            default => 'bg-gray-400',
                        };
                    @endphp
                    <div class="w-12 h-12 rounded-lg bg-gray-100 flex flex-col items-center justify-center flex-shrink-0 mr-4">
                        <span class="text-lg font-bold text-gray-800 leading-none">{{ $event->tanggal->format('d') }}</span>
                        <span class="text-xs text-gray-400 uppercase">{{ $event->tanggal->translatedFormat('M') }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center space-x-2">
                            <span class="w-2.5 h-2.5 rounded-full {{ $dotColor }}"></span>
                            <h4 class="font-medium text-gray-900 group-hover:text-emerald-700 transition truncate">{{ $event->nama_kegiatan }}</h4>
                        </div>
                        <p class="text-sm text-gray-500 mt-0.5">
                            {{ $event->jenis_label }}
                            @if($event->waktu) &middot; {{ \Carbon\Carbon::parse($event->waktu)->format('H:i') }} WIB @endif
                            @if($event->lokasi) &middot; {{ $event->lokasi }} @endif
                        </p>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <div class="mt-6 text-center">
            <a href="{{ route('public.kegiatan.index') }}" class="text-emerald-600 hover:text-emerald-700 text-sm font-medium">
                &larr; Kembali ke Daftar Kegiatan
            </a>
        </div>
    </section>
</x-public-layout>
