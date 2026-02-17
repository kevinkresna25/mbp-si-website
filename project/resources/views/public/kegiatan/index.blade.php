<x-public-layout>
    <x-page-header title="Kegiatan Masjid" subtitle="Jadwal kegiatan, kajian, dan program Masjid Bukit Palma" breadcrumb="Kegiatan">
        <div class="mt-8 flex justify-center md:justify-start">
             <a wire:navigate href="{{ route('public.kegiatan.kalender') }}" class="inline-flex items-center px-5 py-2.5 bg-white/10 backdrop-blur-sm text-white text-sm font-medium rounded-xl hover:bg-white/20 transition border border-white/20">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Lihat Kalender
            </a>
        </div>
    </x-page-header>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Category Filter Tabs --}}
        <div class="flex flex-wrap gap-2 mb-8 justify-center md:justify-start">
            <a wire:navigate href="{{ route('public.kegiatan.index') }}"
                class="px-5 py-2.5 rounded-full text-sm font-medium transition border {{ !request('jenis') ? 'bg-emerald-600 text-white border-emerald-600 hover:bg-emerald-700' : 'bg-white dark:bg-slate-800 text-gray-600 dark:text-gray-300 border-gray-200 dark:border-white/10 hover:bg-gray-50 dark:hover:bg-slate-700' }}">
                Semua
            </a>
            @foreach($jenisOptions as $key => $label)
            <a wire:navigate href="{{ route('public.kegiatan.index', ['jenis' => $key]) }}"
                class="px-5 py-2.5 rounded-full text-sm font-medium transition border {{ request('jenis') === $key ? 'bg-emerald-600 text-white border-emerald-600 hover:bg-emerald-700' : 'bg-white dark:bg-slate-800 text-gray-600 dark:text-gray-300 border-gray-200 dark:border-white/10 hover:bg-gray-50 dark:hover:bg-slate-700' }}">
                {{ $label }}
            </a>
            @endforeach
        </div>

        {{-- Kegiatan Grid --}}
        <x-card-grid>
            @forelse($kegiatan as $item)
            <a wire:navigate href="{{ route('public.kegiatan.show', $item->id) }}" class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-100 dark:border-white/5 overflow-hidden hover:shadow-md hover:border-emerald-500/30 transition group flex flex-col h-full">
                <div class="aspect-video bg-gray-100 dark:bg-slate-700 overflow-hidden relative">
                    @if($item->banner_image)
                    <img src="{{ Storage::url($item->banner_image) }}" alt="{{ $item->nama_kegiatan }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-gray-50 dark:bg-slate-700/50">
                        <svg class="w-12 h-12 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    
                    {{-- Badges --}}
                    <div class="absolute top-3 right-3 flex flex-col gap-2 items-end">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-white/90 dark:bg-slate-900/90 backdrop-blur-sm text-gray-800 dark:text-gray-100 shadow-sm">
                             {{ $item->jenis_label }}
                        </span>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider shadow-sm bg-{{ $item->status_color }}-100 text-{{ $item->status_color }}-700 dark:bg-{{ $item->status_color }}-900/80 dark:text-{{ $item->status_color }}-300 backdrop-blur-sm">
                            {{ $item->status_label }}
                        </span>
                    </div>

                    {{-- Date Overlay --}}
                    <div class="absolute bottom-3 left-3 text-white">
                        <div class="flex items-center gap-2">
                             <div class="bg-white/20 backdrop-blur-md rounded-lg px-3 py-1 flex flex-col items-center border border-white/20">
                                 <span class="text-xs uppercase">{{ $item->tanggal->translatedFormat('M') }}</span>
                                 <span class="text-xl font-bold leading-none">{{ $item->tanggal->format('d') }}</span>
                             </div>
                             <div>
                                 <p class="text-xs font-medium opacity-90">{{ $item->tanggal->translatedFormat('l') }}</p>
                                 <p class="text-sm font-bold">{{ $item->waktu ? \Carbon\Carbon::parse($item->waktu)->format('H:i') . ' WIB' : 'Waktu menyusul' }}</p>
                             </div>
                        </div>
                    </div>
                </div>
                <div class="p-5 flex flex-col flex-grow">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-3 line-clamp-2 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition">{{ $item->nama_kegiatan }}</h2>
                    
                    <div class="space-y-2 text-sm text-gray-600 dark:text-gray-400 mt-auto">
                        @if($item->lokasi)
                        <div class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span class="line-clamp-1">{{ $item->lokasi }}</span>
                        </div>
                        @endif
                        @if($item->ustadz)
                        <div class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            <span class="line-clamp-1">{{ $item->ustadz }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-16">
                 <div class="w-16 h-16 bg-gray-100 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-4">
                     <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                 </div>
                <p class="text-gray-500 dark:text-gray-400 text-lg">Belum ada kegiatan tersedia.</p>
            </div>
            @endforelse
        </x-card-grid>

        {{-- Pagination --}}
        @if($kegiatan->hasPages())
        <div class="mt-12">
            {{ $kegiatan->links() }}
        </div>
        @endif
    </section>
</x-public-layout>
