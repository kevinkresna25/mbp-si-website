<x-public-layout>
    <x-slot name="title">Pengumuman</x-slot>

    {{-- Hero Section --}}
    <section class="bg-emerald-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-3">Pengumuman</h1>
            <p class="text-emerald-100 text-lg max-w-2xl mx-auto">Informasi terkini dan pengumuman resmi dari Masjid Bukit Palma</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Search --}}
        <form method="GET" class="mb-8 max-w-xl">
            <div class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pengumuman..."
                    class="flex-1 rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                <button type="submit" class="px-6 py-2 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition">Cari</button>
            </div>
        </form>

        @if(request('search'))
        <div class="mb-6">
            <span class="text-sm text-gray-500">Hasil pencarian:</span>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-700 ml-1">
                "{{ request('search') }}"
                <a href="{{ route('public.pengumuman.index') }}" class="ml-2 text-emerald-500 hover:text-emerald-700">&times;</a>
            </span>
        </div>
        @endif

        {{-- Pengumuman List --}}
        <div class="space-y-4">
            @forelse($pengumuman as $item)
            <article class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3">
                    <div class="flex-1">
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Pengumuman</span>
                            @if($item->expired_at)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $item->expired_at->isPast() ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700' }}">
                                {{ $item->expired_at->isPast() ? 'Kadaluarsa' : 'Berlaku s/d ' . $item->expired_at->format('d M Y') }}
                            </span>
                            @endif
                        </div>
                        <a href="{{ route('public.pengumuman.show', $item) }}">
                            <h2 class="text-lg font-semibold text-gray-900 hover:text-emerald-700 transition mb-2">{{ $item->title }}</h2>
                        </a>
                        <p class="text-gray-600 text-sm leading-relaxed line-clamp-2">{{ \Illuminate\Support\Str::limit(strip_tags($item->content), 200) }}</p>
                    </div>
                    <div class="flex-shrink-0 text-right">
                        <span class="text-xs text-gray-400">{{ $item->created_at->diffForHumans() }}</span>
                        @if($item->creator)
                        <p class="text-xs text-gray-400 mt-1">Oleh {{ $item->creator->name }}</p>
                        @endif
                    </div>
                </div>
                <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between">
                    <span class="text-xs text-gray-400">{{ $item->created_at->translatedFormat('d F Y, H:i') }}</span>
                    <a href="{{ route('public.pengumuman.show', $item) }}" class="text-sm font-medium text-emerald-600 hover:text-emerald-700 transition">Selengkapnya &rarr;</a>
                </div>
            </article>
            @empty
            <div class="text-center py-16">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                <p class="text-gray-400 text-lg">Belum ada pengumuman tersedia.</p>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($pengumuman->hasPages())
        <div class="mt-8">
            {{ $pengumuman->links() }}
        </div>
        @endif
    </section>
</x-public-layout>
