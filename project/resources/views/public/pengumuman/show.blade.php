<x-public-layout>
    <x-slot name="title">{{ $pengumuman->title }}</x-slot>

    {{-- Hero --}}
    <div class="bg-emerald-800 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="mb-4">
                <a href="{{ route('public.pengumuman.index') }}" class="inline-flex items-center text-emerald-200 hover:text-white text-sm transition">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Kembali ke Pengumuman
                </a>
            </div>
            <div class="flex items-center space-x-2 mb-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-700 text-emerald-100">Pengumuman</span>
                @if($pengumuman->expired_at)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $pengumuman->expired_at->isPast() ? 'bg-red-900 text-red-200' : 'bg-amber-900 text-amber-200' }}">
                    {{ $pengumuman->expired_at->isPast() ? 'Kadaluarsa' : 'Berlaku s/d ' . $pengumuman->expired_at->format('d M Y') }}
                </span>
                @endif
            </div>
            <h1 class="text-3xl md:text-4xl font-bold leading-tight mb-4">{{ $pengumuman->title }}</h1>
            <div class="flex items-center space-x-3">
                @if($pengumuman->creator)
                <div class="w-10 h-10 rounded-full bg-emerald-600 flex items-center justify-center text-white text-sm font-bold">
                    {{ strtoupper(substr($pengumuman->creator->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-sm font-medium text-white">{{ $pengumuman->creator->name }}</p>
                    <p class="text-xs text-emerald-200">{{ $pengumuman->created_at->translatedFormat('d F Y, H:i') }}</p>
                </div>
                @else
                <p class="text-xs text-emerald-200">{{ $pengumuman->created_at->translatedFormat('d F Y, H:i') }}</p>
                @endif
            </div>
        </div>
    </div>

    {{-- Content --}}
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="prose prose-lg prose-emerald max-w-none">
            {!! $pengumuman->content !!}
        </div>

        {{-- Share --}}
        <div class="mt-10 pt-6 border-t border-gray-200">
            <p class="text-sm font-medium text-gray-600 mb-3">Bagikan pengumuman ini:</p>
            <div class="flex items-center space-x-3">
                <a href="https://wa.me/?text={{ urlencode($pengumuman->title . ' - ' . url()->current()) }}" target="_blank"
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
</x-public-layout>
