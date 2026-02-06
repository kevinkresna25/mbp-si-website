<x-public-layout>
    <x-slot name="title">Struktur Organisasi</x-slot>

    {{-- Page Header --}}
    <section class="bg-gradient-to-br from-emerald-700 to-emerald-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="text-sm text-emerald-200 mb-4">
                <a href="/" class="hover:text-white transition">Beranda</a>
                <span class="mx-2">/</span>
                <span>Profil</span>
                <span class="mx-2">/</span>
                <span class="text-white">Struktur Organisasi</span>
            </nav>
            <h1 class="text-3xl md:text-4xl font-bold">Struktur Organisasi</h1>
            <p class="text-emerald-200 mt-2">Pengurus Masjid Bukit Palma</p>
        </div>
    </section>

    {{-- Content --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($struktur->isNotEmpty())
        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($struktur as $anggota)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition text-center">
                <div class="h-48 bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center">
                    @if($anggota->foto)
                    <img src="{{ asset('storage/' . $anggota->foto) }}" alt="{{ $anggota->nama }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-24 h-24 bg-emerald-200 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    @endif
                </div>
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-900">{{ $anggota->nama }}</h3>
                    <p class="text-sm text-emerald-600 font-medium mt-1">{{ $anggota->jabatan }}</p>
                    @if($anggota->kontak)
                    <p class="text-xs text-gray-400 mt-2">{{ $anggota->kontak }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            <p class="text-gray-500">Data struktur organisasi belum tersedia.</p>
        </div>
        @endif
    </section>
</x-public-layout>
