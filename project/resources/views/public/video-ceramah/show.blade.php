<x-public-layout>
    <x-slot name="title">{{ $videoCeramah->judul }}</x-slot>

    {{-- Hero --}}
    <div class="bg-emerald-800 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="mb-4">
                <a href="{{ route('public.video-ceramah.index') }}" class="inline-flex items-center text-emerald-200 hover:text-white text-sm transition">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Kembali ke Video Ceramah
                </a>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold leading-tight mb-4">{{ $videoCeramah->judul }}</h1>
            <div class="flex items-center space-x-4 text-sm text-emerald-200">
                @if($videoCeramah->ustadz)
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    {{ $videoCeramah->ustadz }}
                </span>
                @endif
                @if($videoCeramah->durasi)
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ $videoCeramah->durasi }}
                </span>
                @endif
                <span>{{ $videoCeramah->created_at->translatedFormat('d F Y') }}</span>
            </div>
        </div>
    </div>

    {{-- Video Content --}}
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        {{-- Video Embed --}}
        @php
            $videoUrl = $videoCeramah->video_url;
            $embedUrl = null;

            // YouTube
            if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $videoUrl, $matches)) {
                $embedUrl = 'https://www.youtube.com/embed/' . $matches[1];
            }
        @endphp

        @if($embedUrl)
        <div class="aspect-video rounded-xl overflow-hidden shadow-lg mb-8">
            <iframe src="{{ $embedUrl }}" class="w-full h-full" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
        </div>
        @else
        <div class="mb-8">
            <a href="{{ $videoUrl }}" target="_blank" rel="noopener noreferrer"
                class="inline-flex items-center px-6 py-3 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                Tonton Video
            </a>
            <p class="text-sm text-gray-500 mt-2">Video akan dibuka di tab baru</p>
        </div>
        @endif

        {{-- Share --}}
        <div class="pt-6 border-t border-gray-200">
            <p class="text-sm font-medium text-gray-600 mb-3">Bagikan video ini:</p>
            <div class="flex items-center space-x-3">
                <a href="https://wa.me/?text={{ urlencode($videoCeramah->judul . ' - ' . url()->current()) }}" target="_blank"
                    class="inline-flex items-center px-4 py-2 bg-green-500 text-white text-sm rounded-lg hover:bg-green-600 transition">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                    WhatsApp
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition">
                    Facebook
                </a>
                <button onclick="navigator.clipboard.writeText('{{ url()->current() }}').then(() => alert('Link berhasil disalin!'))"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm rounded-lg hover:bg-gray-300 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                    Salin Link
                </button>
            </div>
        </div>
    </div>

    {{-- Related Videos --}}
    @if($relatedVideos->count() > 0)
    <section class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Video Lainnya</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedVideos as $related)
                <a href="{{ route('public.video-ceramah.show', $related) }}" class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition group">
                    <div class="aspect-video bg-gray-100 overflow-hidden relative">
                        @if($related->thumbnail)
                        <img src="{{ Storage::url($related->thumbnail) }}" alt="{{ $related->judul }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        @else
                        <div class="w-full h-full flex items-center justify-center bg-emerald-50">
                            <svg class="w-12 h-12 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        @endif
                        @if($related->durasi)
                        <span class="absolute bottom-2 right-2 bg-black bg-opacity-75 text-white text-xs px-2 py-1 rounded">{{ $related->durasi }}</span>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 line-clamp-2 group-hover:text-emerald-700 transition">{{ $related->judul }}</h3>
                        <div class="flex items-center justify-between mt-2">
                            @if($related->ustadz)
                            <span class="text-xs text-gray-500">{{ $related->ustadz }}</span>
                            @endif
                            <span class="text-xs text-gray-400">{{ $related->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</x-public-layout>
