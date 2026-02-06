<x-admin-layout>
    <x-slot name="header">Detail Pesan</x-slot>

    <div class="max-w-3xl">
        @if($message)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">{{ $message->subject ?? 'Tanpa Subjek' }}</h2>
                    <p class="text-sm text-gray-500 mt-1">Dari: <strong>{{ $message->nama }}</strong> ({{ $message->email }})</p>
                </div>
                <div class="text-right">
                    <span class="text-sm text-gray-400">{{ $message->created_at->format('d/m/Y H:i') }}</span>
                    @if($message->is_read)
                    <p class="text-xs text-gray-400 mt-1">Dibaca oleh {{ $message->reader?->name ?? '-' }}</p>
                    @endif
                </div>
            </div>
            <div class="bg-gray-50 rounded-lg p-6 text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $message->pesan }}</div>
            <div class="mt-6 pt-6 border-t border-gray-200 flex items-center justify-between">
                <a href="{{ route('admin.contact-messages.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition">Kembali</a>
                <form method="POST" action="{{ route('admin.contact-messages.toggle-read', $message->id) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm font-medium hover:bg-emerald-700 transition">
                        {{ $message->is_read ? 'Tandai Belum Dibaca' : 'Tandai Dibaca' }}
                    </button>
                </form>
            </div>
        </div>
        @else
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
            <p class="text-gray-400">Pesan tidak ditemukan atau fitur belum tersedia.</p>
            <a href="{{ route('admin.contact-messages.index') }}" class="mt-4 inline-block px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition">Kembali</a>
        </div>
        @endif
    </div>
</x-admin-layout>
