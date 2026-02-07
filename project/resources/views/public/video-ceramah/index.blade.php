<x-public-layout>
    <x-slot name="title">Video Ceramah</x-slot>

    {{-- Hero Section --}}
    <section class="bg-emerald-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-3">Video Ceramah</h1>
            <p class="text-emerald-100 text-lg max-w-2xl mx-auto">Kumpulan video ceramah dan kajian islami dari Masjid Bukit Palma</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Search --}}
        <form method="GET" class="mb-8 max-w-xl">
            <div class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari video atau ustadz..."
                    class="flex-1 rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-sm">
                <button type="submit" class="px-6 py-2 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition">Cari</button>
            </div>
        </form>

        @if(request('search'))
        <div class="mb-6">
            <span class="text-sm text-gray-500">Hasil pencarian:</span>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-700 ml-1">
                "{{ request('search') }}"
                <a href="{{ route('public.video-ceramah.index') }}" class="ml-2 text-emerald-500 hover:text-emerald-700">&times;</a>
            </span>
        </div>
        @endif

        {{-- Video Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($videos as $video)
            <article class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition group">
                <a href="{{ route('public.video-ceramah.show', $video) }}">
                    <div class="aspect-video bg-gray-100 overflow-hidden relative">
                        @if($video->thumbnail)
                        <img src="{{ Storage::url($video->thumbnail) }}" alt="{{ $video->judul }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        @else
                        <div class="w-full h-full flex items-center justify-center bg-emerald-50">
                            <svg class="w-16 h-16 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        @endif
                        {{-- Play overlay --}}
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition flex items-center justify-center">
                            <div class="w-14 h-14 bg-white bg-opacity-90 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition transform group-hover:scale-100 scale-75">
                                <svg class="w-6 h-6 text-emerald-700 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        </div>
                        @if($video->durasi)
                        <span class="absolute bottom-2 right-2 bg-black bg-opacity-75 text-white text-xs px-2 py-1 rounded">{{ $video->durasi }}</span>
                        @endif
                    </div>
                </a>
                <div class="p-5">
                    <a href="{{ route('public.video-ceramah.show', $video) }}">
                        <h2 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-emerald-700 transition">{{ $video->judul }}</h2>
                    </a>
                    <div class="flex items-center justify-between">
                        @if($video->ustadz)
                        <span class="text-sm text-gray-500">{{ $video->ustadz }}</span>
                        @endif
                        <span class="text-xs text-gray-400">{{ $video->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-full text-center py-16">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                <p class="text-gray-400 text-lg">Belum ada video ceramah tersedia.</p>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($videos->hasPages())
        <div class="mt-8">
            {{ $videos->links() }}
        </div>
        @endif
    </section>
</x-public-layout>
