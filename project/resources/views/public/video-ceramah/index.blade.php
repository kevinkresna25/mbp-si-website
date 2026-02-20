<x-public-layout>
    <x-page-header title="Video Ceramah" subtitle="Kumpulan video ceramah dan kajian islami dari Masjid Bukit Palma" breadcrumb="Video Ceramah" />

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Search --}}
        <div class="mb-10 max-w-2xl mx-auto">
            <form method="GET" class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari video atau ustadz..."
                    class="w-full pl-12 pr-4 py-3 rounded-3xl border-gray-200 dark:border-white/10 bg-white dark:bg-slate-800 text-gray-900 dark:text-white focus:border-emerald-500 focus:ring-emerald-500 shadow-sm transition text-lg">
                <svg class="w-6 h-6 text-gray-400 absolute left-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <div class="absolute right-2 top-2">
                    <button type="submit" class="px-6 py-1.5 bg-emerald-600 text-white font-medium rounded-3xl hover:bg-emerald-700 transition shadow-sm">Cari</button>
                </div>
            </form>
            @if(request('search'))
            <div class="mt-4 text-center">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400">
                    Hasil pencarian: "{{ request('search') }}"
                    <a href="{{ route('public.video-ceramah.index') }}" class="ml-2 text-emerald-500 hover:text-emerald-700 dark:hover:text-emerald-300 font-bold">&times;</a>
                </span>
            </div>
            @endif
        </div>

        {{-- Video Grid --}}
        <x-card-grid>
            @forelse($videos as $video)
            <article class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg shadow-gray-200/50 dark:shadow-none border border-emerald-200 dark:border-emerald-500/20 overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition duration-300 group flex flex-col h-full">
                <a wire:navigate href="{{ route('public.video-ceramah.show', $video) }}" class="block relative group-hover:opacity-90 transition">
                    <div class="aspect-video bg-gray-900 overflow-hidden relative">
                        @if($video->thumbnail)
                        <img src="{{ Storage::url($video->thumbnail) }}" alt="{{ $video->judul }}"
                            class="w-full h-full object-cover opacity-90 group-hover:scale-105 transition duration-500">
                        @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-800">
                            <svg class="w-16 h-16 text-emerald-500/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        @endif
                        
                        {{-- Play Overlay --}}
                        <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition flex items-center justify-center">
                            <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center group-hover:scale-110 transition duration-300 border border-white/40">
                                <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        </div>

                        @if($video->durasi)
                        <span class="absolute bottom-3 right-3 bg-black/80 backdrop-blur-sm text-white text-xs font-bold px-2.5 py-1 rounded-lg border border-white/10">{{ $video->durasi }}</span>
                        @endif
                    </div>
                </a>
                <div class="p-5 flex flex-col flex-grow">
                    <a wire:navigate href="{{ route('public.video-ceramah.show', $video) }}">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition leading-tight">{{ $video->judul }}</h2>
                    </a>
                    
                    <div class="mt-auto flex items-center justify-between text-sm text-gray-500 dark:text-gray-400 pt-4 border-t border-emerald-100 dark:border-white/5">
                        <div class="flex items-center gap-2">
                             @if($video->ustadz)
                             <span class="font-medium text-gray-700 dark:text-gray-300">{{ $video->ustadz }}</span>
                             @else
                             <span>Masjid Bukit Palma</span>
                             @endif
                        </div>
                        <span class="text-xs">{{ $video->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-full text-center py-16">
                <div class="w-16 h-16 bg-gray-100 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                </div>
                <p class="text-gray-500 dark:text-gray-400 text-lg">Belum ada video ceramah tersedia.</p>
            </div>
            @endforelse
        </x-card-grid>

        {{-- Pagination --}}
        @if($videos->hasPages())
        <div class="mt-10">
            {{ $videos->links() }}
        </div>
        @endif
    </section>
</x-public-layout>
