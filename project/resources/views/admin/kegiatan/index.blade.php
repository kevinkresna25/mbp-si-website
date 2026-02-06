<x-admin-layout>
    <x-slot name="header">Kegiatan</x-slot>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="text-lg font-semibold text-gray-800">Daftar Kegiatan</h2>
            <a href="{{ route('admin.kegiatan.create') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Kegiatan
            </a>
        </div>

        {{-- Filters --}}
        <div class="p-4 border-b border-gray-200 bg-gray-50">
            <form method="GET" class="flex flex-wrap items-center gap-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama kegiatan..."
                    class="rounded-lg border-gray-300 text-sm focus:border-emerald-500 focus:ring-emerald-500 w-56">
                <select name="jenis" class="rounded-lg border-gray-300 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                    <option value="">Semua Jenis</option>
                    <option value="kajian" {{ request('jenis') === 'kajian' ? 'selected' : '' }}>Kajian Rutin</option>
                    <option value="maulid" {{ request('jenis') === 'maulid' ? 'selected' : '' }}>Hari Besar Islam</option>
                    <option value="sosial" {{ request('jenis') === 'sosial' ? 'selected' : '' }}>Program Sosial</option>
                    <option value="remaja" {{ request('jenis') === 'remaja' ? 'selected' : '' }}>Kegiatan Remaja</option>
                </select>
                <select name="status" class="rounded-lg border-gray-300 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                    <option value="">Semua Status</option>
                    <option value="upcoming" {{ request('status') === 'upcoming' ? 'selected' : '' }}>Akan Datang</option>
                    <option value="ongoing" {{ request('status') === 'ongoing' ? 'selected' : '' }}>Berlangsung</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white text-sm rounded-lg hover:bg-emerald-700 transition">Filter</button>
                @if(request()->hasAny(['search', 'jenis', 'status']))
                <a href="{{ route('admin.kegiatan.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Reset</a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">#</th>
                        <th class="px-6 py-3 text-left">Kegiatan</th>
                        <th class="px-6 py-3 text-left">Jenis</th>
                        <th class="px-6 py-3 text-left">Tanggal</th>
                        <th class="px-6 py-3 text-left">Lokasi</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($kegiatan as $i => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-gray-500">{{ $kegiatan->firstItem() + $i }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                @if($item->banner_image)
                                <img src="{{ Storage::url($item->banner_image) }}" alt="" class="w-10 h-10 rounded-lg object-cover">
                                @else
                                <div class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                                @endif
                                <div>
                                    <div class="font-medium text-gray-900">{{ Str::limit($item->nama_kegiatan, 40) }}</div>
                                    @if($item->ustadz)
                                    <div class="text-xs text-gray-400">{{ $item->ustadz }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-{{ $item->jenis_color }}-100 text-{{ $item->jenis_color }}-700">
                                {{ $item->jenis_label }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-600 text-xs">
                            {{ $item->tanggal->translatedFormat('d M Y') }}
                            @if($item->waktu)
                            <br><span class="text-gray-400">{{ \Carbon\Carbon::parse($item->waktu)->format('H:i') }} WIB</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-500 text-xs">{{ $item->lokasi ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-{{ $item->status_color }}-100 text-{{ $item->status_color }}-700">
                                {{ $item->status_label }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.kegiatan.edit', $item) }}" class="text-emerald-600 hover:text-emerald-800 text-xs font-medium">Edit</a>
                                <form action="{{ route('admin.kegiatan.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin hapus kegiatan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-xs font-medium">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-400">Belum ada kegiatan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($kegiatan->hasPages())
        <div class="p-6 border-t border-gray-200">
            {{ $kegiatan->links() }}
        </div>
        @endif
    </div>
</x-admin-layout>
