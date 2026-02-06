<x-public-layout>
    <x-slot name="title">Kegiatan</x-slot>

    {{-- Hero Section --}}
    <section class="bg-emerald-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-3">Kegiatan Masjid</h1>
            <p class="text-emerald-100 text-lg max-w-2xl mx-auto">Jadwal kegiatan, kajian, dan program Masjid Bukit Palma</p>
            <div class="mt-6">
                <a href="{{ route('public.kegiatan.kalender') }}" class="inline-flex items-center px-5 py-2.5 bg-white/20 backdrop-blur-sm text-white text-sm font-medium rounded-lg hover:bg-white/30 transition border border-white/30">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Lihat Kalender
                </a>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Category Filter Tabs --}}
        <div class="flex flex-wrap gap-2 mb-8">
            <a href="{{ route('public.kegiatan.index') }}"
                class="px-4 py-2 rounded-full text-sm font-medium transition {{ !request('jenis') ? 'bg-emerald-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                Semua
            </a>
            @foreach($jenisOptions as $key => $label)
            <a href="{{ route('public.kegiatan.index', ['jenis' => $key]) }}"
                class="px-4 py-2 rounded-full text-sm font-medium transition {{ request('jenis') === $key ? 'bg-emerald-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                {{ $label }}
            </a>
            @endforeach
        </div>

        {{-- Kegiatan Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($kegiatan as $item)
            <a href="{{ route('public.kegiatan.show', $item->id) }}" class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition group">
                <div class="aspect-video bg-gray-100 overflow-hidden relative">
                    @if($item->banner_image)
                    <img src="{{ Storage::url($item->banner_image) }}" alt="{{ $item->nama_kegiatan }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-emerald-50">
                        <svg class="w-12 h-12 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    @endif
                    {{-- Status Badge --}}
                    <div class="absolute top-3 right-3">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-{{ $item->status_color }}-100 text-{{ $item->status_color }}-700 shadow-sm">
                            {{ $item->status_label }}
                        </span>
                    </div>
                </div>
                <div class="p-5">
                    <div class="flex items-center space-x-2 mb-3">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $item->jenis_color }}-100 text-{{ $item->jenis_color }}-700">
                            {{ $item->jenis_label }}
                        </span>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-emerald-700 transition">{{ $item->nama_kegiatan }}</h2>
                    <div class="space-y-1.5 text-sm text-gray-500">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $item->tanggal->translatedFormat('d F Y') }}
                            @if($item->waktu) - {{ \Carbon\Carbon::parse($item->waktu)->format('H:i') }} WIB @endif
                        </div>
                        @if($item->lokasi)
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $item->lokasi }}
                        </div>
                        @endif
                        @if($item->ustadz)
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            {{ $item->ustadz }}
                        </div>
                        @endif
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-16">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <p class="text-gray-400 text-lg">Belum ada kegiatan tersedia.</p>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($kegiatan->hasPages())
        <div class="mt-8">
            {{ $kegiatan->links() }}
        </div>
        @endif
    </section>
</x-public-layout>
