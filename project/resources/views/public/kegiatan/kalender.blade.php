<x-public-layout>
    <x-slot name="title">Kalender Kegiatan</x-slot>

    {{-- Hero Section --}}
    <div class="relative min-h-[40vh] flex items-center justify-center overflow-hidden bg-emerald-950 pt-24 pb-16">
        <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')]"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-emerald-500 rounded-full blur-[128px] opacity-20"></div>
        <div class="absolute bottom-0 left-1/4 w-96 h-96 bg-teal-500 rounded-full blur-[128px] opacity-20"></div>
        
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block py-1 px-3 rounded-full bg-emerald-700/50 border border-emerald-600/50 text-emerald-100 text-xs font-medium mb-4 backdrop-blur-sm">
                Agenda Masjid
            </span>
            <h1 class="text-3xl md:text-5xl font-bold text-white tracking-tight mb-4 leading-tight">Kalender Kegiatan</h1>
            <p class="text-emerald-100/80 text-lg max-w-2xl mx-auto">
                Jadwal lengkap kegiatan ibadah, kajian, dan sosial di Masjid Bukit Palma.
            </p>
        </div>
    </div>

    {{-- Calendar Section --}}
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 -mt-12 relative z-20">
        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl border border-gray-100 dark:border-white/5 overflow-hidden">
            
            {{-- Calendar Navigation --}}
            <div class="p-6 md:p-8 flex flex-col md:flex-row items-center justify-between gap-4 border-b border-gray-100 dark:border-white/5 bg-gray-50/50 dark:bg-slate-800/50">
                <div class="flex items-center gap-4">
                    <a href="{{ route('public.kegiatan.kalender', ['year' => $prevMonth->year, 'month' => $prevMonth->month]) }}"
                        class="p-2 rounded-full bg-white dark:bg-slate-700 text-gray-600 dark:text-gray-300 hover:bg-emerald-50 hover:text-emerald-600 dark:hover:bg-emerald-900/30 dark:hover:text-emerald-400 transition shadow-sm border border-gray-200 dark:border-white/5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </a>
                    <h2 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white capitalize">
                        {{ $months[$month] }} <span class="text-emerald-600 dark:text-emerald-400">{{ $year }}</span>
                    </h2>
                    <a href="{{ route('public.kegiatan.kalender', ['year' => $nextMonth->year, 'month' => $nextMonth->month]) }}"
                        class="p-2 rounded-full bg-white dark:bg-slate-700 text-gray-600 dark:text-gray-300 hover:bg-emerald-50 hover:text-emerald-600 dark:hover:bg-emerald-900/30 dark:hover:text-emerald-400 transition shadow-sm border border-gray-200 dark:border-white/5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                {{-- Legend --}}
                <div class="flex flex-wrap justify-center gap-3">
                    <div class="flex items-center gap-1.5 text-xs font-medium text-gray-600 dark:text-gray-400">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 shadow-sm shadow-emerald-500/50"></span> Kajian
                    </div>
                    <div class="flex items-center gap-1.5 text-xs font-medium text-gray-600 dark:text-gray-400">
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500 shadow-sm shadow-amber-500/50"></span> PHBI
                    </div>
                    <div class="flex items-center gap-1.5 text-xs font-medium text-gray-600 dark:text-gray-400">
                        <span class="w-2.5 h-2.5 rounded-full bg-blue-500 shadow-sm shadow-blue-500/50"></span> Sosial
                    </div>
                    <div class="flex items-center gap-1.5 text-xs font-medium text-gray-600 dark:text-gray-400">
                        <span class="w-2.5 h-2.5 rounded-full bg-purple-500 shadow-sm shadow-purple-500/50"></span> Remaja
                    </div>
                </div>
            </div>

            {{-- Calendar Grid --}}
            <div class="grid grid-cols-7 border-b border-gray-100 dark:border-white/5">
                {{-- Headers --}}
                @foreach(['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'] as $dayName)
                <div class="py-3 text-center text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-slate-900/50 border-r border-gray-100 dark:border-white/5 last:border-r-0">
                    {{ $dayName }}
                </div>
                @endforeach
            </div>

            <div class="grid grid-cols-7 bg-white dark:bg-slate-800">
                {{-- Empty cells --}}
                @for($i = 0; $i < $startDayOfWeek; $i++)
                <div class="min-h-[100px] md:min-h-[120px] border-b border-r border-gray-100 dark:border-white/5 bg-gray-50/30 dark:bg-slate-900/30"></div>
                @endfor

                {{-- Days --}}
                @for($day = 1; $day <= $daysInMonth; $day++)
                @php
                    $dateStr = sprintf('%04d-%02d-%02d', $year, $month, $day);
                    $dayKegiatan = $kegiatan->filter(fn($k) => $k->tanggal->format('Y-m-d') === $dateStr);
                    $isToday = $dateStr === now()->format('Y-m-d');
                @endphp
                <div class="min-h-[100px] md:min-h-[120px] border-b border-r border-gray-100 dark:border-white/5 p-2 transition hover:bg-gray-50 dark:hover:bg-white/5 group relative {{ $isToday ? 'bg-emerald-50/50 dark:bg-emerald-900/10' : '' }}">
                    <div class="flex justify-between items-start mb-1">
                        <span class="text-sm font-medium w-7 h-7 flex items-center justify-center rounded-full {{ $isToday ? 'bg-emerald-600 text-white shadow-md shadow-emerald-500/30' : 'text-gray-700 dark:text-gray-300' }}">
                            {{ $day }}
                        </span>
                    </div>
                    
                    <div class="space-y-1">
                        @foreach($dayKegiatan as $event)
                        @php
                            $dotColor = match($event->jenis) {
                                'kajian' => 'bg-emerald-500',
                                'maulid' => 'bg-amber-500',
                                'sosial' => 'bg-blue-500',
                                'remaja' => 'bg-purple-500',
                                default => 'bg-gray-400',
                            };
                            $textColor = match($event->jenis) {
                                'kajian' => 'text-emerald-700 dark:text-emerald-300',
                                'maulid' => 'text-amber-700 dark:text-amber-300',
                                'sosial' => 'text-blue-700 dark:text-blue-300',
                                'remaja' => 'text-purple-700 dark:text-purple-300',
                                default => 'text-gray-700 dark:text-gray-300',
                            };
                             $bgColor = match($event->jenis) {
                                'kajian' => 'bg-emerald-100 dark:bg-emerald-900/30',
                                'maulid' => 'bg-amber-100 dark:bg-amber-900/30',
                                'sosial' => 'bg-blue-100 dark:bg-blue-900/30',
                                'remaja' => 'bg-purple-100 dark:bg-purple-900/30',
                                default => 'bg-gray-100 dark:bg-gray-800',
                            };
                        @endphp
                        <a href="{{ route('public.kegiatan.show', $event->id) }}"
                            class="block text-xs px-1.5 py-1 rounded {{ $bgColor }} {{ $textColor }} truncate hover:opacity-80 transition font-medium" 
                            title="{{ $event->nama_kegiatan }}">
                            {{ Str::limit($event->nama_kegiatan, 12) }}
                        </a>
                        @endforeach
                    </div>
                </div>
                @endfor

                {{-- Empty trailing cells --}}
                @php
                    $totalCells = $startDayOfWeek + $daysInMonth;
                    $remainingCells = $totalCells % 7 === 0 ? 0 : 7 - ($totalCells % 7);
                @endphp
                @for($i = 0; $i < $remainingCells; $i++)
                <div class="min-h-[100px] md:min-h-[120px] border-b border-r border-gray-100 dark:border-white/5 bg-gray-50/30 dark:bg-slate-900/30"></div>
                @endfor
            </div>
        </div>

        {{-- List View (Mobile Optimized) --}}
        @if($kegiatan->count() > 0)
        <div class="mt-8">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                Daftar Kegiatan Bulan Ini
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($kegiatan as $event)
                <a href="{{ route('public.kegiatan.show', $event->id) }}" class="flex items-start gap-4 p-4 bg-white dark:bg-slate-800 rounded-xl border border-gray-100 dark:border-white/5 hover:border-emerald-500/30 hover:shadow-md transition group">
                    <div class="flex flex-col items-center justify-center w-14 h-14 bg-gray-100 dark:bg-slate-700 rounded-xl shrink-0">
                         <span class="text-xs font-bold text-red-500 uppercase">{{ $event->tanggal->translatedFormat('M') }}</span>
                         <span class="text-xl font-black text-gray-900 dark:text-white leading-none">{{ $event->tanggal->format('d') }}</span>
                    </div>
                    <div class="min-w-0">
                        <h4 class="font-bold text-gray-900 dark:text-white truncate group-hover:text-emerald-600 transition">{{ $event->nama_kegiatan }}</h4>
                         <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full {{ match($event->jenis) { 'kajian' => 'bg-emerald-500', 'maulid' => 'bg-amber-500', 'sosial' => 'bg-blue-500', 'remaja' => 'bg-purple-500', default => 'bg-gray-400' } }}"></span>
                            {{ $event->jenis_label }}
                        </p>
                        @if($event->waktu)
                        <p class="text-xs text-gray-400 mt-0.5">{{ \Carbon\Carbon::parse($event->waktu)->format('H:i') }} WIB</p>
                        @endif
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <div class="mt-8 text-center">
            <a href="{{ route('public.kegiatan.index') }}" class="inline-flex items-center px-6 py-3 bg-white dark:bg-slate-800 border border-gray-200 dark:border-white/10 rounded-xl text-gray-600 dark:text-gray-300 font-medium hover:bg-gray-50 dark:hover:bg-slate-700 transition shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Daftar Kegiatan
            </a>
        </div>
    </div>
</x-public-layout>
