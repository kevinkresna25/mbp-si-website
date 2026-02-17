<x-public-layout>
    <x-page-header title="Artikel & Kajian" subtitle="Kumpulan artikel islami, kajian, dan informasi seputar kegiatan Masjid Bukit Palma" breadcrumb="Artikel" />

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Main Content --}}
            <div class="flex-1">
                {{-- Search & Mobile Filters --}}
                <div class="mb-8 flex flex-col sm:flex-row gap-4">
                    <form method="GET" class="flex-1 flex gap-2">
                        @if(request('kategori'))
                            <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                        @endif
                        <div class="relative flex-1">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari artikel..."
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border-gray-200 dark:border-white/10 bg-white dark:bg-slate-800 text-gray-900 dark:text-white focus:border-emerald-500 focus:ring-emerald-500 shadow-sm transition">
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                        <button type="submit" class="px-6 py-2.5 bg-emerald-600 text-white font-medium rounded-xl hover:bg-emerald-700 transition shadow-sm hover:shadow">Cari</button>
                    </form>
                </div>

                @if(request('kategori'))
                <div class="mb-6 flex items-center">
                    <span class="text-sm text-gray-500 dark:text-gray-400 mr-2">Menampilkan kategori:</span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400">
                        {{ request('kategori') }}
                        <a href="{{ route('public.artikel.index') }}" class="ml-2 text-emerald-500 hover:text-emerald-700 dark:hover:text-emerald-300">&times;</a>
                    </span>
                </div>
                @endif

                {{-- Articles Grid --}}
                <x-card-grid>
                    @forelse($articles as $article)
                    <article class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-gray-100 dark:border-white/5 overflow-hidden hover:shadow-md hover:border-emerald-500/30 transition group flex flex-col h-full">
                        <a wire:navigate href="{{ route('public.artikel.show', $article->slug) }}" class="block shrink-0">
                            <div class="aspect-video bg-gray-100 dark:bg-slate-700 overflow-hidden relative">
                                @if($article->featured_image)
                                <img src="{{ Storage::url($article->featured_image) }}" alt="{{ $article->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                @else
                                <div class="w-full h-full flex items-center justify-center bg-emerald-50 dark:bg-emerald-900/20">
                                    <svg class="w-12 h-12 text-emerald-300 dark:text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                                    <span class="text-white font-medium text-sm">Baca Selengkapnya &rarr;</span>
                                </div>
                            </div>
                        </a>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex items-center space-x-2 mb-3">
                                <a wire:navigate href="{{ route('public.artikel.index', ['kategori' => $article->category->slug]) }}"
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 hover:bg-emerald-200 dark:hover:bg-emerald-800 transition">
                                    {{ $article->category->name }}
                                </a>
                                <span class="text-xs text-gray-400 dark:text-gray-500">• {{ $article->published_at->format('d M Y') }}</span>
                            </div>
                            <a wire:navigate href="{{ route('public.artikel.show', $article->slug) }}">
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition">{{ $article->title }}</h2>
                            </a>
                            <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-3 mb-4 flex-grow leading-relaxed">{{ $article->excerpt }}</p>
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-white/5 mt-auto">
                                <div class="flex items-center space-x-2">
                                     <div class="w-6 h-6 rounded-full bg-gray-200 dark:bg-slate-700 flex items-center justify-center text-xs font-bold text-gray-500 dark:text-gray-400">
                                        {{ substr($article->author->name, 0, 1) }}
                                     </div>
                                     <span class="text-xs text-gray-500 dark:text-gray-400">{{ $article->author->name }}</span>
                                </div>
                            </div>
                        </div>
                    </article>
                    @empty
                    <div class="col-span-full text-center py-16">
                        <div class="w-16 h-16 bg-gray-100 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-4">
                             <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        </div>
                        <p class="text-gray-500 dark:text-gray-400 text-lg">Belum ada artikel tersedia.</p>
                    </div>
                    @endforelse
                </x-card-grid>

                {{-- Pagination --}}
                @if($articles->hasPages())
                <div class="mt-12">
                     {{ $articles->links() }}
                </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <aside class="lg:w-80 flex-shrink-0">
                <div class="sticky top-24 space-y-6">
                    <x-bento.item class="!p-0 overflow-hidden">
                        <div class="bg-gray-50 dark:bg-slate-700/50 p-4 border-b border-gray-100 dark:border-white/5">
                            <h3 class="font-bold text-gray-900 dark:text-white uppercase tracking-wider text-sm">Kategori</h3>
                        </div>
                        <div class="p-2 space-y-1">
                            <a wire:navigate href="{{ route('public.artikel.index') }}"
                                class="flex items-center justify-between px-3 py-2.5 rounded-lg text-sm transition {{ !request('kategori') ? 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 font-medium' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700/50' }}">
                                <span>Semua Artikel</span>
                                <span class="bg-gray-100 dark:bg-slate-700 text-gray-500 dark:text-gray-400 py-0.5 px-2 rounded-full text-xs">{{ $articles->total() }}</span>
                            </a>
                            @foreach($categories as $cat)
                             <a wire:navigate href="{{ route('public.artikel.index', ['kategori' => $cat->slug]) }}"
                                class="flex items-center justify-between px-3 py-2.5 rounded-lg text-sm transition {{ request('kategori') === $cat->slug ? 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 font-medium' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700/50' }}">
                                <span>{{ $cat->name }}</span>
                                <span class="bg-gray-100 dark:bg-slate-700 text-gray-500 dark:text-gray-400 py-0.5 px-2 rounded-full text-xs">{{ $cat->articles_count }}</span>
                            </a>
                            @endforeach
                        </div>
                    </x-bento.item>
                </div>
            </aside>
        </div>
    </section>
</x-public-layout>
