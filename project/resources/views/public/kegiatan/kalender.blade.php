<x-public-layout>
    {{-- Page Header --}}
    <x-page-header title="Kalender Kegiatan" subtitle="Jadwal lengkap kegiatan ibadah, kajian, dan program Masjid Bukit Palma" breadcrumb="Kegiatan / Kalender">
         {{-- Legend (Moved to Header for better visibility) --}}
        <div class="mt-8 flex flex-wrap justify-center gap-3 animate-fade-in-up" style="animation-delay: 0.2s;">
            <div class="flex items-center gap-1.5 px-3 py-1 bg-emerald-100 dark:bg-emerald-900/30 rounded-full border border-emerald-200 dark:border-emerald-500/20">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span> 
                <span class="text-xs font-bold text-emerald-800 dark:text-emerald-200 uppercase tracking-wider">Kajian</span>
            </div>
            <div class="flex items-center gap-1.5 px-3 py-1 bg-amber-100 dark:bg-amber-900/30 rounded-full border border-amber-200 dark:border-amber-500/20">
                <span class="w-2 h-2 rounded-full bg-amber-500"></span> 
                <span class="text-xs font-bold text-amber-800 dark:text-amber-200 uppercase tracking-wider">PHBI</span>
            </div>
            <div class="flex items-center gap-1.5 px-3 py-1 bg-blue-100 dark:bg-blue-900/30 rounded-full border border-blue-200 dark:border-blue-500/20">
                <span class="w-2 h-2 rounded-full bg-blue-500"></span> 
                <span class="text-xs font-bold text-blue-800 dark:text-blue-200 uppercase tracking-wider">Sosial</span>
            </div>
            <div class="flex items-center gap-1.5 px-3 py-1 bg-purple-100 dark:bg-purple-900/30 rounded-full border border-purple-200 dark:border-purple-500/20">
                <span class="w-2 h-2 rounded-full bg-purple-500"></span> 
                <span class="text-xs font-bold text-purple-800 dark:text-purple-200 uppercase tracking-wider">Remaja</span>
            </div>
        </div>
    </x-page-header>

    {{-- Calendar Section --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10">
        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl border border-emerald-200 dark:border-emerald-500/20 overflow-hidden">
            
            {{-- Calendar Navigation --}}
            <div class="p-6 md:p-8 flex flex-col md:flex-row items-center justify-between gap-4 border-b border-gray-100 dark:border-white/5 bg-gray-50/50 dark:bg-slate-800/50">
                <div class="flex items-center justify-between w-full md:w-auto gap-4">
                    <a href="{{ route('public.kegiatan.kalender', ['year' => $prevMonth->year, 'month' => $prevMonth->month]) }}"
                        class="p-2 rounded-xl bg-white dark:bg-slate-700 text-gray-600 dark:text-gray-300 hover:bg-emerald-500 hover:text-white dark:hover:bg-emerald-600 transition shadow-sm border border-gray-200 dark:border-white/5 group">
                        <svg class="w-5 h-5 transform group-hover:-translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </a>
                    
                    <h2 class="text-xl md:text-2xl font-black text-gray-900 dark:text-white capitalize text-center min-w-[200px]">
                        {{ $months[$month] }} <span class="text-emerald-600 dark:text-emerald-400 font-light">{{ $year }}</span>
                    </h2>
                    
                    <a href="{{ route('public.kegiatan.kalender', ['year' => $nextMonth->year, 'month' => $nextMonth->month]) }}"
                        class="p-2 rounded-xl bg-white dark:bg-slate-700 text-gray-600 dark:text-gray-300 hover:bg-emerald-500 hover:text-white dark:hover:bg-emerald-600 transition shadow-sm border border-gray-200 dark:border-white/5 group">
                        <svg class="w-5 h-5 transform group-hover:translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            {{-- Calendar Grid --}}
            <div class="grid grid-cols-7 border-b border-gray-100 dark:border-white/5">
                {{-- Headers --}}
                @foreach(['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'] as $dayName)
                <div class="py-4 text-center text-xs font-bold uppercase tracking-wider text-emerald-800 dark:text-emerald-400 bg-emerald-50/50 dark:bg-slate-900/50 border-r border-gray-100 dark:border-white/5 last:border-r-0">
                    {{ $dayName }}
                </div>
                @endforeach
            </div>

            <div class="grid grid-cols-7 bg-white dark:bg-slate-800">
                {{-- Empty cells --}}
                @for($i = 0; $i < $startDayOfWeek; $i++)
                <div class="min-h-[120px] md:min-h-[140px] border-b border-r border-gray-100 dark:border-white/5 bg-gray-50/30 dark:bg-slate-900/30"></div>
                @endfor

                {{-- Days --}}
                @for($day = 1; $day <= $daysInMonth; $day++)
                @php
                    $dateStr = sprintf('%04d-%02d-%02d', $year, $month, $day);
                    $dayKegiatan = $kegiatan->filter(fn($k) => $k->tanggal->format('Y-m-d') === $dateStr);
                    $isToday = $dateStr === now()->format('Y-m-d');
                @endphp
                <div class="min-h-[100px] md:min-h-[120px] border-b border-r border-emerald-100 dark:border-white/5 p-2 transition hover:bg-gray-50 dark:hover:bg-white/5 group relative {{ $isToday ? 'bg-emerald-50/50 dark:bg-emerald-900/10' : '' }}">
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
                <div class="min-h-[100px] md:min-h-[120px] border-b border-r border-emerald-100 dark:border-white/5 bg-gray-50/30 dark:bg-slate-900/30"></div>
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
                <a href="{{ route('public.kegiatan.show', $event->id) }}" class="flex items-start gap-4 p-4 bg-white dark:bg-slate-800 rounded-3xl border border-emerald-200 dark:border-emerald-500/20 hover:border-emerald-500/40 hover:shadow-lg hover:-translate-y-1 transition group">
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
