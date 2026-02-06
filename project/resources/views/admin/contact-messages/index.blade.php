<x-admin-layout>
    <x-slot name="header">Pesan Masuk</x-slot>

    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Kotak Pesan</h2>
        <p class="text-sm text-gray-500 mt-1">Pesan dari form kontak website</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        @if($messages instanceof \Illuminate\Pagination\LengthAwarePaginator && $messages->isNotEmpty())
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Pengirim</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Subjek</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($messages as $msg)
                    <tr class="hover:bg-gray-50 transition {{ !$msg->is_read ? 'bg-emerald-50/50' : '' }}">
                        <td class="px-6 py-4">
                            @if(!$msg->is_read)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Baru</span>
                            @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">Dibaca</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-900 {{ !$msg->is_read ? 'font-bold' : '' }}">{{ $msg->nama }}</p>
                                <p class="text-xs text-gray-400">{{ $msg->email }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-600 {{ !$msg->is_read ? 'font-semibold' : '' }}">{{ $msg->subject ?? 'Tanpa Subjek' }}</td>
                        <td class="px-6 py-4 text-gray-500 text-sm">{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.contact-messages.show', $msg->id) }}" class="text-emerald-600 hover:text-emerald-800 font-medium">Lihat</a>
                            <form method="POST" action="{{ route('admin.contact-messages.toggle-read', $msg->id) }}" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-gray-500 hover:text-gray-700 font-medium">
                                    {{ $msg->is_read ? 'Tandai Belum Dibaca' : 'Tandai Dibaca' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($messages->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $messages->links() }}
        </div>
        @endif
        @else
        <div class="p-12 text-center">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            <p class="text-gray-400 text-lg mb-2">Belum ada pesan masuk</p>
            <p class="text-gray-400 text-sm">Pesan dari form kontak akan muncul di sini.</p>
        </div>
        @endif
    </div>
</x-admin-layout>
