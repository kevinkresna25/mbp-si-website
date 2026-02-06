<x-admin-layout>
    <x-slot name="header">Kutipan Hikmah</x-slot>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-800">Daftar Kutipan Hikmah</h2>
            <a href="{{ route('admin.kutipan-hikmah.create') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Kutipan
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">#</th>
                        <th class="px-6 py-3 text-left">Kutipan</th>
                        <th class="px-6 py-3 text-left">Sumber</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($kutipans as $i => $kutipan)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-gray-500">{{ $kutipans->firstItem() + $i }}</td>
                        <td class="px-6 py-4 text-gray-900 max-w-md">
                            <p class="line-clamp-2">{{ $kutipan->kutipan_text }}</p>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $kutipan->sumber ?? '-' }}</td>
                        <td class="px-6 py-4">
                            @if($kutipan->is_active)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">Aktif</span>
                            @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">Non-aktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.kutipan-hikmah.edit', $kutipan) }}" class="text-emerald-600 hover:text-emerald-800 text-xs font-medium">Edit</a>
                                <form action="{{ route('admin.kutipan-hikmah.destroy', $kutipan) }}" method="POST" onsubmit="return confirm('Yakin hapus kutipan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-xs font-medium">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">Belum ada kutipan hikmah.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($kutipans->hasPages())
        <div class="p-6 border-t border-gray-200">
            {{ $kutipans->links() }}
        </div>
        @endif
    </div>
</x-admin-layout>
