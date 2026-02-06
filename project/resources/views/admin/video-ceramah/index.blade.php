<x-admin-layout>
    <x-slot name="header">Video Ceramah</x-slot>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-800">Daftar Video Ceramah</h2>
            <a href="{{ route('admin.video-ceramah.create') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Video
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">#</th>
                        <th class="px-6 py-3 text-left">Judul</th>
                        <th class="px-6 py-3 text-left">Ustadz</th>
                        <th class="px-6 py-3 text-left">Durasi</th>
                        <th class="px-6 py-3 text-left">Ditambahkan</th>
                        <th class="px-6 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($videos as $i => $video)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-gray-500">{{ $videos->firstItem() + $i }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                @if($video->thumbnail)
                                <img src="{{ Storage::url($video->thumbnail) }}" alt="" class="w-16 h-10 rounded object-cover flex-shrink-0">
                                @else
                                <div class="w-16 h-10 rounded bg-gray-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                </div>
                                @endif
                                <div>
                                    <div class="font-medium text-gray-900">{{ Str::limit($video->judul, 50) }}</div>
                                    <a href="{{ $video->video_url }}" target="_blank" class="text-xs text-emerald-600 hover:underline">Buka link</a>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $video->ustadz ?? '-' }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $video->durasi ?? '-' }}</td>
                        <td class="px-6 py-4 text-gray-500 text-xs">{{ $video->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.video-ceramah.edit', $video) }}" class="text-emerald-600 hover:text-emerald-800 text-xs font-medium">Edit</a>
                                <form action="{{ route('admin.video-ceramah.destroy', $video) }}" method="POST" onsubmit="return confirm('Yakin hapus video ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-xs font-medium">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400">Belum ada video ceramah.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($videos->hasPages())
        <div class="p-6 border-t border-gray-200">
            {{ $videos->links() }}
        </div>
        @endif
    </div>
</x-admin-layout>
