<x-public-layout>
    <x-slot name="title">{{ $kegiatan->nama_kegiatan }}</x-slot>

    {{-- Hero --}}
    <div class="bg-emerald-800 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="mb-4">
                <a href="{{ route('public.kegiatan.index') }}" class="inline-flex items-center text-emerald-200 hover:text-white text-sm transition">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Kembali ke Kegiatan
                </a>
            </div>
            <div class="flex items-center space-x-2 mb-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-700 text-emerald-100">
                    {{ $kegiatan->jenis_label }}
                </span>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-{{ $kegiatan->status_color }}-600 text-white">
                    {{ $kegiatan->status_label }}
                </span>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold leading-tight mb-4">{{ $kegiatan->nama_kegiatan }}</h1>
            <div class="flex flex-wrap gap-4 text-sm text-emerald-200">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ $kegiatan->tanggal->translatedFormat('l, d F Y') }}
                    @if($kegiatan->waktu) - {{ \Carbon\Carbon::parse($kegiatan->waktu)->format('H:i') }} WIB @endif
                </div>
                @if($kegiatan->lokasi)
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    {{ $kegiatan->lokasi }}
                </div>
                @endif
                @if($kegiatan->ustadz)
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    {{ $kegiatan->ustadz }}
                </div>
                @endif
            </div>
        </div>
    </div>

    @if($kegiatan->banner_image)
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-4">
        <img src="{{ Storage::url($kegiatan->banner_image) }}" alt="{{ $kegiatan->nama_kegiatan }}"
            class="w-full rounded-xl shadow-lg object-cover max-h-96">
    </div>
    @endif

    {{-- Content --}}
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        @if($kegiatan->deskripsi)
        <div class="prose prose-lg prose-emerald max-w-none">
            {!! nl2br(e($kegiatan->deskripsi)) !!}
        </div>
        @else
        <p class="text-gray-500 italic">Belum ada deskripsi untuk kegiatan ini.</p>
        @endif

        {{-- Share --}}
        <div class="mt-10 pt-6 border-t border-gray-200">
            <p class="text-sm font-medium text-gray-600 mb-3">Bagikan kegiatan ini:</p>
            <div class="flex items-center space-x-3">
                <a href="https://wa.me/?text={{ urlencode($kegiatan->nama_kegiatan . ' - ' . url()->current()) }}" target="_blank"
                    class="inline-flex items-center px-4 py-2 bg-green-500 text-white text-sm rounded-lg hover:bg-green-600 transition">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                    WhatsApp
                </a>
                <button onclick="navigator.clipboard.writeText('{{ url()->current() }}').then(() => alert('Link berhasil disalin!'))"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm rounded-lg hover:bg-gray-300 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                    Salin Link
                </button>
            </div>
        </div>
    </div>

    {{-- Related Kegiatan --}}
    @if($relatedKegiatan->count() > 0)
    <section class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Kegiatan Serupa</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedKegiatan as $related)
                <a href="{{ route('public.kegiatan.show', $related->id) }}" class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition group">
                    <div class="aspect-video bg-gray-100 overflow-hidden">
                        @if($related->banner_image)
                        <img src="{{ Storage::url($related->banner_image) }}" alt="{{ $related->nama_kegiatan }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        @else
                        <div class="w-full h-full flex items-center justify-center bg-emerald-50">
                            <svg class="w-10 h-10 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <span class="text-xs text-gray-400">{{ $related->tanggal->translatedFormat('d M Y') }}</span>
                        <h3 class="font-semibold text-gray-900 mt-1 line-clamp-2 group-hover:text-emerald-700 transition">{{ $related->nama_kegiatan }}</h3>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</x-public-layout>
