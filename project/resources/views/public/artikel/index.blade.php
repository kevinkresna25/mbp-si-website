<x-public-layout>
    <x-slot name="title">Artikel</x-slot>

    {{-- Hero Section --}}
    <section class="bg-emerald-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-3">Artikel & Kajian</h1>
            <p class="text-emerald-100 text-lg max-w-2xl mx-auto">Kumpulan artikel islami, kajian, dan informasi seputar kegiatan Masjid Bukit Palma</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Main Content --}}
            <div class="flex-1">
                {{-- Search --}}
                <form method="GET" class="mb-8">
                    @if(request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                    @endif
                    <div class="flex gap-2">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari artikel..."
                            class="flex-1 rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                        <button type="submit" class="px-6 py-2 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition">Cari</button>
                    </div>
                </form>

                @if(request('kategori'))
                <div class="mb-6">
                    <span class="text-sm text-gray-500">Menampilkan kategori:</span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-700 ml-1">
                        {{ request('kategori') }}
                        <a href="{{ route('public.artikel.index') }}" class="ml-2 text-emerald-500 hover:text-emerald-700">&times;</a>
                    </span>
                </div>
                @endif

                {{-- Articles Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($articles as $article)
                    <article class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition group">
                        <a href="{{ route('public.artikel.show', $article->slug) }}">
                            <div class="aspect-video bg-gray-100 overflow-hidden">
                                @if($article->featured_image)
                                <img src="{{ Storage::url($article->featured_image) }}" alt="{{ $article->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                @else
                                <div class="w-full h-full flex items-center justify-center bg-emerald-50">
                                    <svg class="w-12 h-12 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                </div>
                                @endif
                            </div>
                        </a>
                        <div class="p-5">
                            <div class="flex items-center space-x-2 mb-3">
                                <a href="{{ route('public.artikel.index', ['kategori' => $article->category->slug]) }}"
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700 hover:bg-emerald-200 transition">
                                    {{ $article->category->name }}
                                </a>
                                <span class="text-xs text-gray-400">{{ $article->published_at->format('d M Y') }}</span>
                            </div>
                            <a href="{{ route('public.artikel.show', $article->slug) }}">
                                <h2 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-emerald-700 transition">{{ $article->title }}</h2>
                            </a>
                            <p class="text-sm text-gray-500 line-clamp-3 mb-3">{{ $article->excerpt }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-400">Oleh {{ $article->author->name }}</span>
                                <a href="{{ route('public.artikel.show', $article->slug) }}" class="text-sm font-medium text-emerald-600 hover:text-emerald-700 transition">Baca &rarr;</a>
                            </div>
                        </div>
                    </article>
                    @empty
                    <div class="col-span-full text-center py-16">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        <p class="text-gray-400 text-lg">Belum ada artikel tersedia.</p>
                    </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                @if($articles->hasPages())
                <div class="mt-8">
                    {{ $articles->links() }}
                </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <aside class="lg:w-72 flex-shrink-0">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 sticky top-24">
                    <h3 class="text-sm font-semibold text-gray-800 uppercase tracking-wider mb-4">Kategori</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('public.artikel.index') }}"
                                class="flex items-center justify-between px-3 py-2 rounded-lg text-sm {{ !request('kategori') ? 'bg-emerald-50 text-emerald-700 font-medium' : 'text-gray-600 hover:bg-gray-50' }} transition">
                                <span>Semua Artikel</span>
                                <span class="text-xs text-gray-400">{{ $articles->total() }}</span>
                            </a>
                        </li>
                        @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('public.artikel.index', ['kategori' => $cat->slug]) }}"
                                class="flex items-center justify-between px-3 py-2 rounded-lg text-sm {{ request('kategori') === $cat->slug ? 'bg-emerald-50 text-emerald-700 font-medium' : 'text-gray-600 hover:bg-gray-50' }} transition">
                                <span>{{ $cat->name }}</span>
                                <span class="text-xs text-gray-400">{{ $cat->articles_count }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </aside>
        </div>
    </section>
</x-public-layout>
