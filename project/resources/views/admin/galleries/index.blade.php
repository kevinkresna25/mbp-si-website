<x-admin-layout>
    <x-slot name="header">Galeri Foto</x-slot>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="text-lg font-semibold text-gray-800">Daftar Galeri</h2>
            <a href="{{ route('admin.galleries.create') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Upload Galeri
            </a>
        </div>

        {{-- Filter --}}
        <div class="p-4 border-b border-gray-200 bg-gray-50">
            <form method="GET" class="flex items-center gap-3">
                <select name="category" class="rounded-lg border-gray-300 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                    <option value="">Semua Kategori</option>
                    <option value="kegiatan" {{ request('category') === 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                    <option value="pembangunan" {{ request('category') === 'pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                    <option value="umum" {{ request('category') === 'umum' ? 'selected' : '' }}>Umum</option>
                </select>
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white text-sm rounded-lg hover:bg-emerald-700 transition">Filter</button>
                @if(request('category'))
                <a href="{{ route('admin.galleries.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Reset</a>
                @endif
            </form>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($galleries as $gallery)
                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-md transition">
                    <div class="aspect-video bg-gray-100 relative">
                        @if($gallery->getFirstMediaUrl('photos', 'thumb'))
                        <img src="{{ $gallery->getFirstMediaUrl('photos', 'thumb') }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        @endif
                        <span class="absolute top-2 right-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-white/90 text-gray-700">
                            {{ $gallery->getMedia('photos')->count() }} foto
                        </span>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 text-sm">{{ $gallery->title }}</h3>
                        <div class="flex items-center justify-between mt-2">
                            <div class="flex items-center space-x-2">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700 capitalize">{{ $gallery->category }}</span>
                                <span class="text-xs text-gray-400">{{ $gallery->tanggal->format('d M Y') }}</span>
                            </div>
                            <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" onsubmit="return confirm('Yakin hapus galeri beserta semua fotonya?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12 text-gray-400">
                    Belum ada galeri foto.
                </div>
                @endforelse
            </div>
        </div>

        @if($galleries->hasPages())
        <div class="p-6 border-t border-gray-200">
            {{ $galleries->links() }}
        </div>
        @endif
    </div>
</x-admin-layout>
