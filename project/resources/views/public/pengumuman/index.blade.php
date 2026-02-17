<x-public-layout>
    <x-page-header title="Pengumuman" subtitle="Informasi terkini dan pengumuman resmi dari Masjid Bukit Palma" breadcrumb="Pengumuman" />

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Search --}}
        <div class="mb-10 max-w-2xl mx-auto">
            <form method="GET" class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pengumuman..."
                    class="w-full pl-12 pr-4 py-3 rounded-2xl border-gray-200 dark:border-white/10 bg-white dark:bg-slate-800 text-gray-900 dark:text-white focus:border-emerald-500 focus:ring-emerald-500 shadow-sm transition text-lg">
                <svg class="w-6 h-6 text-gray-400 absolute left-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <div class="absolute right-2 top-2">
                    <button type="submit" class="px-6 py-1.5 bg-emerald-600 text-white font-medium rounded-xl hover:bg-emerald-700 transition shadow-sm">Cari</button>
                </div>
            </form>
            @if(request('search'))
            <div class="mt-4 text-center">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400">
                    Hasil pencarian: "{{ request('search') }}"
                    <a href="{{ route('public.pengumuman.index') }}" class="ml-2 text-emerald-500 hover:text-emerald-700 dark:hover:text-emerald-300 font-bold">&times;</a>
                </span>
            </div>
            @endif
        </div>

        {{-- Pengumuman Grid --}}
        <x-card-grid>
            @forelse($pengumuman as $item)
            <article class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-100 dark:border-white/5 p-6 hover:shadow-md hover:border-emerald-500/30 transition group flex flex-col h-full relative overflow-hidden">
                <div class="absolute top-0 left-0 w-1 h-full bg-gradient-to-b from-emerald-500 to-emerald-600"></div>
                
                {{-- Header --}}
                <div class="flex items-start justify-between mb-4 pl-4">
                    <div class="flex flex-col">
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-1">Pengumuman</span>
                         <a href="{{ route('public.pengumuman.show', $item) }}">
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition leading-tight">{{ $item->title }}</h2>
                        </a>
                    </div>
                    @if($item->expired_at)
                    <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-[10px] font-bold uppercase tracking-wide {{ $item->expired_at->isPast() ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' : 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' }}">
                        {{ $item->expired_at->isPast() ? 'Kadaluarsa' : 'Berlaku' }}
                    </span>
                    @endif
                </div>

                {{-- Content Snippet --}}
                <div class="pl-4 mb-6 flex-grow">
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed line-clamp-3">{{ \Illuminate\Support\Str::limit(strip_tags($item->content), 150) }}</p>
                </div>

                {{-- Footer --}}
                <div class="mt-auto pl-4 pt-4 border-t border-gray-100 dark:border-white/5 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                         <div class="w-6 h-6 rounded-full bg-gray-100 dark:bg-slate-700 flex items-center justify-center text-xs font-bold text-gray-500">
                            {{ substr($item->creator->name ?? 'A', 0, 1) }}
                         </div>
                         <span class="text-xs text-gray-500 dark:text-gray-400">{{ $item->created_at->diffForHumans() }}</span>
                    </div>
                    <a wire:navigate href="{{ route('public.pengumuman.show', $item) }}" class="text-sm font-bold text-emerald-600 dark:text-emerald-400 hover:underline">Baca Detail &rarr;</a>
                </div>
            </article>
            @empty
            <div class="col-span-full text-center py-16">
                <div class="w-16 h-16 bg-gray-100 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                </div>
                <p class="text-gray-500 dark:text-gray-400 text-lg">Belum ada pengumuman tersedia.</p>
            </div>
            @endforelse
        </x-card-grid>

        {{-- Pagination --}}
        @if($pengumuman->hasPages())
        <div class="mt-10">
            {{ $pengumuman->links() }}
        </div>
        @endif
    </section>
</x-public-layout>
